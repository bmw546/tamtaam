package tamtam.tamtam;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

public class insertData {

    private moteur_requete_bd bd;
    private SQLiteDatabase mSQLiteDatabase;
    private Context mContext;

    public insertData(moteur_requete_bd bd, Context context) {
        this.bd = bd;
        mContext = context;
    }

    /**
     * Vérifie si pour une table, elle contient des données
     * @param databaseTable le nom de la table
     * @return retourne le nombre d'enregistrement dans la table
     */
    private int getCountTable(String databaseTable){
        Cursor c = null;
        mSQLiteDatabase = bd.getReadableDatabase();
        try {
            String query = "select count(*) from " + databaseTable;
            c = mSQLiteDatabase.rawQuery(query, null);
            if (c.moveToFirst()) {
                return c.getInt(0);
            }
            return 0;
        }
        finally {
            if (c != null) {
                c.close();
            }
            if (mSQLiteDatabase != null) {
                mSQLiteDatabase.close();
            }
        }
    }

    /**
     * Insere des donnée de toute les tables dans la base de donnée
     * si une table contient déja ces donnée, il le les ajoutent pas
     */
    public void insert() {

        //INSERT IN TABLE CLIENT
        if(getCountTable(bd.getTableClient()) == 0){
            bd.execution("INSERT INTO " + bd.getTableClient() + " (nom, mot_de_passe, courriel, adresse, telephone) VALUES ('bob', 'abc123', 'bob@bob.com', '475 Rue du Cegep, Sherbrooke, QC J1A 4K1', '8194441919')");
            bd.execution("INSERT INTO " + bd.getTableClient() + " (nom, mot_de_passe, courriel, adresse, telephone) VALUES ('Idremi', '=user123', 'remi@gmail.com', '597 Chemin Laurendeau, Magog, QC J1X 2W3', '8193455159')");
        }

        //INSERT IN TABLE TYPE RABAIS
        if (getCountTable(bd.getTableTypeRabais()) == 0) {
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableTypeRabais() + " (nom, description) VALUES ('montant', 'un rabais calculee en dollars')");
            bd.execution("INSERT INTO " + bd.getTableTypeRabais() + " (nom, description) VALUES ('pourcentage', 'un rabais calculee en pourcentage')");
        }

        //INSERT IN TABLE RABAIS
        if(getCountTable(bd.getTableRabais()) == 0){
//            bd.execution("INSERT INTO " + bd.getTableRabais() + " (code, montant_rabais, id_type, description, date_debut, date_fin) VALUES ('abc1', 10.00, 1, 'un rabais de 10$ sur un produit avec le code abc1.', '2018-05-11', '2018-07-11')");
//            bd.execution("INSERT INTO " + bd.getTableRabais() + " (code, montant_rabais, id_type, description, date_debut, date_fin) VALUES ('sav1', 5, 2, 'un rabais de 5% sur un produit avec le code sav1', '2018-06-13', '2018-08-13')");
        }

