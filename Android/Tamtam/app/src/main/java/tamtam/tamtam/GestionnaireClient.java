package tamtam.tamtam;

import android.app.ListActivity;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

public class GestionnaireClient extends ListActivity {

    private moteur_requete_bd myBd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //setContentView(R.layout.ui_client);
        myBd = new moteur_requete_bd(this); //create the local database
        final String[] FRUITS = new String[] { "Apple", "Avocado", "Banana",
                "Blueberry", "Coconut", "Durian", "Guava", "Kiwifruit",
                "Jackfruit", "Mango", "Olive", "Pear", "Sugar-apple" };
        setListAdapter(new ArrayAdapter<String>(this, R.layout.ui_client,FRUITS));

        ListView listView = getListView();
        listView.setTextFilterEnabled(true);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            public void onItemClick(AdapterView<?> parent, View view,
                                    int position, long id) {
                // When clicked, show a toast with the TextView text
               /* Toast.makeText(getApplicationContext(),
                        ((TextView) view).getText(), Toast.LENGTH_SHORT).show();
                */
                Intent intent = new Intent(view.getContext(), detail_client.class);
                Bundle b = new Bundle();
                b.putInt("key", position); //Your id
                b.putString("nom",FRUITS[position]);
               b.putString("adresse",FRUITS[position]+" at fruit.com");
                b.putDouble("longitude",45.411701);
                b.putDouble("lat",-71.886361);
                intent.putExtras(b); //Put your id to your next Intent
                startActivity(intent);
                finish();
            }
        });
    }
}