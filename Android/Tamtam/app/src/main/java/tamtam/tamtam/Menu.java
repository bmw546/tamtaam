/********************************************************
 Fichier : menu.java
 Auteur : Remi
 Fonctionnalité : Menu de l'application
 Date : 2018-05-07

 Vérification :
 Date               Nom                   Approuvé
 =========================================================


 Historique de modifications :
 Date               Nom                   Description
 =========================================================

 *********************************************************/
package tamtam.tamtam;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;

public class menu extends AppCompatActivity {

    private moteur_requete_bd myBd;  //permet la gestion de la base de donnée

    /**
     * Méthode appelé lors du démarage de l'application
     * @param savedInstanceState utilisé pour gérer des donnée entre les activitéss
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_menu); //lien avec fichier xml

        myBd = new moteur_requete_bd(this); //Crée la base de donnée

        //insere des donnée dans la base de donnée une seule fois.
        insertData insertData = new insertData(myBd,this);
        insertData.insert();
    }

    /**
     * Affiche l'interface de la gestion des client
     * @param view le bouton gestion client du menu
     */
    public void showClient(View view){
        Intent intent = new Intent(this, GestionnaireClient.class);
        startActivity(intent);
    }

    /**
     * Affiche l'interface de gestion des livraison
     * @param view le bouton gestion livraison du menu
     */
    public void showLivraison(View view){
        Intent intent = new Intent(this, gestionnaire_livraison.class);
        startActivity(intent);
    }

    /**
     * Affiche l'interface de la gestion des produits
     * @param view le bouton gestion produit du menu
     */
    public void showProduit(View view){
        Intent intent = new Intent(this, ListeProduit.class);
        startActivity(intent);
    }

    /**
     * Affiche l'interface de gestion des recettes
     * @param view le bouton gestion recette du menu
     */
    public void showRecette(View view){
        Intent intent = new Intent(this, GestionnaireRecette.class);
        startActivity(intent);
    }

    /**
     * Affiche l'interface de gestion des rabais
     * @param view  le bouton gestion rabais du menu
     */
    public void showRabais(View view){
        Intent intent = new Intent(this, sousMenu_rabais.class);
        startActivity(intent);
    }

    /**
     * Affiche l'interface de gestion des notification
     * @param view le bouton gestion notification du menu
     */
    public void showNotification(View view){
        Intent intent = new Intent(this, GestionnaireNotification.class);
        startActivity(intent);
    }

    /**
     * Affihce l'interface des rapports
     * @param view le bouton gestion rapports du menu
     */
    public void showRapport(View view){
        Intent intent = new Intent(this, GestionnaireRapport.class);
        startActivity(intent);
    }

    /**
     * Affiche l'interface des sauvegardes
     * @param view le bouton gestion sauvegardes du menu
     */
    public void showSauvegarde(View view){
        Intent intent = new Intent(this, GestionnaireSauvegarde.class);
        startActivity(intent);
    }
}
