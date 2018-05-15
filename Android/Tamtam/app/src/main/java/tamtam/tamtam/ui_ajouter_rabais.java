package tamtam.tamtam;

import android.app.DatePickerDialog;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.KeyEvent;
import android.view.View;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;

import java.util.Calendar;

public class ui_ajouter_rabais extends AppCompatActivity {

    private static final String TAG = "ui_ajouter_rabais";
    private EditText code;
    private EditText montant;
    private EditText description;
    private TextView dateDebut;
    private TextView dateFin;
    private RadioGroup radioGroup;
    private RadioButton radioButton;
    private DatePickerDialog.OnDateSetListener dateDebutListener;
    private DatePickerDialog.OnDateSetListener dateFinListener;


    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event)  {
        if (keyCode == KeyEvent.KEYCODE_BACK ) {
            Intent intent = new Intent(this, sousMenu_rabais.class);
            startActivity(intent);
            return true;
        }
        return super.onKeyDown(keyCode, event);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_ajouter_rabais);
        code = (EditText) findViewById(R.id.txt_code);
        montant = (EditText) findViewById(R.id.valeur_rabais);
        description = (EditText) findViewById(R.id.txtDescription) ;
        dateDebut = (TextView) findViewById(R.id.dateDebut);
        dateFin = (TextView) findViewById(R.id.dateFin);
        radioGroup = (RadioGroup) findViewById(R.id.radioGroup);
        radioGroup.check(findViewById(R.id.radioBtn_dollar).getId());

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
                String date = mois + "-"  + jour + "-" + annee;
                dateDebut.setText(date);
            }
        };

        dateFinListener = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker view, int annee, int mois, int jour) {
                mois++;
                String date = mois + "-"  + jour + "-" + annee;
                dateFin.setText(date);
            }
        };

    }

    public void nouveauRabais(View view) {

        if(code.getText().toString().matches("") || montant.getText().toString().matches("") ||
            dateDebut.getText().toString().matches("Sélectionner une date") ||
            dateFin.getText().toString().matches("Sélectionner une date") ||
            description.getText().toString().matches("")){

            Toast.makeText(this, "Veuillez remplir tous les champs", Toast.LENGTH_LONG).show();

        }else{
            int selectedId = radioGroup.getCheckedRadioButtonId();
            radioButton = (RadioButton) findViewById(selectedId);
            char newType = radioButton.getText().charAt(0);

            rabais r = new rabais(code.getText().toString(), Float.parseFloat(montant.getText().toString()), description.getText().toString(),
                    dateDebut.getText().toString(), dateFin.getText().toString(), newType);

            GestionnaireRabais gest = new GestionnaireRabais();
            moteur_requete_bd myBD = new moteur_requete_bd(this);
            gest.init(myBD);

            if(gest.ajouterRabais(r)){
                Toast.makeText(this, "Le rabais a été ajouté", Toast.LENGTH_LONG).show();
                Intent intent = new Intent(this, sousMenu_rabais.class);
                startActivity(intent);
            }else{
                Toast.makeText(this, "Ce code est déja utilisé", Toast.LENGTH_LONG).show();
            }
        }


    }
}
