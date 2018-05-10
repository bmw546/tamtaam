package tamtam.tamtam;

import android.Manifest;
import android.app.ListActivity;
import android.content.Context;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.FragmentActivity;
import android.os.Bundle;
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
    //private LocationManager locationManager;
    //public static final String TAG = MapsActivity.class.getSimpleName();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_livraison_detail);

        final String[] FRUITS = new String[] { "Apple", "Avocado", "Banana",
                "Blueberry", "Coconut", "Durian", "Guava", "Kiwifruit",
                "Jackfruit", "Mango", "Olive", "Pear", "Sugar-apple" };
        TextView textView = (TextView) findViewById(R.id.listeprix);
        textView.append(System.getProperty("line.separator"));
        for (int i=0; i < FRUITS.length;i++){
            textView.append("Voici produit"+FRUITS[i]+" quantité blabla  Price " + System.getProperty("line.separator"));
        }
        // -------------------------------------------------------------------------------------------------------------------------------------
        // sert a initialiser la carte et la position gps peut aussi demander l'autorisaton si nécessaire
        locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        List<String> providers = locationManager.getProviders(true);
        if(ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED){
            ActivityCompat.requestPermissions(this,new String[]{Manifest.permission.ACCESS_FINE_LOCATION},3);
            Toast.makeText(getApplicationContext(), "Demande d'acces GPS : ", Toast.LENGTH_LONG).show();
        }
        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);
        // -------------------------------------------------------------------------------------------------------------------------------------
        // prend les donnée de l'activity précédente
        Bundle b = getIntent().getExtras();
        int id = -1; // or other values
        String adresse="blank";
        longitude = 0;
        latitude = 0;

        if(b != null){
            id = b.getInt("key");
            adresse= b.getString("adresse");
            longitude = b.getDouble("longitude");
            latitude = b.getDouble("lat");
        }
        TextView name = (TextView) findViewById(R.id.nom);
        TextView numero = (TextView) findViewById(R.id.Numero);
        TextView adress = (TextView) findViewById(R.id.adresse);
        name.setText("name");
        numero.setText(""+id);
        adress.setText(adresse);


    }


    /**
     * Manipulates the map once available.
     * This callback is triggered when the map is ready to be used.
     * This is where we can add markers or lines, add listeners or move the camera. In this case,
     * we just add a marker near client, Australia.
     * If Google Play services is not installed on the device, the user will be prompted to install
     * it inside the SupportMapFragment. This method will only be triggered once the user has
     * installed Google Play services and returned to the app.
     */
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

        findDirections(currentUserLocation.getLatitude(),
                SGTasksListAppObj.getInstance().currentUserLocation.getLongitude(),
                clickMarkerLatLng.latitude, clickMarkerLatLng.longitude, GMapV2Direction.MODE_DRIVING );
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



    public void handleGetDirectionsResult(ArrayList<LatLng> directionPoints)
    {
        Polyline newPolyline;

        PolylineOptions rectLine = new PolylineOptions().width(3).color(Color.RED);

        for(int i = 0 ; i < directionPoints.size() ; i++)
        {
            rectLine.add(directionPoints.get(i));
        }
        newPolyline = mMap.addPolyline(rectLine);
    }


    public void findDirections(double fromPositionDoubleLat, double fromPositionDoubleLong, double toPositionDoubleLat, double toPositionDoubleLong, String mode)
    {
        Map<String, String> map = new HashMap<String, String>();
        map.put(GetDirectionsAsyncTask.USER_CURRENT_LAT, String.valueOf(fromPositionDoubleLat));
        map.put(GetDirectionsAsyncTask.USER_CURRENT_LONG, String.valueOf(fromPositionDoubleLong));
        map.put(GetDirectionsAsyncTask.DESTINATION_LAT, String.valueOf(toPositionDoubleLat));
        map.put(GetDirectionsAsyncTask.DESTINATION_LONG, String.valueOf(toPositionDoubleLong));
        map.put(GetDirectionsAsyncTask.DIRECTIONS_MODE, mode);

        GetDirectionsAsyncTask asyncTask = new GetDirectionsAsyncTask(this);
        asyncTask.execute(map);
    }
}
