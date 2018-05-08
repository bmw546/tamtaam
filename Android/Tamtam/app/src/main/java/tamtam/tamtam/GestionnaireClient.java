package tamtam.tamtam;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

public class GestionnaireClient extends AppCompatActivity {

    private Moteur_requete_bd myBd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_client);
        myBd = new Moteur_requete_bd(this); //create the local database
    }
}
