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
                Cursor result;
                boolean isFirstConstraint = true;
                String query = "SELECT `nb_produit`,`date`, `produit`.`nom`, `produit`.`description` FROM `ta_produit_commande` JOIN `commande` ON `commande`.`id`=`ta_produit_commande`.`id_commande` JOIN `produit` ON `produit`.`id` = `ta_produit_commande`.`id_produit`";

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
                        isFirstConstraint=false;
                    }
                    else{
                        query=query+" AND ";
                    }
                    query=query+"`commande`.`date`<'"+dateFin+"'";
                }
                result =moteurRequete.execution_with_return(query);

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
            }
        });

    }
}
