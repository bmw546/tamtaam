package tamtam.tamtam;

import android.content.Context;
import android.database.Cursor;
import android.widget.Toast;

import java.util.ArrayList;

public class GestionnaireRabais {

    private moteur_requete_bd bd;
    private ArrayList<rabais> listeRabais = new ArrayList<rabais>();


    GestionnaireRabais(){
    }

    public void init(moteur_requete_bd myBD){
        bd = myBD;
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
        Cursor result = bd.execution_with_return("SELECT * FROM " + bd.getTableRabais());

            for (result.moveToFirst(); !result.isAfterLast(); result.moveToNext()) {
                rabais r = new rabais();
                //public rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, char type) {
                r.setCode(result.getString(result.getColumnIndex("code")));
                r.setMontant(result.getFloat(result.getColumnIndex("montant_rabais")));
                r.setDescription(result.getString(result.getColumnIndex("description")));
                int id_type = result.getInt(result.getColumnIndex("id_type"));
                if (id_type == 1){
                    r.setType('$');
                }else{
                    r.setType('%');
                }
                r.setDateDebut(result.getString(result.getColumnIndex("date_debut")));
                r.setDateFin(result.getString(result.getColumnIndex("date_fin")));

                listeRabais.add(r);
            }


        result.close();
    }

    public Boolean ajouterRabais(rabais r){

        for(int i =0; i< listeRabais.size(); i++){
            //si le code est déja utilisé
            if (listeRabais.get(i).getCode() == r.getCode()){

                return false;
            }
        }

        //sinon il n'est pas utilisé alors on l'ajoute dans la bd
        listeRabais.add(r);


     String sql = "INSERT INTO " + bd.getTableRabais() + "(code, montant_rabais, id_type, description, date_debut, date_fin) " +
        "VALUES ('" + r.getCode() + "', " + r.getMontant() + ", " + r.getNoType() + ", '"+ r.getDescription() +"', " +
                "'"+ r.getDateDebut() + "', '" + r.getDateFin() + "')";

        bd.execution(sql);

      return true;
    }

    public void supprimerRabais(rabais r){

        //delete where code = r.getCode();
        for (int i = 0; i < listeRabais.size(); i++){
            if (listeRabais.get(i).getCode() == r.getCode()){
                listeRabais.remove(i);
            }
        }
        bd.execution("DELETE FROM" + bd.getTableRabais() + " WHERE code =" + "'" + r.getCode() + "'");
    }

    public Boolean modifierRabais(String oldCode,rabais r){

        rabais temp = r;
        temp.setCode(oldCode);

        for (int i = 0; i < listeRabais.size(); i++){

            if (listeRabais.get(i) == temp){
            listeRabais.set(i, r);
             bd.execution("UPDATE" + bd.getTableRabais() + "SET 'code' = '" +r.getCode()+ "', 'id_type' = '" + r.getNoType() + "', 'description' = '" +
             r.getDescription() + "', 'date_debut' = '" +r.getDateDebut() + "', 'date_fin' = '" + r.getDateFin() + "'");
                return true;
            }
        }
        //pour bd: set rabais where code = oldcode, etc.

        //si un autre rabais a le meme code
        //return false

        //code, montant_rabais, id_type, description, date_debut, date_fin) "
        /*bd.execution("UPDATE" + bd.getTableRabais() + "SET 'code' = '" +r.getCode()+ "', 'id_type' = '" + r.getNoType() + "', 'description' = '" +
             r.getDescription() + "', 'date_debut' = '" +r.getDateDebut() + "', 'date_fin' = '" + r.getDateFin() + "'");
*/
        return false;
    }
}
