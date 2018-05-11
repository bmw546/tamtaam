package tamtam.tamtam;

import android.content.Intent;
import android.database.Cursor;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.Button;
import android.view.View;
import android.widget.EditText;

public class GestionnaireRapport extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.ui_rapport);

        final Intent intent= new Intent(this,Rapport.class);
        final moteur_requete_bd moteurRequete = new moteur_requete_bd(this);
        final Button button = findViewById(R.id.buttonVisionner);
        button.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                // Code here executes on main thread after user presses button
                EditText txtDateDebut = findViewById(R.id.txt_dateDebut);
                String dateDebut = String.valueOf(txtDateDebut.getText());
                EditText txtDateFin = findViewById(R.id.txt_dateFin);
                String dateFin = String.valueOf(txtDateFin.getText());
                EditText txtProduits = findViewById(R.id.txt_produits);
                String produits = String.valueOf(txtProduits.getText());
                Cursor result =moteurRequete.execution_with_return("SELECT `nb_produit`,`date` FROM `ta_produit_commande` JOIN `commande` ON `commande`.`id`=`ta_produit_commande`.`id_commande` JOIN `produit` ON `produit`.`id` = `ta_produit_commande`.`id_produit` WHERE `produit`.`nom`='"+ produits +"' AND `commande`.`date`>'"+dateDebut+"' AND `commande`.`date`<'"+dateFin+"'");
                if(result != null){
                    String dateCommande;
                    if(result.moveToFirst()){
                        dateCommande = result.getString(result.getColumnIndex("date"));
                        intent.putExtra("dateCommande",dateCommande);
                    }
                    startActivity(intent);
                }
            }
        });

    }
}
