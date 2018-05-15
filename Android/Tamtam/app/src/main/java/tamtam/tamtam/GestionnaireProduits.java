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

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Color;
import android.provider.DocumentsContract;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.TableLayout;
import android.view.View;
import android.widget.TableRow;
import android.widget.Toast;

import java.io.FileNotFoundException;
import java.util.ArrayList;

public class GestionnaireProduits extends AppCompatActivity {

    TableLayout l;                 //Table des formats
    ArrayList<String> list_format; //Array des format
    ArrayList<String> list_prix;   //Array des prix


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        Bundle b = getIntent().getExtras();
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_produits);
        EditText produit = findViewById(R.id.nomProduit);
        l = findViewById(R.id.tl_produit);
        list_format = new ArrayList<>();
        list_prix = new ArrayList<>();

        //Vérifie si l'on est arrivé ici en selectionnant un produit
        if (b != null) {
            String nom = b.getString("nom");
            produit.setText(nom);
            produit.setFocusable(false);
            loadFormat(nom);
        }
        addLine();
    }

    public void addLine() {
        final TableRow row = (TableRow) LayoutInflater.from(GestionnaireProduits.this).inflate(R.layout.activity_row, null);
        final int index = list_format.size();
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
                                addLine();
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
                                    addLine();
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
        cursor.close();
    }

    //Sauvegarde les format dans la base de données
    public void sauvegarderProduit(View v) {
        Bundle b = getIntent().getExtras();
        moteur_requete_bd myBd;
        myBd = new moteur_requete_bd(this);
        EditText produit = findViewById(R.id.nomProduit);
        String str_produit = produit.getText().toString();

        //Si c'est un nouveau produit et non vide
        if (b == null && str_produit!= "" ){
            for (int i = 0; i< list_format.size();i++){
                myBd.execution("INSERT INTO produit ('nom','description','prix') VALUES ('" + str_produit + "','" +
                list_format.get(i) + "','"+ list_prix.get(i) + "')");
            }
            Intent intent = new Intent(this, ListeProduit.class);
            startActivity(intent);

        }
        //Si c'est un produit existant
        else if (str_produit!= ""){
            myBd.execution("DELETE FROM produit WHERE nom ='"+str_produit+"'");
            for (int i = 0; i<list_format.size();i++){
                myBd.execution("INSERT INTO produit ('nom','description','prix') VALUES ('" + str_produit + "','" +
                        list_format.get(i) + "','"+ list_prix.get(i) + "')");
            }
            Intent intent = new Intent(this, ListeProduit.class);
            startActivity(intent);
        }
        //Il n'y a rien a sauvegarder
        else{
            Toast.makeText(getApplicationContext(),
                    "Il n'y a rien a sauvegarder" , Toast.LENGTH_LONG)
                    .show();
        }
    }

    //Supprimer le produit de la base de données
    //TODO : Confirmation de la suppression
    public void supprimer(View v) {
        EditText produit = findViewById(R.id.nomProduit);
        final String str_produit = produit.getText().toString();

        if (str_produit != ""){
            AlertDialog.Builder builder = new AlertDialog.Builder(this);
            //Ajout du bouton Oui
            builder.setPositiveButton(R.string.oui, new DialogInterface.OnClickListener() {
                public void onClick(DialogInterface dialog, int id) {
                    moteur_requete_bd myBd;
                    myBd = new moteur_requete_bd(GestionnaireProduits.this);
                    myBd.execution("DELETE FROM produit WHERE nom ='"+str_produit+"'");
                    Intent intent = new Intent(GestionnaireProduits.this, ListeProduit.class);
                    startActivity(intent);
                }
            });
            //Ajout du bouton non
            builder.setNegativeButton(R.string.no, new DialogInterface.OnClickListener() {
                public void onClick(DialogInterface dialog, int id) {
                    // User cancelled the dialog
                }
            });
            // Modifie d'autres propriété du dialogue
            builder.setMessage("Êtes-vous certains de vouloir supprimer ce produit ?")
                    .setTitle("Suppression du produit");
            // Crée le dialogue
            AlertDialog dialog = builder.create();
            // Affiche la boite de dialogue
            builder.show();
        }
        else{
            Toast.makeText(getApplicationContext(),
                    "Il n'y a rien a supprimer" , Toast.LENGTH_LONG)
                    .show();
        }
    }
}