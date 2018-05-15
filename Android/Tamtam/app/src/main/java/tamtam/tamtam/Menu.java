package tamtam.tamtam;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

public class menu extends AppCompatActivity {

    private moteur_requete_bd myBd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_menu);

        myBd = new moteur_requete_bd(this); //create the local database

        //insere des donnée dans la base de donnée une seule fois.
        insertData insertData = new insertData(myBd,this);
        insertData.insert();
    }

    // Évévenement POUR LES BUTTON
    public void showClient(View view){
        Intent intent = new Intent(this, GestionnaireClient.class);
        startActivity(intent);
    }
    public void showProduit(View view){
        Intent intent = new Intent(this, ListeProduit.class);
        startActivity(intent);
    }
    public void showRecette(View view){
        Intent intent = new Intent(this, GestionnaireRecette.class);
        startActivity(intent);
    }

    public void showNotification(View view){
        Intent intent = new Intent(this, GestionnaireNotification.class);
        startActivity(intent);
    }
    public void showRapport(View view){
        Intent intent = new Intent(this, GestionnaireRapport.class);
        startActivity(intent);
    }
    public void showSauvegarde(View view){
        Intent intent = new Intent(this, GestionnaireSauvegarde.class);
        startActivity(intent);
    }
    public void showRabais(View view){
        Intent intent = new Intent(this, sousMenu_rabais.class);
        startActivity(intent);
    }
    public void showLivraison(View view){
        Intent intent = new Intent(this, gestionnaire_livraison.class);
        startActivity(intent);
    }
    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------

}
