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
    ArrayList list_format;
    ArrayList list_prix;
    final int CHECK_BUTTON_ID = 1234;
    int ids_check[];
    boolean bool_check[];

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        Bundle b = getIntent().getExtras();
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_produits);
        EditText produit = (EditText) findViewById(R.id.nomProduit);
        l = (TableLayout) findViewById(R.id.tl_produit);
        if (b != null) {
            String nom = b.getString("nom");
            produit.setText(nom);
            loadFormat(nom);
        }
        TableRow row = (TableRow) LayoutInflater.from(GestionnaireProduits.this).inflate(R.layout.activity_row, null);
        l.addView(row);



        counter = l.getChildCount();
    }

    public void addFormat() {

        TextView t1 = new TextView(this);
        t1.setHint("Format");
        TextView t2 = new TextView(this);
        t2.setHint("$");
        t2.setFilters(new InputFilter[]{new CurrencyFormatInputFilter()});
        CheckBox box = new CheckBox(this);

        box.setChecked(false);
        box.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            public void onCheckedChanged(CompoundButton arg0, boolean arg1) {
                if (arg0.isChecked() == true) {

                } else {
                }
            }
        });
    }

    public void loadFormat(String nom) {
        moteur_requete_bd myBd;
        myBd = new moteur_requete_bd(this);
        Cursor cursor = myBd.execution_with_return("SELECT description,prix FROM produit WHERE nom = '" + nom + "'");
        do {
            String format = cursor.getString(cursor.getColumnIndex("description"));
            String prix = cursor.getString(cursor.getColumnIndex("prix"));
            list_format.add("format");
            list_prix.add("prix");
            TableRow row = (TableRow) LayoutInflater.from(GestionnaireProduits.this).inflate(R.layout.activity_row, null);
            ((EditText) row.findViewById(R.id.attrib_format)).setText(format);
            ((EditText) row.findViewById(R.id.attrib_prix)).setText(prix);
            ((CheckBox) row.findViewById(R.id.attrib_check)).setChecked(true);
            ((CheckBox) row.findViewById(R.id.attrib_check)).setOnCheckedChangeListener(
                    new CompoundButton.OnCheckedChangeListener() {
                        @Override
                        public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                            if (isChecked) {
                                ;
                            }

                        }
                    }
            );
            l.addView(row);
        } while (cursor.moveToNext());
        cursor.close();
    }

    //TODO
    public void sauvegarder() {
        Bundle b = getIntent().getExtras();
        moteur_requete_bd myBd;
        myBd = new moteur_requete_bd(this);

        if (b == null){
            EditText produit = (EditText) findViewById(R.id.nomProduit);
            String str_produit = produit.getText().toString();


            //for each checked row in table
                myBd.execution("INSERT INTO produit ('nom','description',prix) VALUES " + str_produit + "");

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