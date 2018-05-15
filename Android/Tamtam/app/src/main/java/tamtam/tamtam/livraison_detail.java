package tamtam.tamtam;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.ListActivity;
import android.content.Context;
import android.content.pm.PackageManager;
import android.database.Cursor;
import android.graphics.Color;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.FragmentActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;


import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.Polyline;
import com.google.android.gms.maps.model.PolylineOptions;


import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class livraison_detail extends FragmentActivity implements LocationListener, OnMapReadyCallback  {
    public static final int LOCATION_UPDATE_MIN_DISTANCE = 10;
    public static final int LOCATION_UPDATE_MIN_TIME = 5000;
    private GoogleMap mMap;
    private double longitude;
    private double latitude;
    Marker mMarker;
    LatLng destination;
    LatLng origin;
    private GoogleApiClient mGoogleApiClient;
    private LocationManager locationManager;
    private moteur_requete_bd myBd;
    private int id = 0;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        myBd = new moteur_requete_bd(this); //create the local database
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_livraison_detail);


        // -------------------------------------------------------------------------------------------------------------------------------------
        // prend les donnée de l'activity précédente
        Bundle b = getIntent().getExtras();

        String etat="blank";
        String nom = "blank";
        Double montant =0.00;
        longitude = 0;
        latitude = 0;
        String adresse ="";
        if(b != null){
            id = b.getInt("key");
            montant = b.getDouble("montant");
            etat = b.getString("etat");
            nom = b.getString("nom");
        }
        Cursor result = myBd.execution_with_return("SELECT * FROM " + myBd.getTableLivraison() + " WHERE id_commande==" + id );
        for (result.moveToFirst(); !result.isAfterLast(); result.moveToNext()) {
             latitude = result.getDouble(result.getColumnIndex("adresse_longitude"));
            longitude = result.getDouble(result.getColumnIndex("adresse_latitude"));
            adresse = result.getString(result.getColumnIndex("adresse_livraison"));
            Toast.makeText(getApplicationContext(), result.getString(result.getColumnIndex("adresse_longitude")), Toast.LENGTH_LONG).show();
            Toast.makeText(getApplicationContext(), result.getString(result.getColumnIndex("adresse_latitude")), Toast.LENGTH_LONG).show();
        }

        TextView name = (TextView) findViewById(R.id.nom);
        TextView numero = (TextView) findViewById(R.id.Numero);
        TextView adress = (TextView) findViewById(R.id.adresse);
        TextView etats = (TextView) findViewById(R.id.etat);
        TextView total = (TextView) findViewById(R.id.TOTAL);
        name.setText(nom);
        numero.setText(""+id);
        etats.setText(etat);
        total.setText(" Total_______________"+montant + "   $");
        adress.setText(adresse);

        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);

        //---------------------------------------------------------------
        final ArrayList<String> nom_produit = new ArrayList<String>();
        final ArrayList<String> quantité = new ArrayList<String>();
        Integer id_produit;
        final List<Double> prix = new ArrayList<Double>();
        myBd = new moteur_requete_bd(this); //create the local database
        // imprimme la liste dans le téléphone
        TextView textView = (TextView) findViewById(R.id.listeprix);
        textView.append(System.getProperty("line.separator"));
        //--------------------------------
        Cursor result2 = myBd.execution_with_return("SELECT * FROM " + myBd.getTableProduitCommande() + "  WHERE id_commande="+id);
        for (result2.moveToFirst(); !result2.isAfterLast(); result2.moveToNext()) {
            id_produit = result2.getInt(result2.getColumnIndex("id_produit"));
            textView.append(String.valueOf(result2.getInt(result2.getColumnIndex("nb_produit"))));
            textView.append(" X ");
            Cursor result3 = myBd.execution_with_return("SELECT * FROM " + myBd.getTableProduit() + "  WHERE id="+id_produit);
            for (result3.moveToFirst(); !result3.isAfterLast(); result3.moveToNext()) {
                textView.append("    ");
                textView.append(result3.getString(result3.getColumnIndex("nom")));
                textView.append("    ");
                textView.append(result3.getString(result3.getColumnIndex("description")));
                textView.append("   ");
                textView.append(String.valueOf(result3.getDouble(result3.getColumnIndex("prix"))));
                textView.append(" $");

            }
            textView.append(System.getProperty("line.separator"));
        }

        // -------------------------------------------------------------------------------------------------------------------------------------
        // sert a initialiser la carte et la position gps peut aussi demander l'autorisaton si nécessaire
        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        List<String> providers = locationManager.getProviders(true);
        if(ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED){
            ActivityCompat.requestPermissions(this,new String[]{Manifest.permission.ACCESS_FINE_LOCATION},3);
            Toast.makeText(getApplicationContext(), "Demande d'acces GPS : ", Toast.LENGTH_LONG).show();
        }



    }

    public void livre(View v){
        myBd.execution("UPDATE `"+ myBd.getTableCommande() +"` set `id_etat` values =" + 1 + " WHERE id= "+ id );
        TextView etats = (TextView) findViewById(R.id.etat);
        Cursor result2 = myBd.execution_with_return("SELECT nom FROM " + myBd.getTableEtatCommande() + " WHERE id==" + id);
        etats.setText(result2.getString(result2.getColumnIndex("nom")));
    }
    public void paslivre(View v){
        myBd.execution("UPDATE `"+ myBd.getTableCommande() +"` set `id_etat` values =" + 2 + " WHERE id= "+ id );
        TextView etats = (TextView) findViewById(R.id.etat);
        Cursor result2 = myBd.execution_with_return("SELECT nom FROM " + myBd.getTableEtatCommande() + " WHERE id==" + id);
        etats.setText(result2.getString(result2.getColumnIndex("nom")));
    }
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        // Add a marker in client and move the camera
        destination = new LatLng(longitude, latitude);
        mMap.addMarker(new MarkerOptions().position(destination).title("Adresse client"));
        //mMap.addMarker(mMarker);
        LocationManager locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0, 0, this);
            return;
        }
        locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0, 0, this);

    }

    @Override
    public void onLocationChanged(Location location) {
        origin = new LatLng(location.getLatitude(),location.getLongitude());
        if (mMarker != null) {
            mMarker.remove();
        }
        MarkerOptions markerOptions = new MarkerOptions();
        markerOptions.position(origin);
        markerOptions.title("Current Position");
        markerOptions.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_MAGENTA));
        mMarker = mMap.addMarker(markerOptions);
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(origin,17.0f));
        String url=getRequestUrl(origin,destination);
        TaskRequestDirections taskRequestDirections = new TaskRequestDirections();
        taskRequestDirections.execute(url);
    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {

    }

    @Override
    public void onProviderEnabled(String provider) {
        Toast.makeText(getApplicationContext(), provider+" is enabled", Toast.LENGTH_LONG).show();
    }

    @Override
    public void onProviderDisabled(String provider) {
        Toast.makeText(getApplicationContext(), provider+" is disabled", Toast.LENGTH_LONG).show();
    }


    // ---------------------------------------------------------------------------------------------------
    private String getRequestUrl(LatLng origin, LatLng dest) {
        //Value of origin
        String str_org = "origin=" + origin.latitude +","+origin.longitude;
        //Value of destination
        String str_dest = "destination=" + dest.latitude+","+dest.longitude;
        //Set value enable the sensor
        String sensor = "sensor=false";
        //Mode for find direction
        String mode = "mode=driving";
        //Build the full param
        String param = str_org +"&" + str_dest + "&" +sensor+"&" +mode;
        //Output format
        String output = "json";
        //Create url to request
        String url = "https://maps.googleapis.com/maps/api/directions/" + output + "?" + param;
        return url;
    }

    private String requestDirection(String reqUrl) throws IOException {
        String responseString = "";
        InputStream inputStream = null;
        HttpURLConnection httpURLConnection = null;
        try{
            URL url = new URL(reqUrl);
            httpURLConnection = (HttpURLConnection) url.openConnection();
            httpURLConnection.connect();

            //Get the response result
            inputStream = httpURLConnection.getInputStream();
            InputStreamReader inputStreamReader = new InputStreamReader(inputStream);
            BufferedReader bufferedReader = new BufferedReader(inputStreamReader);

            StringBuffer stringBuffer = new StringBuffer();
            String line = "";
            while ((line = bufferedReader.readLine()) != null) {
                stringBuffer.append(line);
            }

            responseString = stringBuffer.toString();
            bufferedReader.close();
            inputStreamReader.close();

        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (inputStream != null) {
                inputStream.close();
            }
            httpURLConnection.disconnect();
        }
        return responseString;
    }


    public class TaskRequestDirections extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... strings) {
            String responseString = "";
            try {
                responseString = requestDirection(strings[0]);
            } catch (IOException e) {
                e.printStackTrace();
            }
            return  responseString;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            //Parse json here
            TaskParser taskParser = new TaskParser();
            taskParser.execute(s);
        }
    }

    public class TaskParser extends AsyncTask<String, Void, List<List<HashMap<String, String>>> > {

        @Override
        protected List<List<HashMap<String, String>>> doInBackground(String... strings) {
            JSONObject jsonObject = null;
            List<List<HashMap<String, String>>> routes = null;
            try {
                jsonObject = new JSONObject(strings[0]);
                DirectionsParser directionsParser = new DirectionsParser();
                routes = directionsParser.parse(jsonObject);
            } catch (JSONException e) {
                e.printStackTrace();
            }
            return routes;
        }

        @Override
        protected void onPostExecute(List<List<HashMap<String, String>>> lists) {
            //Get list route and display it into the map

            ArrayList points = null;

            PolylineOptions polylineOptions = null;

            for (List<HashMap<String, String>> path : lists) {
                points = new ArrayList();
                polylineOptions = new PolylineOptions();

                for (HashMap<String, String> point : path) {
                    double lat = Double.parseDouble(point.get("lat"));
                    double lon = Double.parseDouble(point.get("lon"));

                    points.add(new LatLng(lat,lon));
                }

                polylineOptions.addAll(points);
                polylineOptions.width(15);
                polylineOptions.color(Color.BLUE);
                polylineOptions.geodesic(true);
            }

            if (polylineOptions!=null) {
                mMap.addPolyline(polylineOptions);
            } else {

            }

        }
    }
}
