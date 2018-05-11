package tamtam.tamtam;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteException;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

import java.io.File;

public class moteur_requete_bd extends SQLiteOpenHelper {

    // Logcat tag
    private static final String LOG = moteur_requete_bd.class.getName();

    // Database Version
    private static final int DATABASE_VERSION = 1;

    // Database Name
    private static final String DATABASE_NAME = "tamtaam.db";

    // Table Names
    private static final String TABLE_CLIENT = "client";
    private static final String TABLE_TYPE_RABAIS = "type_rabais";
    private static final String TABLE_RABAIS = "rabais";
    private static final String TABLE_PRODUIT = "produit";
    private static final String TABLE_RABAIS_PRODUIT = "ta_rabais_produit";
    private static final String TABLE_EVENEMENT = "evenement";
    private static final String TABLE_RECETTE = "recette";
    private static final String TABLE_PRODUIT_RECETTE = "ta_produit_recette";
    private static final String TABLE_TYPE_COMMANDE = "type_commande";
    private static final String TABLE_ETAT_COMMANDE = "etat_commande";
    private static final String TABLE_COMMANDE = "commande";
    private static final String TABLE_PRODUIT_COMMANDE = "ta_produit_commande";
    private static final String TABLE_LIVRAISON = "livraison";
    private static final String TABLE_NOTIFICATION = "notification";

    // Common column names - Recette, type-rabais, etat-commande, type-commande
    private static final String KEY_ID = "id";
    private static final String KEY_NOM = "nom";
    private static final String KEY_DESCRIPTION = "description";

    // CLIENT Table - column names
    private static final String KEY_MOT_DE_PASSE = "mot_de_passe";
    private static final String KEY_COURRIEL = "courriel";
    private static final String KEY_ADRESSE = "adresse";
    private static final String KEY_TELEPHONE = "telephone";

    // RABAIS Table - column names
    private static final String KEY_CODE = "code";
    private static final String KEY_MONTANT_RABAIS = "montant_rabais";
    private static final String KEY_ID_TYPE = "id_type";

    // PRODUIT Table - column names
    private static final String KEY_PRIX = "prix";

    // Table association - foreign key - column names - PRODUIT_RECETTE - RABAIS_PRODUIT - PRODUIT_COMMANDE
    private static final String KEY_ID_PRODUIT = "id_produit";
    private static final String KEY_CODE_RABAIS = "code_rabais";
    private static final String KEY_ID_RECETTE = "id_recette";
    private static final String KEY_ID_COMMANDE = "id_commande";
    private static final String KEY_NB_PRODUIT = "nb_produit";
    private static final String KEY_ID_CLIENT = "id_client";

    // EVENEMENT RABAIS Table - column names
    private static final String KEY_DATE_DEBUT = "date_debut";
    private static final String KEY_DATE_FIN = "date_fin";

    // COMMANDE Table - column names
    private static final String KEY_ID_ETAT = "id_etat";
    private static final String KEY_ID_TYPE_COMMANDE = "id_type_commande";
    private static final String KEY_DATE = "date";
    private static final String KEY_MONTANT_COMMANDE = "montant_commande";
    private static final String KEY_NOM_PERSONNE = "nom_personne";

    // Livraison Table - column names
    private static final String KEY_ADRESSE_LIVRAISON = "adresse_livraison";
    private static final String KEY_ADRESSE_LATITUDE = "adresse_latitude";
    private static final String KEY_ADRESSE_LONGITUDE = "adresse_longitude";
    private static final String KEY_DATE_PREVUE = "date_prevue";
    private static final String KEY_DATE_REEL = "date_reel";

    // Notification Table - column names
    private static final String KEY_SMS = "sms";
    private static final String KEY_NOTIFICATION = "notification";
    private static final String KEY_NOUVELLE = "nouvelle";
    private static final String KEY_RECEPTION = "reception";
    private static final String KEY_ETAT = "etat";

