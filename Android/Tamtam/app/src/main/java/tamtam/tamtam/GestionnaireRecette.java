package tamtam.tamtam;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class GestionnaireRecette extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_recette);

        final moteur_requete_bd moteurRequete = new moteur_requete_bd(this);

        final Button btnSauvegarder = findViewById(R.id.btnSauvegarder);
        final Button btnSupprimer = findViewById(R.id.btnSupprimer);

        //créer une nouvelle recette
        btnSauvegarder.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                EditText txtNom = findViewById(R.id.txtNom);
                EditText txtDescription = findViewById(R.id.txtDescription);

                String nom = String.valueOf(txtNom.getText());
                String description = String.valueOf(txtDescription.getText());

                //s'applique seulement si il y a un nom et une description
                if(!nom.equals("")&&!description.equals("")){
                    moteurRequete.execution("INSERT INTO `recette`(`nom`, `description`) VALUES ('"+nom+"','"+description+"')");
                    Toast.makeText(getApplicationContext(),
                            "Sauvegarde efectuee" , Toast.LENGTH_LONG)
                            .show();
                }
                else{
                    Toast.makeText(getApplicationContext(),
                            "Veuillez entrer un nom et une description" , Toast.LENGTH_LONG)
                            .show();
                }
            }
        });

        //supprimer une recette
        btnSupprimer.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                EditText txtNom = findViewById(R.id.txtNom);
                String nom = String.valueOf(txtNom.getText());

                //s'applique seulement si il y a un nom
                if(!nom.equals("")){
                    moteurRequete.execution("DELETE FROM `recette` WHERE `nom`='"+nom+"'");
                    Toast.makeText(getApplicationContext(),
                            "Supression efectuee" , Toast.LENGTH_LONG)
                            .show();
                }
                else{
                    Toast.makeText(getApplicationContext(),
                            "Veuillez entrer un nom" , Toast.LENGTH_LONG)
                            .show();
                }
            }
        });
    }
}
