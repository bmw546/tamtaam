package tamtam.tamtam;

import android.content.Intent;
import android.database.Cursor;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.Button;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class GestionnaireRapport extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.ui_rapport);

        final Intent intent= new Intent(this,Rapport.class);
        final moteur_requete_bd moteurRequete = new moteur_requete_bd(this);
        final Button btnVisionner = findViewById(R.id.buttonVisionner);

        //commence la recherche
        btnVisionner.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                //initialisation des paramètres
                EditText txtDateDebut = findViewById(R.id.txt_dateDebut);
                String dateDebut = String.valueOf(txtDateDebut.getText());
                EditText txtDateFin = findViewById(R.id.txt_dateFin);
                String dateFin = String.valueOf(txtDateFin.getText());
                EditText txtProduits = findViewById(R.id.txt_produits);
                String produits = String.valueOf(txtProduits.getText());
                Cursor result;
                boolean isFirstConstraint = true;
                //query de base
                String query = "SELECT `nb_produit`,`date`, `produit`.`nom`, `produit`.`description` FROM `ta_produit_commande` JOIN `commande` ON `commande`.`id`=`ta_produit_commande`.`id_commande` JOIN `produit` ON `produit`.`id` = `ta_produit_commande`.`id_produit`";

                //ajoute seulement les paramètres requis à la query
                if(!produits.equals("")){
                    isFirstConstraint=false;
                    query = query+" WHERE `produit`.`nom`='"+ produits+"'";
                }

                if(!dateDebut.equals("")){
                    if(isFirstConstraint){
                        query=query+" WHERE ";
                        isFirstConstraint=false;
                    }
                    else{
                        query=query+" AND ";
                    }
                    query=query+"`commande`.`date`>'"+dateDebut+"'";
                }

                if(!dateFin.equals("")){
                    if(isFirstConstraint){
                        query=query+" WHERE ";
                    }
                    else{
                        query=query+" AND ";
                    }
                    query=query+"`commande`.`date`<'"+dateFin+"'";
                }
                //execute la query
                result =moteurRequete.execution_with_return(query);

                //Batit une array de string pour créer la liste
                if(result.getCount() > 0){
                    String[] rapport = new String[result.getCount()];
                    String dateCommande;
                    if(result.moveToFirst()){
                        int count = 0;
                        do{
                            dateCommande = result.getString(result.getColumnIndex("date"))+"  "+result.getString(result.getColumnIndex("nom"))
                            +" "+result.getString(result.getColumnIndex("description"))+ "  "+result.getString(result.getColumnIndex("nb_produit"));
                            rapport[count] = dateCommande;
                            count++;
                        }while(result.moveToNext());

                        intent.putExtra("rapport",rapport);
                    }
                    startActivity(intent);
                }
                else{
                    Toast.makeText(getApplicationContext(),
                            "Aucun resultats" , Toast.LENGTH_LONG)
                            .show();
                }
            }
        });

    }
}
