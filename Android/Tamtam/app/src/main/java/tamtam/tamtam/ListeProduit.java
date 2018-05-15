package tamtam.tamtam;

import android.app.Activity;
import android.app.ListActivity;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;

public class ListeProduit extends ListActivity {
    ArrayList<String> listItems=new ArrayList<String>();
    ArrayAdapter<String> adapter;


    @Override
    public void onCreate(Bundle icicle) {
        super.onCreate(icicle);
        setContentView(R.layout.ui_liste_produit);

        //Récupere les differents produits
        moteur_requete_bd myBd;
        myBd = new moteur_requete_bd(this);
        Cursor cursor = myBd.execution_with_return("SELECT DISTINCT nom FROM produit");
        do{
            listItems.add(cursor.getString(0));
        }while (cursor.moveToNext());
        cursor.close();

        adapter=new ArrayAdapter<String>(this,
                android.R.layout.simple_list_item_1,
                listItems);
        setListAdapter(adapter);
        ListView prodListView = getListView();
        prodListView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                String nom = (String) parent.getItemAtPosition(position);
                Intent contentIntent = new Intent(ListeProduit.this, GestionnaireProduits.class);
                Bundle bundle = new Bundle();
                bundle.putString("nom",nom);
                contentIntent.putExtras(bundle);
                startActivity(contentIntent);
            }
        });
    }

    //METHOD WHICH WILL HANDLE DYNAMIC INSERTION
    public void addItems(View v) {
        Intent intent = new Intent(this, GestionnaireProduits.class);
        startActivity(intent);
    }
}




