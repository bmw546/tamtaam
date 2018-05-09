package tamtam.tamtam;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class moteur_requete_bd extends SQLiteOpenHelper{

    // Logcat tag
    private static final String LOG = "Moteur_requete_bd";

    // Database Version
    private static final int DATABASE_VERSION = 1;

    // Database Name
    private static final String DATABASE_NAME = "tamtaam";

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

    // EVENEMENT Table - column names
    private static final String KEY_DATE_DEBUT = "date_debut";
    private static final String KEY_DATE_FIN = "date_fin";

    // COMMANDE Table - column names
    private static final String KEY_ID_ETAT = "id_etat";
    private static final String KEY_ID_TYPE_COMMANDE = "id_type_commande";
    private static final String KEY_DATE = "id_type_commande";
    private static final String KEY_MONTANT_COMMANDE = "montant_commande";
    private static final String KEY_NOM_PERSONNE = "nom_personne";

    // Livraison Table - column names
    private static final String KEY_ADRESSE_LIVRAISON = "adresse_livraison";
    private static final String KEY_ADRESSE_LATITUDE = "adresse_latitude";
    private static final String KEY_ADRESSE_LONGITUDE = "adresse_logitude";
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
            + "(" + KEY_CODE_RABAIS + " VARCHAR(8) PRIMARY KEY," + KEY_MONTANT_RABAIS + " FLOAT,"
            + KEY_ID_TYPE + " INTEGER," + KEY_DESCRIPTION + " TEXT"
            + "FOREIGN KEY (" + KEY_ID_TYPE + ") REFERENCES " + TABLE_TYPE_RABAIS + "(" + KEY_ID +")" + ")";

    // produit table create statement
    private static final String CREATE_TABLE_PRODUIT = "CREATE TABLE " + TABLE_PRODUIT
            + "(" + KEY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT," + KEY_NOM + " VARCHAR(32),"
            + KEY_DESCRIPTION + " TEXT" + KEY_PRIX + " FLOAT" +")";

    // rabais_produit table create statement
    private static final String CREATE_TABLE_RABAIS_PRODUIT = "CREATE TABLE "
            + TABLE_RABAIS_PRODUIT + "(" + KEY_ID_PRODUIT + " INTEGER PRIMARY KEY,"
            + KEY_CODE_RABAIS + " VARCHAR(8)"
            + " FOREIGN KEY (" + KEY_ID_PRODUIT + ") REFERENCES "+ TABLE_PRODUIT + "("+ KEY_ID + ")"
            + " FOREIGN KEY (" + KEY_CODE_RABAIS + ") REFERENCES "+ TABLE_RABAIS + "("+ KEY_CODE_RABAIS + ")"+")";

    public moteur_requete_bd(Context context) {
        super(context, DATABASE_NAME, null, 1);
        SQLiteDatabase db = this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {

    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS client_table");
        db.execSQL("DROP TABLE IF EXISTS rabais_table");
        db.execSQL("DROP TABLE IF EXISTS type_rabais_table");

        onCreate(db);
    }

    // closing database
    public void closeDB() {
        SQLiteDatabase db = this.getReadableDatabase();
        if (db != null && db.isOpen())
            db.close();
    }
}
