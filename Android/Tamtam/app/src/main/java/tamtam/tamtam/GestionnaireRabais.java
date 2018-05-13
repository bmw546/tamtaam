package tamtam.tamtam;

import android.widget.Toast;

import java.util.ArrayList;

public class GestionnaireRabais {

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
    }
    public Boolean ajouterRabais(rabais r){

        for(int i =0; i< listeRabais.size(); i++){
            if (listeRabais.get(i).getCode() == r.getCode())
            {
                return false;
            }
        }

        listeRabais.add(r);
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
