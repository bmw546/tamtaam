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

    public void showActivity(View view){
        Intent intent = new Intent(this, ui_client.class);

        startActivity(intent);
    }
}
