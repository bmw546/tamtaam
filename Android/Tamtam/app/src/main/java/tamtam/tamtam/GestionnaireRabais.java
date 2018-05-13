package tamtam.tamtam;

import android.database.Cursor;
import android.widget.Toast;

import java.util.ArrayList;

public class GestionnaireRabais {

    private moteur_requete_bd bd;
    private ArrayList<rabais> listeRabais = new ArrayList<rabais>();

    GestionnaireRabais(){

        selectRabais();
    }

    public ArrayList<rabais> getListeRabais() {
        return listeRabais;
    }

    public void setListeRabais(ArrayList<rabais> listeRabais) {
        this.listeRabais = listeRabais;
    }

    public void selectRabais(){
        //va select les rabais dans la bd et les mettre dans l'arraylist
//        Cursor c = bd.execution_with_return("SELECT * FROM " + bd.getTableRabais());
//        if (c.getCount() > 0){
//            for (c.moveToFirst(); !c.isAfterLast(); c.moveToNext()) {
//                rabais r = new rabais();
//                //public rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, char type) {
//                r.setCode(c.getString(c.getColumnIndex("code")));
//                r.setMontant(c.getFloat(c.getColumnIndex("montant_rabais")));
//                r.setDescription(c.getString(c.getColumnIndex("description")));
//                int id_type = c.getInt(c.getColumnIndex("id_type"));
//                if (id_type == 1){
//                    r.setType('$');
//                }else{
//                    r.setType('%');
//                }
//                r.setDateDebut(c.getString(c.getColumnIndex("date_debut")));
//                r.setDateFin(c.getString(c.getColumnIndex("date_fin")));
//
//                listeRabais.add(r);
//            }
//
//        }
//        c.close();
    }
    public Boolean ajouterRabais(rabais r){

//        for(int i =0; i< listeRabais.size(); i++){
//            if (listeRabais.get(i).getCode() == r.getCode())
//            {
//                return false;
//            }
//        }
//
//        listeRabais.add(r);
//
//      bd.execution("INSERT INTO " + bd.getTableRabais() + "(code, montant_rabais, id_type, description, date_debut, date_fin) " +
//        "VALUES ('" + r.getCode() + "', " + r.getMontant() + "," + r.getNoType() + ", '"+ r.getDescription() +"', " +
//                " '"+ r.getDateDebut() + "', '" + r.getDateFin() + "')");
//
      return true;
    }

    public void supprimerRabais(rabais r){

        //delete where code = r.getCode();
        listeRabais.remove(r);


    }

    public Boolean modifierRabais(String oldCode,rabais r){
        //cherche le rabais dans l'array list correspondant au vieux code et modifie le bon rabais

        //pour bd: set rabais where code = oldcode, etc.

        //si un autre rabais a le meme code
        //return false

        return true;
    }
}
