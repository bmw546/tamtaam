package tamtam.tamtam;

import android.content.Context;
import android.database.Cursor;
import android.widget.Toast;


import java.util.ArrayList;

public class GestionnaireRabais {

    private moteur_requete_bd bd;
    private ArrayList<rabais> listeRabais = new ArrayList<rabais>();
    private Context context;

    /**
     *  Set le context de l'activity courrante
     * @param c
     */
    public void setContext(Context c){
        context = c;
    }

    /**
     * Set la bd et selectionnes les rabais dans l'arraylist
     * @param myBD
     */
    public void init(moteur_requete_bd myBD) {
        bd = myBD;

        selectRabais();
    }


    /**
     *  Retourne la liste des rabais
     * @return listeRabais
     */
    public ArrayList<rabais> getListeRabais() {
        return listeRabais;
    }

    /**
     *  Sélectionnes les rabais dans la bd et les mets dans l'arraylist
     *
     */
    public void selectRabais() {
        //va select les rabais dans la bd et les mettre dans l'arraylist
        Cursor result = bd.execution_with_return("SELECT * FROM " + bd.getTableRabais());

        for (result.moveToFirst(); !result.isAfterLast(); result.moveToNext()) {
            rabais r = new rabais();
            //public rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, char type) {
            r.setCode(result.getString(result.getColumnIndex("code")));
            r.setMontant(result.getFloat(result.getColumnIndex("montant_rabais")));
            r.setDescription(result.getString(result.getColumnIndex("description")));
            int id_type = result.getInt(result.getColumnIndex("id_type"));
            if (id_type == 1) {
                r.setType('$');
            } else {
                r.setType('%');
            }
            r.setDateDebut(result.getString(result.getColumnIndex("date_debut")));
            r.setDateFin(result.getString(result.getColumnIndex("date_fin")));

            listeRabais.add(r);
        }


        result.close();
    }

    /**
     *  ajoute un rabais. Retourne vrai si succès, faux sinon.
     * @param r
     * @return  boolean
     */
    public Boolean ajouterRabais(rabais r) {

        Cursor result = bd.execution_with_return("SELECT * FROM " + bd.getTableRabais() + " WHERE code = '" + r.getCode() + "'");
        if (result.moveToFirst()) {
            result.close();
            return false;
        } else {
            result.close();
            //sinon il n'est pas utilisé alors on l'ajoute dans la bd
            listeRabais.add(r);

            String sql = "INSERT INTO " + bd.getTableRabais() + "(code, montant_rabais, id_type, description, date_debut, date_fin) " +
                    "VALUES ('" + r.getCode() + "', " + r.getMontant() + ", " + r.getNoType() + ", '" + r.getDescription() + "', " +
                    "'" + r.getDateDebut() + "', '" + r.getDateFin() + "')";

            bd.execution(sql);
        }

        return true;
    }

    /**
     *  supprimer un rabais
     * @param r
     */
    public void supprimerRabais(rabais r) {

        listeRabais.remove(r);
        bd.execution("DELETE FROM " + bd.getTableRabais() + " WHERE code =" + "'" + r.getCode() + "'");
    }

    public void toastMeThis(String message){
        Toast.makeText(context,message, Toast.LENGTH_LONG).show();
    }


    /**
     * Modifie un rabais dans l'arraylist et dans la bd
     * @param oldCode
     * @param  r
     * @return  boolean
     */
    public Boolean modifierRabais(String oldCode, rabais r) {

        int indiceTrouve = -1;
        //si on change pas le code
        if(oldCode.equals(r.getCode())){

        for (int i = 0; i < listeRabais.size(); i++){
            if (listeRabais.get(i).getCode().equals(r.getCode())){
                listeRabais.set(i,r);
                break;
            }
        }
        bd.execution("UPDATE " + bd.getTableRabais() + " SET 'montant_rabais' = '" + r.getMontant() + "', 'id_type' = '" + r.getNoType() + "', 'description' = '" +
                r.getDescription() + "', 'date_debut' = '" +r.getDateDebut() + "', 'date_fin' = '" + r.getDateFin() + "' " +
                "WHERE code ="+"'"+ oldCode +"';");

        return  true;
        }
        //sinon on change le code, ça veut dire que il faut regarder si le nouveau code est déja présent dans l'arraylist
        else{
            for (int i = 0; i<listeRabais.size(); i++){
                if (listeRabais.get(i).getCode().equals(r.getCode())){
                    return  false;
                }
                if (listeRabais.get(i).getCode().equals(r.getCode())){
                    indiceTrouve = i;
                }
            }

            if (indiceTrouve != 1) {
                listeRabais.set(indiceTrouve, r);

                //sinon le code na pas été trouvé alors on le modifie
                bd.execution("UPDATE " + bd.getTableRabais() + " SET 'code' = '" + r.getCode() + "', 'montant_rabais' = '" + r.getMontant() + "', 'id_type' = '" + r.getNoType() + "', 'description' = '" +
                        r.getDescription() + "', 'date_debut' = '" + r.getDateDebut() + "', 'date_fin' = '" + r.getDateFin() + "' " +
                        "WHERE code =" + "'" + oldCode + "';");

                return true;
            }else{
                return  false;
            }
        }
    }
}

