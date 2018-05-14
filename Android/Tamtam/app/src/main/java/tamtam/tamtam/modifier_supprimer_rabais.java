package tamtam.tamtam;

import android.app.DatePickerDialog;
import android.graphics.Color;
import android.graphics.Paint;
import android.graphics.drawable.ColorDrawable;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;

import java.util.Calendar;

public class modifier_supprimer_rabais extends AppCompatActivity {

    private EditText txtCode;
    private EditText txtValeur;
    private RadioGroup radioGroup;
    private RadioButton radioButton;
    private Button btnModifier;
    private Button btnSupprimer;
    private TextView dateDebut;
    private TextView dateFin;
    private char chkType;
    private String code;
    private float montant = 0;
    private char type;
    private String rabaisDateDebut;
    private String rabaisDateFin;
    private String description;
    private rabais rabaisSelectionne;
    //type (radio button, voir comment faire)

    private TextView txtDescription;

    private DatePickerDialog.OnDateSetListener dateDebutListener;
    private DatePickerDialog.OnDateSetListener dateFinListener;


    @Override
    protected void onCreate(Bundle savedInstanceState) {


        moteur_requete_bd myBd = new moteur_requete_bd(this); //create the local database

        Bundle b = getIntent().getExtras();
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_modifier_supprimer_rabais);

        txtCode = (EditText) findViewById(R.id.txt_code);
        txtValeur = (EditText) findViewById(R.id.valeur_rabais);
        //type (radio group/button)
        dateDebut = (TextView) findViewById(R.id.dateDebut);
        dateFin = (TextView) findViewById(R.id.dateFin);

        dateDebut.setPaintFlags(dateDebut.getPaintFlags() |   Paint.UNDERLINE_TEXT_FLAG);
        dateFin.setPaintFlags(dateFin.getPaintFlags() |   Paint.UNDERLINE_TEXT_FLAG);

        txtDescription = (EditText) findViewById(R.id.txtDescription);
        radioGroup = (RadioGroup) findViewById(R.id.radioGroup);
        //addListenerOnButton();


        //IMPORTANT: FAIRE CRÉER UN OBJET RABAIS AVEC CES INFOS POUR ÉVITER LA RÉPÉTITION
        code = b.getString("code");
        montant = b.getFloat("montant");
        type = b.getChar("type");
        rabaisDateDebut = b.getString("dateDebut");
        rabaisDateFin = b.getString("dateFin");
        description = b.getString("description");

        //    public rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, char type) {
        rabaisSelectionne = new rabais(code,montant, description,rabaisDateDebut,rabaisDateFin,type);
        txtCode.setText(code);
        txtValeur.setText(Float.toString(montant));

        if (type == '$'){
            radioGroup.check(R.id.radioBtn_dollar);
        }else if(type == '%'){
            radioGroup.check(R.id.radioBtn_pourcent);
        }

        txtDescription.setText(description);
        String dateDebutDecomposee[] = rabaisDateDebut.split("-");
        final int anneeDebut = Integer.parseInt(dateDebutDecomposee[0]);
        final int moisDebut = Integer.parseInt(dateDebutDecomposee[1]);
        final int jourDebut = Integer.parseInt(dateDebutDecomposee[2]);

        String date = moisDebut + "-"  + jourDebut + "-" + anneeDebut;
        dateDebut.setText(date);

        String dateFinDecomposee[] = rabaisDateFin.split("-");
        final int anneeFin = Integer.parseInt(dateFinDecomposee[0]);
        final int moisFin = Integer.parseInt(dateFinDecomposee[1]);
        final int jourFin = Integer.parseInt(dateFinDecomposee[2]);

        date = moisFin + "-"  + jourFin + "-" + anneeFin;
        dateFin.setText(date);

        dateDebut.setOnClickListener(new View.OnClickListener() {
            @Override
            //je vais devoir rajouter + tard quand je cliques sur une partir à la date qui etait setée précedemment et non
            //le reste... bref, à voir
            public void onClick(View v) {
                Calendar cal = Calendar.getInstance();
                int annee = cal.get(Calendar.YEAR);
                int mois = cal.get(Calendar.MONTH);
                int jour = cal.get(Calendar.DAY_OF_MONTH);

                DatePickerDialog dialog = new DatePickerDialog(
                        modifier_supprimer_rabais.this,android.R.style.Theme_Holo_Dialog_MinWidth,
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
                        modifier_supprimer_rabais.this,android.R.style.Theme_Holo_Dialog_MinWidth,
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

    public void supprimerRabais(View view){
        GestionnaireRabais gest = new GestionnaireRabais();
        moteur_requete_bd myBD = new moteur_requete_bd(this);
        gest.init(myBD);
        gest.supprimerRabais(rabaisSelectionne);
        Toast.makeText(this,"Le rabais a été supprimé.", Toast.LENGTH_LONG).show();


    }

    public void modifierRabais(View view) {
        GestionnaireRabais gest = new GestionnaireRabais();
        moteur_requete_bd myBD = new moteur_requete_bd(this);
        gest.init(myBD);
        //code
        String newCode = txtCode.getText().toString();

        //type
        int selectedId = radioGroup.getCheckedRadioButtonId();
        radioButton = (RadioButton) findViewById(selectedId);
        char newType = radioButton.getText().charAt(0);

        //montant
        float newMontant = Float.parseFloat(txtValeur.getText().toString());

        //description
        String newDescription = txtDescription.getText().toString();

        //date debut
        String newDateDebut = dateDebut.getText().toString();

        //date fin
        String newDateFin = dateFin.getText().toString();

        //rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, char type)
        rabais newRabais = new rabais(newCode, newMontant, newDescription, newDateDebut, newDateFin, newType);

        if (gest.modifierRabais(code, newRabais)){
            Toast.makeText(this,"Le rabais a été modifé", Toast.LENGTH_LONG).show();
        }else{
            Toast.makeText(this,"Ce code est déja utilisé par un autre rabais.", Toast.LENGTH_LONG).show();
        }

    }

    //bouton supprimer à coder


    //bouton modifier à coder (commencement ci-dessous) (pas correct, voir btnAjouter dans ui_sous_menu_rbais/sous_menu_rabais
    /*public void addListenerOnButton() {

        radioGroup = (RadioGroup) findViewById(R.id.radioGroup);
        btnModifier = (Button) findViewById(R.id.btn_modifier);

        btnModifier.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {

                // get selected radio button from radioGroup
                int selectedId = radioGroup.getCheckedRadioButtonId();

                // find the radiobutton by returned id
                radioButton = (RadioButton) findViewById(selectedId);
                chkType = radioButton.getText().charAt(0);

                // rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, char type)
                rabais r = new rabais(txtCode.getText().toString(), Float.parseFloat(txtValeur.getText().toString()), txtDescription.getText().toString(),
                        dateDebut.getText().toString(), dateFin.getText().toString(), chkType);


                GestionnaireRabais gest = new GestionnaireRabais();
                //va l'ajouter dans la bd
                gest.ajouterRabais(r);
            }

        });

    }*/
}
