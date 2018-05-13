package tamtam.tamtam;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Color;
import android.net.Uri;
import android.os.Build;
import android.os.ParcelFileDescriptor;
import android.provider.DocumentsContract;
import android.provider.OpenableColumns;
import android.support.annotation.RequiresApi;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.TextView;

import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;

public class GestionnaireSauvegarde extends AppCompatActivity {

    private static final int READ_REQUEST_CODE = 42;
    private static final int WRITE_REQUEST_CODE = 43;

    private Uri uri;
    private TextView fileName;
    private TextView messageText;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ui_sauvegarde);

        fileName = (TextView) findViewById(R.id.filePath);
        messageText = (TextView) findViewById(R.id.message);
    }

    // Évévenement POUR LES BUTTON

    /**
     * ouvre un interface de recherche de fichier et sélectionne un document.
     */
    @RequiresApi(api = Build.VERSION_CODES.KITKAT)
    public void rechercheFichier(View view) {

        //Ouvre l'activitée pour chercher un fichier dans l'appareil
        Intent intent = new Intent(Intent.ACTION_OPEN_DOCUMENT);

        //Filtre et affiche les document qui peut être ouvert
        intent.addCategory(Intent.CATEGORY_OPENABLE);

        //Indique quel type de fichier peut apparaitre dans la recherche ici c'est tous les fichier.
        intent.setType("*/*");

        startActivityForResult(intent, READ_REQUEST_CODE);
    }

    /**
     * Lors du résultat de l'activity de recherche de fichier, on sélectionne le fichier et
     * on récupere le lien du fichier. cette méthode est appeler automatiquement aprés la sélection
     * d'un fichier dans l'activité de recherche.
     * @param requestCode le code de lecture, d'écriture, de mofication ou autre.
     * @param resultCode le résultat si c'est OK ou annuler
     * @param resultData les donnée du fichier sélectionner
     */
    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN)
    @Override
    public void onActivityResult(int requestCode, int resultCode,
                                 Intent resultData) {

        // si le code est bien celui de lecture et que c'est valider,
        // alors on recupere l'url du document selectionner.
        if (requestCode == READ_REQUEST_CODE && resultCode == Activity.RESULT_OK) {
            // Récupere URI avec resultData.getData().
            uri = null;
            if (resultData != null) {
                uri = resultData.getData();
                String TAG = "Uri: ";
                Log.i(TAG, uri.toString());
                getNameFile(uri);
            }
        }
        // si le code est bien celui d'écriture
        if (requestCode == WRITE_REQUEST_CODE && resultCode == Activity.RESULT_OK){
            uri = null;
            if (resultData != null) {
                uri = resultData.getData();
                String TAG = "Uri: ";
                Log.i(TAG, uri.toString());
                getNameFile(uri);
                messageText.setTextColor(Color.rgb(102, 153, 0));
                messageText.setText("Le fichier a été créer avec succès");
            }
        }
    }

    /**
     * Créer une sauvegarde des donnée
     * @param view
     */
    @RequiresApi(api = Build.VERSION_CODES.KITKAT)
    public void createSave(View view){
        createFile("csv/plain", "exportData.csv");
    }

    /**
     * Ouvre un interface pour créer un document
     * @param mimeType le type du ficher "text/plain" ou image/png"
     * @param fileName le nom du fichier "foobar.txt" ou "mypicture.png"
     */
    @RequiresApi(api = Build.VERSION_CODES.KITKAT)
    private void createFile(String mimeType, String fileName) {
        Intent intent = new Intent(Intent.ACTION_CREATE_DOCUMENT);

        //Filtre et affiche les document qui peut être ouvert
        intent.addCategory(Intent.CATEGORY_OPENABLE);

        // Créer un fichier avec le type demander
        intent.setType(mimeType);
        //nomme le fichier avec le nom donné en paramètre
        intent.putExtra(Intent.EXTRA_TITLE, fileName);
        //Ouvre l'activité qui créer le document
        startActivityForResult(intent, WRITE_REQUEST_CODE);
    }

    /**
     * Sauvegarde les données vers un fichier déja créer
     * @param view le bouton Modifier de l'interface
     */
    public void modiferSauvegarde(View view) {
        if(uri != null){
            modifierDocument(uri);
            messageText.setTextColor(Color.rgb(102, 153, 0));
            messageText.setText("La sauvegarde a été effectuer.");
        } else{
            messageText.setTextColor(Color.RED);
            messageText.setText("Aucun fichier sélectionné!");
        }
    }

    /**
     * Modifie un document avec un url spécifier en paramètre
     * @param uri le chemin où ce trouve le fichier a modifier
     */
    private void modifierDocument(Uri uri) {
        moteur_requete_bd myBd;
        myBd = new moteur_requete_bd(this);
        //Requete sql pour recuperer les commandes
        Cursor cursor;
        cursor = myBd.execution_with_return("SELECT commande.id, client.nom, client.telephone, etat_commande.nom, type_commande.description, commande.date, commande.montant_commande FROM `commande` \n" +
                "INNER JOIN client ON client.id = commande.id_client \n" +
                "INNER JOIN etat_commande ON etat_commande.id = commande.id_etat\n" +
                "INNER JOIN type_commande ON type_commande.id = commande.id_type_commande");

        try {
            //permet d'ouvrir un document avec l'url et en mode écriture
            ParcelFileDescriptor pfd = this.getContentResolver().
                    openFileDescriptor(uri, "w");

            //initialise l'écriture du document
            FileOutputStream fileOutputStream =
                    new FileOutputStream(pfd.getFileDescriptor());

            //On commende a écrire dans le document
            //Entete pour indiquer quel donnnée sont afficher
            fileOutputStream.write(("Liste des commandes :\n").getBytes());

            //tant qu'il a des commandes
            do{
                //Entete pour les commandes
                fileOutputStream.write(("No; Nom du client; Numero de telephone; Etat; Type; Date; Montant\n").getBytes());
                fileOutputStream.write((cursor.getInt(0)
                        +"; "+ cursor.getString(1)
                        +"; "+ cursor.getString(2)
                        +"; "+ cursor.getString(3)
                        +"; "+ cursor.getString(4)
                        +"; "+ cursor.getString(5)
                        +"; "+ cursor.getString(6) + "\n").getBytes());
                //Requete sql pour afficher les produit commandés
                Cursor cursorProduit;
                cursorProduit = myBd.execution_with_return("SELECT produit.nom, produit.description, produit.prix, ta_produit_commande.nb_produit FROM `ta_produit_commande` \n" +
                        "INNER JOIN produit ON ta_produit_commande.id_produit = produit.id\n" +
                        "WHERE `id_commande` = " + cursor.getInt(0));
                //affche entete pour produit
                fileOutputStream.write(("Liste des produits :\n").getBytes());
                fileOutputStream.write(("Nom; Description; Prix; Nb de produit\n").getBytes());
                //tant qu'il a des produits pour une commande
                do {
                    fileOutputStream.write((cursorProduit.getString(0)
                            + "; " + cursorProduit.getString(1)
                            + "; " + cursorProduit.getFloat(2)
                            + "; " + cursorProduit.getInt(3) + "\n").getBytes());
                }while(cursorProduit.moveToNext());
            }while(cursor.moveToNext());

            fileOutputStream.close();
            pfd.close();
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    /**
     * Supprime un fichier de l'appareil
     * @param view le bouton supprimer de l'interface
     */
    @RequiresApi(api = Build.VERSION_CODES.KITKAT)
    public void deleteFile(View view) {

        if(uri != null) {
            AlertDialog.Builder builder = new AlertDialog.Builder(this);
            //Ajout du bouton Oui
            builder.setPositiveButton(R.string.oui, new DialogInterface.OnClickListener() {
                public void onClick(DialogInterface dialog, int id) {
                    try {
                        DocumentsContract.deleteDocument(getContentResolver(), uri);
                        fileName.setText("");
                        uri = null;
                        messageText.setTextColor(Color.RED);
                        messageText.setText("Le fichier a été supprimé");
                    } catch (FileNotFoundException e) {
                        e.printStackTrace();
                    }
                }
            });
            //Ajout du bouton non
            builder.setNegativeButton(R.string.no, new DialogInterface.OnClickListener() {
                public void onClick(DialogInterface dialog, int id) {
                    // User cancelled the dialog
                }
            });
            // Modifie d'autres propriété du dialogue
            builder.setMessage("Êtes-vous certains de vouloir supprimer ce fichier ?")
                    .setTitle("Suppression de fichier");
            // Crée le dialogue
            AlertDialog dialog = builder.create();
            // Affiche la boite de dialogue
            builder.show();

        }else{
            messageText.setTextColor(Color.RED);
            messageText.setText("Aucun fichier sélectionné!");
        }
    }

    /**
     * Récupere le nom du fichier et le met dans l'editView
     * @param uri le file path
     */
    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN)
    public void getNameFile(Uri uri) {

        //crée un curseur pour naviguer dans le metadata du fichier fournis avec uri
        Cursor cursor = this.getContentResolver()
                .query(uri, null, null, null, null, null);

        try {

            // Si le curseur est différent de rien et qu'il peut aller au premier élément
            if (cursor != null && cursor.moveToFirst()) {

                //récupere le nom du fichier. Attention peut ne pas être le nom du fichier.
                String displayName = cursor.getString(
                        cursor.getColumnIndex(OpenableColumns.DISPLAY_NAME));
                String TAG = "";
                Log.i(TAG, "Display Name: " + displayName);
                fileName.setText(displayName);

            }
        } finally {
            cursor.close();
        }
    }
}
