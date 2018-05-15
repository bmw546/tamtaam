/****************************************
 Fichier : GestionnaireProduits.java
 Auteur : Joel Lapointe
 Fonctionnalité : gestion des produits
 Date : 7 mai 2018

 Vérification :
 Date               Nom                   Approuvé
 =========================================================


 Historique de modifications :
 Date               Nom                   Description
 =========================================================

 ****************************************/

package tamtam.tamtam;

import android.app.ListActivity;
import android.database.Cursor;
import android.graphics.Typeface;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.InputFilter;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TableLayout;
import android.widget.TableRow.LayoutParams;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.app.Activity;
import android.widget.ListView;
import android.content.Intent;
import android.widget.TableRow;
import android.widget.TextView;

import java.util.ArrayList;

public class GestionnaireProduits extends AppCompatActivity {

    private int counter;
    TableLayout l;
    ArrayList<String> list_format;
    ArrayList<String> list_prix;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        Bundle b = getIntent().getExtras();
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_produits);
        EditText produit = (EditText) findViewById(R.id.nomProduit);
        l = (TableLayout) findViewById(R.id.tl_produit);
        list_format = new ArrayList<String>();
        list_prix = new ArrayList<String>();

        if (b != null) {
            String nom = b.getString("nom");
            produit.setText(nom);
            produit.setFocusable(false);
            loadFormat(nom);
        }
        TableRow row = (TableRow) LayoutInflater.from(GestionnaireProduits.this).inflate(R.layout.activity_row, null);
        ((CheckBox) row.findViewById(R.id.attrib_check)).setOnCheckedChangeListener(
                new CompoundButton.OnCheckedChangeListener() {
                    @Override
                    public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                        if (isChecked) {
                                addFormat();
                            }
                        }
                }
        );
        l.addView(row);

    }

    public void addFormat() {
        final TableRow row = (TableRow) LayoutInflater.from(GestionnaireProduits.this).inflate(R.layout.activity_row, null);
        final int index = list_format.size()-1;
        ((CheckBox) row.findViewById(R.id.attrib_check)).setOnCheckedChangeListener(
                new CompoundButton.OnCheckedChangeListener() {
                    @Override
                    public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                        if (isChecked) {
                            {
                                String format  = ((EditText) row.findViewById(R.id.attrib_format)).getText().toString();
                                list_format.add(format);
                                String prix = ((EditText) row.findViewById(R.id.attrib_prix)).getText().toString();
                                list_prix.add(prix);
                                addFormat();
                            }
                        }
                        if (!isChecked){
                            list_format.remove(index);
                            list_prix.remove(index);
                        }
                    }
                }
        );
        l.addView(row);
    }

    public void loadFormat(String nom) {
        moteur_requete_bd myBd;
        myBd = new moteur_requete_bd(this);
        Cursor cursor = myBd.execution_with_return("SELECT description,prix FROM produit WHERE nom = '" + nom + "'");
        int i = 0;
        do {
            final String format = cursor.getString(cursor.getColumnIndex("description"));
            final String prix = cursor.getString(cursor.getColumnIndex("prix"));
            list_format.add(format);
            list_prix.add(prix);
            final int index = i;
            TableRow row = (TableRow) LayoutInflater.from(GestionnaireProduits.this).inflate(R.layout.activity_row, null);
            ((EditText) row.findViewById(R.id.attrib_format)).setText(format);
            ((EditText) row.findViewById(R.id.attrib_prix)).setText(prix);
            ((CheckBox) row.findViewById(R.id.attrib_check)).setChecked(true);
            ((CheckBox) row.findViewById(R.id.attrib_check)).setOnCheckedChangeListener(
                    new CompoundButton.OnCheckedChangeListener() {
                        @Override
                        public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                            if (isChecked) {
                                {
                                    list_format.add(format);
                                    list_prix.add(prix);
                                    addFormat();
                                }
                            }
                            if (!isChecked){
                                list_format.remove(index);
                                list_prix.remove(index);
                            }
                        }
                    }
            );
            i++;
            l.addView(row);
        } while (cursor.moveToNext());
        counter = i;
        cursor.close();
    }

    public void sauvegarderProduit(View v) {
        Bundle b = getIntent().getExtras();
        moteur_requete_bd myBd;
        myBd = new moteur_requete_bd(this);
        EditText produit = (EditText) findViewById(R.id.nomProduit);
        String str_produit = produit.getText().toString();
        if (b == null){
            for (int i = 0; i< list_format.size();i++){
                myBd.execution("INSERT INTO produit ('nom','description','prix') VALUES '" + str_produit + "','" +
                list_format.get(i) + "','"+ list_prix.get(i) + "'");
            }
        }
        else if (str_produit!= ""){
            myBd.execution("DELETE FROM produit WHERE nom ='"+str_produit+"'");
            for (int i = 0; i<list_format.size();i++){
                myBd.execution("INSERT INTO produit ('nom','description','prix') VALUES '" + str_produit + "','" +
                        list_format.get(i) + "','"+ list_prix.get(i) + "'");
            }
        }
    }
    //TODO : Confirmation de la suppression
    public void supprimer(View v) {
        EditText produit = (EditText) findViewById(R.id.nomProduit);
        String str_produit = produit.getText().toString();

        if (str_produit != ""){
            moteur_requete_bd myBd;
            myBd = new moteur_requete_bd(this);
            myBd.execution("DELETE FROM produit WHERE nom ='"+str_produit+"'");
        }
    }
}