    // Table Create Statements
    // Client table create statement
    private static final String CREATE_TABLE_CLIENT = "CREATE TABLE "
            + TABLE_CLIENT + "(" + KEY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT," + KEY_NOM
            + " VARCHAR(32)," + KEY_MOT_DE_PASSE + " VARCHAR(32)," + KEY_COURRIEL
            + " VARCHAR(64)," + KEY_ADRESSE + " VARCHAR(64)," + KEY_TELEPHONE + " BIGINT" + ")";

    // type_rabais table create statement
    private static final String CREATE_TABLE_TYPE_RABAIS = "CREATE TABLE " + TABLE_TYPE_RABAIS
            + "(" + KEY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT," + KEY_NOM + " VARCHAR(32),"
            + KEY_DESCRIPTION + " TEXT" + ")";

    // rabais table create statement
    private static final String CREATE_TABLE_RABAIS = "CREATE TABLE " + TABLE_RABAIS
            + "(" + KEY_CODE + " VARCHAR(8) PRIMARY KEY," + KEY_MONTANT_RABAIS + " FLOAT,"
            + KEY_ID_TYPE + " INTEGER," + KEY_DESCRIPTION + " TEXT," + KEY_DATE_DEBUT + " DATE," + KEY_DATE_FIN + " DATE,"
            + " FOREIGN KEY (" + KEY_ID_TYPE + ") REFERENCES " + TABLE_TYPE_RABAIS + "(" + KEY_ID +")" + ")";

    // produit table create statement
    private static final String CREATE_TABLE_PRODUIT = "CREATE TABLE " + TABLE_PRODUIT
            + "(" + KEY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT," + KEY_NOM + " VARCHAR(32),"
            + KEY_DESCRIPTION + " TEXT," + KEY_PRIX + " FLOAT" +")";

    // rabais_produit table create statement
    private static final String CREATE_TABLE_RABAIS_PRODUIT = "CREATE TABLE "
            + TABLE_RABAIS_PRODUIT + "(" + KEY_ID_PRODUIT + " INTEGER PRIMARY KEY,"
            + KEY_CODE_RABAIS + " VARCHAR(8),"
            + " FOREIGN KEY (" + KEY_ID_PRODUIT + ") REFERENCES "+ TABLE_PRODUIT + "("+ KEY_ID + "),"
            + " FOREIGN KEY (" + KEY_CODE_RABAIS + ") REFERENCES "+ TABLE_RABAIS + "("+ KEY_CODE_RABAIS + ")"+")";

    // Evenement table create statement
    private static final String CREATE_TABLE_EVENEMENT = "CREATE TABLE "
            + TABLE_EVENEMENT + "(" + KEY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT,"
            + KEY_NOM + " VARCHAR(32)," + KEY_DATE_DEBUT + " DATE," + KEY_DATE_FIN + " DATE,"
            + KEY_DESCRIPTION + " TEXT" +")";

    // Recette table create statement
    private static final String CREATE_TABLE_RECETTE = "CREATE TABLE "
            + TABLE_RECETTE + "(" + KEY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT,"
            + KEY_NOM + " VARCHAR(32),"
            + KEY_DESCRIPTION + " TEXT" +")";

    // produit_recette table create statement
    private static final String CREATE_TABLE_PRODUIT_RECETTE = "CREATE TABLE "
            + TABLE_PRODUIT_RECETTE + "(" + KEY_ID_RECETTE + " INTEGER,"
            + KEY_ID_PRODUIT + " VARCHAR(8),"
            + " FOREIGN KEY (" + KEY_ID_RECETTE + ") REFERENCES "+ TABLE_RECETTE + "("+ KEY_ID + "),"
            + " FOREIGN KEY (" + KEY_ID_PRODUIT + ") REFERENCES "+ TABLE_PRODUIT + "("+ KEY_ID + ")"+")";

