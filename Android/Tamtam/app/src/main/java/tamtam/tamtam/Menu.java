package tamtam.tamtam;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

public class menu extends AppCompatActivity {


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_menu);

    }

    public void showClient(View view){
        Intent intent = new Intent(this, ui_client.class);

        startActivity(intent);
    }
    public void showProduit(View view){
        Intent intent = new Intent(this, Produits.class);

        startActivity(intent);
    }
    public void showRecette(View view){
        Intent intent = new Intent(this, recette.class);

        startActivity(intent);
    }
    public void showEvenement(View view){
        Intent intent = new Intent(this, evenement.class);

        startActivity(intent);
    }
    public void showNotification(View view){
        Intent intent = new Intent(this, notification.class);

        startActivity(intent);
    }
    public void showRapport(View view){
        Intent intent = new Intent(this, rapport.class);

        startActivity(intent);
    }
    public void showSauvegarde(View view){
        Intent intent = new Intent(this, sauvegarde.class);

        startActivity(intent);
    }
}
