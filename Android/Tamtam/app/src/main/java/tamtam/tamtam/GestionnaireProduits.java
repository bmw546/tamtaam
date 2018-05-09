package tamtam.tamtam;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

public class GestionnaireProduits extends AppCompatActivity {

    private moteur_requete_bd myBd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_produits);
        myBd = new moteur_requete_bd(this); //create the local database
    }



}