        //INSERT IN TABLE PRODUIT
        if (getCountTable(bd.getTableProduit()) == 0) {
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableProduit() + " (id, nom, description, prix) VALUES (1, 'Hibiscus', '230ML', 3.25)");
            bd.execution("INSERT INTO " + bd.getTableProduit() + " (id, nom, description, prix) VALUES (2, 'Hibiscus', '500ML', 7)");
            bd.execution("INSERT INTO " + bd.getTableProduit() + " (id, nom, description, prix) VALUES (3, 'Hibiscus', '1L', 12)");
            bd.execution("INSERT INTO " + bd.getTableProduit() + " (id, nom, description, prix) VALUES (4, 'Hibiscus', '2L', 22)");
            bd.execution("INSERT INTO " + bd.getTableProduit() + " (id, nom, description, prix) VALUES (5, 'Gingembre', '230ML', 3.25)");
            bd.execution("INSERT INTO " + bd.getTableProduit() + " (id, nom, description, prix) VALUES (6, 'Gingembre', '500ML', 7)");
            bd.execution("INSERT INTO " + bd.getTableProduit() + " (id, nom, description, prix) VALUES (7, 'Gingembre', '1L', 12)");
            bd.execution("INSERT INTO " + bd.getTableProduit() + " (id, nom, description, prix) VALUES (8, 'Gingembre', '2L', 22)");
        }

        //INSERT IN TABLE_RABAIS_PRODUIT
        if (getCountTable(bd.getTableRabaisProduit()) == 0) {
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableRabaisProduit() + " (id_produit, code_rabais) VALUES (4, 'abc1')");
            bd.execution("INSERT INTO " + bd.getTableRabaisProduit() + " (id_produit, code_rabais) VALUES (8, 'abc1')");
        }

        //INSERT IN TABLE EVENEMENT
        if (getCountTable(bd.getTableEvenement()) == 0) {
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableEvenement() + " (id, nom, date_debut, date_fin, description) VALUES (1, 'Noel', '2018-12-24', '2018-12-30', 'Un evenement pour les fêtes.')");
            bd.execution("INSERT INTO " + bd.getTableEvenement() + " (id, nom, date_debut, date_fin, description) VALUES (2, 'St-Valentin', '2018-02-14', '2018-02-15', 'Un evenement de la St-Valentin.')");
        }

        //INSERT IN TABLE TABLE_RECETTE
        if (getCountTable(bd.getTableRecette()) == 0) {
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableRecette() + " (id, nom, description) VALUES (1, 'jus Hibiscus', 'ingredient : fleurs hibiscus, fleur oranger, menthe verte et de la vanille.')");
            bd.execution("INSERT INTO " + bd.getTableRecette() + " (id, nom, description) VALUES (2, 'jus au Gingembre', 'A base de gingembre fraichement presse a froid et ananas, et cote herbacee de la menthe.')");
        }

        //INSERT IN TABLE TABLE_PRODUIT_RECETTE
        if (getCountTable(bd.getTableProduitRecette()) == 0) {
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableProduitRecette() + " (id_recette, id_produit) VALUES (1, 1)");
            bd.execution("INSERT INTO " + bd.getTableProduitRecette() + " (id_recette, id_produit) VALUES (1, 2)");
            bd.execution("INSERT INTO " + bd.getTableProduitRecette() + " (id_recette, id_produit) VALUES (1, 3)");
            bd.execution("INSERT INTO " + bd.getTableProduitRecette() + " (id_recette, id_produit) VALUES (1, 4)");
            bd.execution("INSERT INTO " + bd.getTableProduitRecette() + " (id_recette, id_produit) VALUES (2, 5)");
            bd.execution("INSERT INTO " + bd.getTableProduitRecette() + " (id_recette, id_produit) VALUES (2, 6)");
            bd.execution("INSERT INTO " + bd.getTableProduitRecette() + " (id_recette, id_produit) VALUES (2, 7)");
            bd.execution("INSERT INTO " + bd.getTableProduitRecette() + " (id_recette, id_produit) VALUES (2, 8)");
        }

        //INSERT IN TABLE TABLE_TYPE_COMMANDE
        if (getCountTable(bd.getTableTypeCommande()) == 0) {
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableTypeCommande() + " (id, description) VALUES (1, 'Livraison')");
            bd.execution("INSERT INTO " + bd.getTableTypeCommande() + " (id, description) VALUES (2, 'En magasin')");
        }

        //INSERT IN TABLE ETAT COMMANDE
        if(getCountTable(bd.getTableEtatCommande()) == 0){
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableEtatCommande() + " (nom, description) VALUES ('Livree', 'La commande a été livree.')");
            bd.execution("INSERT INTO " + bd.getTableEtatCommande() + " (nom, description) VALUES ('En livraison', 'La commande est en route.')");
        }

        //INSERT IN TABLE_COMMANDE
        if(getCountTable(bd.getTableCommande()) == 0){
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableCommande() + " (id, id_client, id_etat, id_type_commande, date, montant_commande, nom_personne) VALUES (1, 2, 1, 1, '2018-05-08', 3.25, 'idremi')");
            bd.execution("INSERT INTO " + bd.getTableCommande() + " (id, id_client, id_etat, id_type_commande, date, montant_commande, nom_personne) VALUES (2, 1, 2, 2, '2018-05-11', 3.25, 'Bob')");
        }

        //INSERT IN TABLE_PRODUIT_COMMANDE
        if(getCountTable(bd.getTableProduitCommande()) == 0){
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableProduitCommande() + " (id_produit, id_commande, nb_produit) VALUES (1, 1, 1)");
            bd.execution("INSERT INTO " + bd.getTableProduitCommande() + " (id_produit, id_commande, nb_produit) VALUES (4, 2, 1)");
        }

        //INSERT IN TABLE_LIVRAISON
        if(getCountTable(bd.getTableLivraison()) == 0){
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableLivraison() + " (id, id_commande, adresse_livraison, adresse_latitude, adresse_longitude, date_prevue, date_reel) VALUES (1, 2, '475 Rue du Cegep, Sherbrooke, QC J1A 4K1', 45.4111, -71.8863, 2018-05-11, 0000-00-00)");
            bd.execution("INSERT INTO " + bd.getTableLivraison() + " (id, id_commande, adresse_livraison, adresse_latitude, adresse_longitude, date_prevue, date_reel) VALUES (2, 1, '597 Chemin Laurendeau, Magog, QC J1X 3W4', 45.194456, -72.168831, 2018-05-08, 0000-00-00)");
        }

        //INSERT IN TABLE_NOTIFICATION
        if(getCountTable(bd.getTableNotification()) == 0){
            //perform inserting
            bd.execution("INSERT INTO " + bd.getTableNotification() + " (id, sms, notification, nouvelle, reception, etat, id_client) VALUES (1, 1, 1, 1, 1, 1, 1)");
            bd.execution("INSERT INTO " + bd.getTableNotification() + " (id, sms, notification, nouvelle, reception, etat, id_client) VALUES (2, 0, 1, 0, 0, 1, 2)");
        }
    }
}