    // type_commande table create statement
    private static final String CREATE_TABLE_TYPE_COMMANDE = "CREATE TABLE "
            + TABLE_TYPE_COMMANDE + "(" + KEY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT,"
            + KEY_DESCRIPTION + " TEXT" +")";

    // etat_commande table create statement
    private static final String CREATE_TABLE_ETAT_COMMANDE = "CREATE TABLE "
            + TABLE_ETAT_COMMANDE + "(" + KEY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT,"
            + KEY_NOM + " VARCHAR(32),"
            + KEY_DESCRIPTION + " TEXT" +")";

    // Commande table create statement
    private static final String CREATE_TABLE_COMMANDE = "CREATE TABLE "
            + TABLE_COMMANDE + "(" + KEY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT,"
            + KEY_ID_CLIENT + " INTEGER,"
            + KEY_ID_ETAT + " INTEGER,"
            + KEY_ID_TYPE_COMMANDE + " INTEGER,"
            + KEY_DATE + " DATE,"
            + KEY_MONTANT_COMMANDE + " FLOAT,"
            + KEY_NOM_PERSONNE + " VARCHAR(32),"
            + " FOREIGN KEY (" + KEY_ID_CLIENT + ") REFERENCES "+ TABLE_CLIENT + "("+ KEY_ID + "),"
            + " FOREIGN KEY (" + KEY_ID_ETAT + ") REFERENCES "+ TABLE_ETAT_COMMANDE + "("+ KEY_ID + "),"
            + " FOREIGN KEY (" + KEY_ID_TYPE_COMMANDE + ") REFERENCES "+ TABLE_TYPE_COMMANDE + "("+ KEY_ID + ")"+")";

    // produit_commande table create statement
    private static final String CREATE_TABLE_PRODUIT_COMMANDE = "CREATE TABLE "
            + TABLE_PRODUIT_COMMANDE + "(" + KEY_ID_PRODUIT + " INTEGER PRIMARY KEY,"
            + KEY_ID_COMMANDE + " INTEGER," + KEY_NB_PRODUIT + " INTEGER,"
            + " FOREIGN KEY (" + KEY_ID_PRODUIT + ") REFERENCES "+ TABLE_PRODUIT + "("+ KEY_ID + "),"
            + " FOREIGN KEY (" + KEY_ID_COMMANDE + ") REFERENCES "+ TABLE_COMMANDE + "("+ KEY_ID + ")"+")";

    // Livraison table create statement
    private static final String CREATE_TABLE_LIVRAISON = "CREATE TABLE "
            + TABLE_LIVRAISON + "(" + KEY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT,"
            + KEY_ID_COMMANDE + " INTEGER,"
            + KEY_ADRESSE_LIVRAISON + " VARCHAR(32),"
            + KEY_ADRESSE_LATITUDE + " FLOAT,"
            + KEY_ADRESSE_LONGITUDE + " FLOAT,"
            + KEY_DATE_PREVUE + " DATE,"
            + KEY_DATE_REEL + " DATE,"
            + " FOREIGN KEY (" + KEY_ID_COMMANDE + ") REFERENCES "+ TABLE_COMMANDE + "("+ KEY_ID + ")"+")";

    // Notification table create statement
    private static final String CREATE_TABLE_NOTIFICATION = "CREATE TABLE "
            + TABLE_NOTIFICATION + "(" + KEY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT,"
            + KEY_SMS + " BOOLEAN,"
            + KEY_NOTIFICATION + " BOOLEAN,"
            + KEY_NOUVELLE + " BOOLEAN,"
            + KEY_RECEPTION + " BOOLEAN,"
            + KEY_ETAT + " BOOLEAN,"
            + KEY_ID_CLIENT + " INTEGER,"
            + " FOREIGN KEY (" + KEY_ID_CLIENT + ") REFERENCES "+ TABLE_CLIENT + "("+ KEY_ID + ")"+")";

