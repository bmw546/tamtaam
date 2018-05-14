package tamtam.tamtam;

import android.app.DatePickerDialog;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;
import android.app.Activity;

import java.util.Calendar;

public class ui_ajouter_rabais extends AppCompatActivity {

    private static final String TAG = "ui_ajouter_rabais";
    private EditText code;
    private EditText rabais;
    private EditText description;
    private TextView dateDebut;
    private TextView dateFin;
    private DatePickerDialog.OnDateSetListener dateDebutListener;
    private DatePickerDialog.OnDateSetListener dateFinListener;

    /*private RadioGroup radioGroup;
    private RadioButton radioButton;
    private Button btnAjouter;
    private char type;
    private TextView txtDescription;
    private EditText txtCode;
    private EditText txtValeur;*/

    /*public void ajouterRabais()
    {
        rabais newRabais = new rabais();
    }*/

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_ajouter_rabais);
        /*txtCode = (EditText) findViewById(R.id.txt_code);
        txtValeur = (EditText) findViewById(R.id.valeur_rabais);
        txtDescription = (EditText) findViewById(R.id.txtDescription);*/
        dateDebut = (TextView) findViewById(R.id.dateDebut);
        dateFin = (TextView) findViewById(R.id.dateFin);

        //addListenerOnButton();

        dateDebut.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Calendar cal = Calendar.getInstance();
                int annee = cal.get(Calendar.YEAR);
                int mois = cal.get(Calendar.MONTH);
                int jour = cal.get(Calendar.DAY_OF_MONTH);

                DatePickerDialog dialog = new DatePickerDialog(
                        ui_ajouter_rabais.this,android.R.style.Theme_Holo_Dialog_MinWidth,
                        dateDebutListener, annee, mois, jour);

                dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                dialog.show();

            }
        });

        dateFin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Calendar cal = Calendar.getInstance();
                int annee = cal.get(Calendar.YEAR);
                int mois = cal.get(Calendar.MONTH);
                int jour = cal.get(Calendar.DAY_OF_MONTH);

                DatePickerDialog dialog = new DatePickerDialog(
                        ui_ajouter_rabais.this,android.R.style.Theme_Holo_Dialog_MinWidth,
                        dateFinListener, annee, mois, jour);

                dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                dialog.show();

            }
        });

        dateDebutListener = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker view, int annee, int mois, int jour) {
                mois++;
                String date = mois + "/"  + jour + "/" + annee;
                dateDebut.setText(date);
            }
        };

        dateFinListener = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker view, int annee, int mois, int jour) {
                mois++;
                String date = mois + "/"  + jour + "/" + annee;
                dateFin.setText(date);
            }
        };

    }

    public void nouveauRabais(View view) {
        //saisir tt les textboxs et les mettre dans un rabais
        rabais r = new rabais();
        GestionnaireRabais gest = new GestionnaireRabais();
        moteur_requete_bd myBD = new moteur_requete_bd(this);
        gest.init(myBD);

        if(gest.ajouterRabais(r)){
            Toast.makeText(this, "Le rabais a été ajouté", Toast.LENGTH_LONG).show();
        }else{
            Toast.makeText(this, "Ce code est déja utilisé", Toast.LENGTH_LONG).show();
        }
    }
    //bouton ajouter à coder (ci-dessous)
    /*public void addListenerOnButton() {

        radioGroup = (RadioGroup) findViewById(R.id.radio);
        btnAjouter = (Button) findViewById(R.id.btnAjouter);

        btnAjouter.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {

                // get selected radio button from radioGroup
                int selectedId = radioGroup.getCheckedRadioButtonId();

                // find the radiobutton by returned id
                radioButton = (RadioButton) findViewById(selectedId);
                type = (String) radioButton.getText();

                // rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, char type)
                rabais r = new rabais(txtCode.getText().toString(), Float.parseFloat(txtValeur.getText().toString()), txtDescription.getText().toString(),
                        dateDebut.getText().toString(), dateFin.getText().toString(), type.charAt(0) );

                GestionnaireRabais gest = new GestionnaireRabais();
                //va l'ajouter dans la bd
                gest.ajouterRabais(r);
            }

        });

    }*/

}
/*
 * liste de produit (id, prix, nom)
 * date debut
 * date fin
 * rabais (ex: 20, 10, etc.)
 * type de rabais: (% ou $)
 * prixApresRabais*/

/*
 * calculer prix après rabais:
 * Si type = %,  prixRabais = rabais * (prixProduit/100)
 * prixApresRabais = prixPoduit - prixRabais
 *
 * Sinon si le type=$
 * prixApresRabais = prixProduit - rabais
 *
 */

    /*Init:
    Faire un select pour tout les produits, les mettres dans un objet produit
    *ou on sauvegarde la clé primaire + nom + prix
    *Mettre chaque objet dans la liste déroulante https://stackoverflow.com/questions/1625249/android-how-to-bind-spinner-to-custom-object-list
    * */

/*Plan rabais:
*
* Liste des rabais: contient la liste de tous les rabais (code, type, produit)
*
* Ajouter (le user clique sur ajoute un rabais dans la liste des rabsi):
* on rajoute un nouveau rabais (clé primaire = code)
* Valider que le code n'existe pas déja dans la bd.
 * On se crée un objet produit dans le gestionnaire qui va contenir le produit sélectionné
 * On saisie la date de début et la date de fin
 * On saisit le rabait de si c'est un % ou $
 * On affiche le prix original
 * On calcule le prix après rabais avec le rabais et on l'affiche*/


/*Modifier: */
/*Dans la liste des rabais, l'utilisateur sélectione un rabaos
(radio button, ou trouver une autre façon tant qu'il puisse n'en sélectionner qu'un)
L'utilisateur clique sur le bouton modifier. On saisie alors l'id qui correspond
au produit sélectionné et on select toute sles infos qu'on a besoin et on les
affiche dans l'interface


Supprimmer:
Dans la liste des rabais, l'utilisateur sélectione un rabaos
(radio button, ou trouver une autre façon tant qu'il puisse n'en sélectionner qu'un)
L'utilisateur clique sur le bouton supprimer. On supprime le rabais de la liste et de la bd.
On monte tous les rabais qui etaient en dessous d'une case.
(il se peut que ça se fasse automatiquement avec l'objet liste, à voir

Note (important): Rajouter un rabais avec un produit directement ou tout simplement
créer un rabais et ensuite y ajouté un produit?
Créer un bouton ajouter un rabais à un produit?
Sinon, créer un rabais avec un produit, et donner l'option de rajouter un rabais à un produit
dans gestionProduit? + rajouter un bouton dans ajouter/modifier un produit*/


/*
* manifext.xml:
* <activity>
*     android:name=".ui_ajouter_rabais"
*     android:label="@string/title_activity_ui_rabais"
*     invisible shit..  "@style/AppTheme.NoActionBar"></activity>*/
