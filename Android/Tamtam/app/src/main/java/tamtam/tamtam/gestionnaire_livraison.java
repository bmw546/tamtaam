package tamtam.tamtam;

import android.app.ListActivity;
import android.content.Intent;
import android.database.Cursor;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.maps.model.LatLng;

import java.util.ArrayList;
import java.util.List;

public class gestionnaire_livraison extends ListActivity {

    private moteur_requete_bd myBd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        myBd = new moteur_requete_bd(this); //create the local database
        super.onCreate(savedInstanceState);


        // prend les donné de la BD
        final ArrayList<String> list = new ArrayList<String>();
        final ArrayList<String> nom = new ArrayList<String>();
        final ArrayList<Integer> chiffre = new ArrayList<Integer>();
        final List<Double> prix = new ArrayList<Double>();
        final ArrayList<String> etat = new ArrayList<String>();
        myBd = new moteur_requete_bd(this); //create the local database

        //--------------------------------
        Cursor result = myBd.execution_with_return("SELECT * FROM " + myBd.getTableCommande());

        for (result.moveToFirst(); !result.isAfterLast(); result.moveToNext()) {
            //public rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, char type) {
            nom.add(result.getString(result.getColumnIndex("nom_personne")));
            prix.add(result.getDouble(result.getColumnIndex("montant_commande")));
            int id = result.getInt(result.getColumnIndex("id_etat"));
            Cursor result2 = myBd.execution_with_return("SELECT nom FROM " + myBd.getTableEtatCommande() + " WHERE id==" + id);
            etat.add(result2.getString(result2.getColumnIndex("nom")));
            chiffre.add(result.getInt(result.getColumnIndex("id")));
            list.add(result.getString(result.getColumnIndex("id"))+ "  " + result.getString(result.getColumnIndex("nom_personne")) + "  " +  result.getDouble(result.getColumnIndex("montant_commande")) + "     " + result2.getString(result2.getColumnIndex("nom")) );
        }

        setListAdapter(new ArrayAdapter<String>(this, R.layout.ui_livraison,list));

        ListView listView = getListView();
        listView.setTextFilterEnabled(true);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            public void onItemClick(AdapterView<?> parent, View view,
                                    int position, long id) {
                Intent intent = new Intent(view.getContext(), livraison_detail.class);
                Bundle b = new Bundle();


                b.putInt("key", chiffre.get(position)); //Your id
                b.putDouble("montant",prix.get(position));
                b.putString("nom",nom.get(position));
                b.putString("etat",etat.get(position));
                intent.putExtras(b); //Put your id to your next Intent
                startActivity(intent);
                finish();
            }
        });
    }
}