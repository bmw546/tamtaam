package tamtam.tamtam;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.BaseAdapter;
import android.widget.ListView;
import android.widget.TextView;

public class sousMenu_rabais extends AppCompatActivity {


    //array list code rabais: need select dans la bd qui va saisir tout les rabais et
    //les mettre dans les objets rabais qu'on va utiliser pour mettre les infos dans la liste
    GestionnaireRabais gestRabais = new GestionnaireRabais();
    //rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, int type)
rabais r1 = new rabais("abc123", 20,"Rabais de test my dudes", "2018-05-10", "2018-06-19", '%');
rabais r2 =  new rabais("xyz123", 50,"Anotha test", "2018-01-01", "2019-01-01", '$');
rabais r3 =  new rabais("freeshit", 100,"Test no 3", "2018-05-11", "2020-01-01", '%');


    public void ajouterRabais(View view){
        Intent intent = new Intent(this, ui_ajouter_rabais.class);
        startActivity(intent);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        moteur_requete_bd myBD = new moteur_requete_bd(this); //create the local database
        gestRabais.init(myBD);
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_sous_menu_rabais);
        //les rabais vont être ajoutés à partir de la bd
        //tests now vu que j'ai pas accès à la bd

//        gestRabais.ajouterRabais(r1);
//        gestRabais.ajouterRabais(r2);
//        gestRabais.ajouterRabais(r3);
        ListView listView=(ListView)findViewById(R.id.listeRabais);
        CustomAdapter customAdapter = new CustomAdapter();
        listView.setAdapter(customAdapter);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                Intent intent = new Intent(view.getContext(), modifier_supprimer_rabais.class);
                Bundle b = new Bundle();
                b.putString("code",gestRabais.getListeRabais().get(position).getCode());
                b.putFloat("montant", gestRabais.getListeRabais().get(position).getMontant());
                b.putChar("type", gestRabais.getListeRabais().get(position).getType());
                b.putString("dateDebut", gestRabais.getListeRabais().get(position).getDateDebut());
                b.putString("dateFin", gestRabais.getListeRabais().get(position).getDateFin());
                b.putString("description", gestRabais.getListeRabais().get(position).getDescription());
                intent.putExtras(b); //Put your id to your next Intent
                startActivity(intent);
                finish();

            }
        });

    }

    class CustomAdapter extends BaseAdapter{

        @Override
        public int getCount() {
            System.out.println(gestRabais.getListeRabais().size());
            return gestRabais.getListeRabais().size();
        }

        @Override
        public Object getItem(int position) {
            return null;
        }

        @Override
        public long getItemId(int position) {
            return 0;
        }

        @Override
        public View getView(int i, View view, ViewGroup parent) {
            view = getLayoutInflater().inflate(R.layout.layout_liste_rabais, null);
            TextView lblCode = (TextView)view.findViewById(R.id.list_code);
            TextView lblValeur = (TextView)view.findViewById(R.id.list_valeurRabais);
            TextView lblDateDebut = (TextView)view.findViewById(R.id.list_dateDebut);
            TextView lblDateFin = (TextView)view.findViewById(R.id.liste_dateFin);
            TextView lblType = (TextView)view.findViewById(R.id.liste_typeRabais);
            TextView lblDesc = (TextView)view.findViewById(R.id.list_description);

            lblCode.setText(gestRabais.getListeRabais().get(i).getCode());
            lblValeur.setText(Float.toString(gestRabais.getListeRabais().get(i).getMontant()));
            lblDateDebut.setText(gestRabais.getListeRabais().get(i).getDateDebut());
            lblDateFin.setText(gestRabais.getListeRabais().get(i).getDateFin());
            lblType.setText(Character.toString(gestRabais.getListeRabais().get(i).getType()));
            lblDesc.setText(gestRabais.getListeRabais().get(i).getDescription());

            return view;
        }
    }
}
