package tamtam.tamtam;

import android.app.ListActivity;
import android.content.Intent;
import android.database.Cursor;
import android.location.Address;
import android.location.Geocoder;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

public class GestionnaireClient extends ListActivity {

    private moteur_requete_bd myBd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //setContentView(R.layout.ui_client);
        final ArrayList<String> nom = new ArrayList<String>();
        final ArrayList<String> adresse = new ArrayList<String>();
        final ArrayList<Integer> chiffre = new ArrayList<Integer>();
        final List<Double> longi = new ArrayList<Double>();
        final List<Double> lag = new ArrayList<Double>();
        myBd = new moteur_requete_bd(this); //create the local database

        //--------------------------------
        Cursor result = myBd.execution_with_return("SELECT * FROM " + myBd.getTableClient());

        for (result.moveToFirst(); !result.isAfterLast(); result.moveToNext()) {
            //public rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, char type) {
            chiffre.add(result.getColumnIndex("id"));
            nom.add(result.getString(result.getColumnIndex("nom")));
            adresse.add(result.getString(result.getColumnIndex("adresse")));
            String myLocation = (result.getString(result.getColumnIndex("adresse")));
            LatLng place = getLocationFromAddress(myLocation);
            longi.add( place.longitude);
            lag.add(place.latitude);

        }

        //--------------------------------
        setListAdapter(new ArrayAdapter<String>(this, R.layout.ui_client,nom));

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

                b.putInt("key", chiffre.get(position)); //Your id
                b.putString("nom",nom.get(position));
               b.putString("adresse",adresse.get(position));
                b.putDouble("longitude",45.411701);
                b.putDouble("lat",-71.886361);
                intent.putExtras(b); //Put your id to your next Intent
                startActivity(intent);
                finish();
            }
        });
    }

    public LatLng getLocationFromAddress(String strAddress)
    {
        //Create coder with Activity context - this
        Geocoder coder = new Geocoder(this);
        List<Address> address;
        LatLng defaul = new LatLng(-71.886361, 45.411701);
        try {
            //Get latLng from String
            address = coder.getFromLocationName(strAddress,5);

            //check for null
            if (address == null) {
            }
            else{
                //Lets take first possibility from the all possibilities.
                Address location=address.get(0);
                defaul = new LatLng(location.getLatitude(), location.getLongitude());
            }
        } catch (IOException e)
        {
            e.printStackTrace();
        }
        return defaul;
    }
}