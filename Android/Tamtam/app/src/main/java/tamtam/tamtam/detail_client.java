package tamtam.tamtam;

import android.Manifest;
import android.content.Context;
import android.content.pm.PackageManager;
import android.location.LocationManager;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.FragmentActivity;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.common.images.ImageRequest;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapFragment;
import com.google.android.gms.maps.MapView;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

import java.util.List;

public class detail_client extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private double longitude;
    private double latitude;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        Bundle b = getIntent().getExtras();

        TextView name = (TextView) findViewById(R.id.nom);
        TextView numero = (TextView) findViewById(R.id.Numero);
        TextView adress = (TextView) findViewById(R.id.adresse);
        int id = -1; // or other values
        String nom = "blank";
        String adresse="blank";
        longitude = 0;
        latitude = 0;
        if(b != null){
            id = b.getInt("key");
           nom = b.getString("nom");
            adresse= b.getString("adresse");
            longitude = b.getDouble("longitude");
            latitude = b.getDouble("lat");
        }
       // name.setText(nom);
        //numero.setText(""+id);
        adress.setText("blbalbalbal");

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_client);
        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);
    }
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        // Add a marker in client and move the camera
        LatLng client = new LatLng(longitude,latitude);
        mMap.addMarker(new MarkerOptions().position(client).title("Adresse client"));
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(client,17.0f));
        mMap.setMapType(GoogleMap.MAP_TYPE_SATELLITE);
        //mMap.addMarker(mMarker);
    }
}