    public moteur_requete_bd(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
        SQLiteDatabase db = this.getWritableDatabase();
    }

    /** Méthode pour obtenir le nom des tables  **/
    public String getTableClient() {
        return TABLE_CLIENT;
    }

    public String getTableTypeRabais() {
        return TABLE_TYPE_RABAIS;
    }

    public String getTableRabais() {
        return TABLE_RABAIS;
    }

    public String getTableProduit() {
        return TABLE_PRODUIT;
    }

    public String getTableRabaisProduit() {
        return TABLE_RABAIS_PRODUIT;
    }

    public String getTableEvenement() {
        return TABLE_EVENEMENT;
    }

    public String getTableRecette() {
        return TABLE_RECETTE;
    }

    public String getTableProduitRecette() {
        return TABLE_PRODUIT_RECETTE;
    }

    public String getTableTypeCommande() {
        return TABLE_TYPE_COMMANDE;
    }

    public String getTableEtatCommande() {
        return TABLE_ETAT_COMMANDE;
    }

    public String getTableCommande() {
        return TABLE_COMMANDE;
    }

    public String getTableProduitCommande() {
        return TABLE_PRODUIT_COMMANDE;
    }

    public String getTableLivraison() {
        return TABLE_LIVRAISON;
    }

    public String getTableNotification() {
        return TABLE_NOTIFICATION;
    }

    @Override
    public void onCreate(SQLiteDatabase db) {

        // creating required tables
        db.execSQL(CREATE_TABLE_CLIENT);
        db.execSQL(CREATE_TABLE_TYPE_RABAIS);
        db.execSQL(CREATE_TABLE_RABAIS);
        db.execSQL(CREATE_TABLE_PRODUIT);
        db.execSQL(CREATE_TABLE_RABAIS_PRODUIT);
        db.execSQL(CREATE_TABLE_EVENEMENT);
        db.execSQL(CREATE_TABLE_RECETTE);
        db.execSQL(CREATE_TABLE_PRODUIT_RECETTE);
        db.execSQL(CREATE_TABLE_TYPE_COMMANDE);
        db.execSQL(CREATE_TABLE_ETAT_COMMANDE);

        db.execSQL(CREATE_TABLE_COMMANDE);
        db.execSQL(CREATE_TABLE_PRODUIT_COMMANDE);
        db.execSQL(CREATE_TABLE_LIVRAISON);
        db.execSQL(CREATE_TABLE_NOTIFICATION);

    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_CLIENT);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_TYPE_RABAIS);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_RABAIS);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_PRODUIT);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_RABAIS_PRODUIT);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_EVENEMENT);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_RECETTE);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_PRODUIT_RECETTE);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_TYPE_COMMANDE);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_ETAT_COMMANDE);

        db.execSQL("DROP TABLE IF EXISTS " + TABLE_COMMANDE);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_PRODUIT_COMMANDE);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_LIVRAISON);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_NOTIFICATION);

        onCreate(db);
    }

    /**
     * exécute un requete sql comme insert
     * @param sql String une requete sql
     */
    public void execution(String sql){
        SQLiteDatabase db = this.getWritableDatabase();

        db.execSQL(sql);
    }

    /**
     * execute une requete sql et retourne un curseur
     * @param sql String une requete sql
     * @return Cursor
     */
    public Cursor execution_with_return(String sql) {
        SQLiteDatabase db = this.getReadableDatabase();

        Log.e(LOG, sql);

        Cursor c = db.rawQuery(sql, null);

        if (c != null)
            c.moveToFirst();

        return c;
    }

    public boolean doesDatabaseExist(Context context, String dbName) {
        File dbFile = context.getDatabasePath(dbName);
        return dbFile.exists();
    }

    // closing database
    public void closeDB() {
        SQLiteDatabase db = this.getReadableDatabase();
        if (db != null && db.isOpen())
            db.close();
    }
}
