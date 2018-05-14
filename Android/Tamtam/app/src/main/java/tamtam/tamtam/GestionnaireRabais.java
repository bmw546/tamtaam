package tamtam.tamtam;

import android.database.Cursor;
import android.widget.Toast;

import java.util.ArrayList;

public class GestionnaireRabais {

    private moteur_requete_bd bd;
    private ArrayList<rabais> listeRabais = new ArrayList<rabais>();

    GestionnaireRabais(){

        //bd = new moteur_requete_bd(this);
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
        if (result.getCount() > 0){
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

        }
        result.close();
    }

    public Boolean ajouterRabais(rabais r){

        for(int i =0; i< listeRabais.size(); i++){
            if (listeRabais.get(i).getCode() == r.getCode())
            {
                return false;
            }
        }

        listeRabais.add(r);

      bd.execution("INSERT INTO " + bd.getTableRabais() + "(code, montant_rabais, id_type, description, date_debut, date_fin) " +
        "VALUES ('" + r.getCode() + "', " + r.getMontant() + "," + r.getNoType() + ", '"+ r.getDescription() +"', " +
                " '"+ r.getDateDebut() + "', '" + r.getDateFin() + "')");

      return true;
    }

    public void supprimerRabais(rabais r){

        //delete where code = r.getCode();
        listeRabais.remove(r);
        bd.execution("DELETE FROM" + bd.getTableRabais() + " WHERE code =" + "'" + r.getCode() + "'");
    }

    public Boolean modifierRabais(String oldCode,rabais r){
        int idNewcode = 0;
        for (int i = 0; i < listeRabais.size(); i++){
            if (listeRabais.get(i).getCode() == r.getCode()){
                return  false;
            }
            if (listeRabais.get(i).getCode() == oldCode){
                idNewcode = i;
            }
        }
        //pour bd: set rabais where code = oldcode, etc.

        //si un autre rabais a le meme code
        //return false
        listeRabais.set(idNewcode, r);
        //code, montant_rabais, id_type, description, date_debut, date_fin) "
        bd.execution("UPDATE" + bd.getTableRabais() + "SET 'code' = '" +r.getCode()+ "', 'id_type' = '" + r.getNoType() + "', 'description' = '" +
             r.getDescription() + "', 'date_debut' = '" +r.getDateDebut() + "', 'date_fin' = '" + r.getDateFin() + "'");

        return true;
    }
}
