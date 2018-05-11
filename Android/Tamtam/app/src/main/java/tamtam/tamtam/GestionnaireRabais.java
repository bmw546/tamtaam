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

        listeRabais.add(r);
        //+ ajouter le rabais selon le code;

        //si un autre rabais a le meme code
        //return false

        return true;
    }

    public void supprimerRabais(rabais r){

        listeRabais.remove(r);
        //+ supprimer le rabais selon le code;

    }

    public Boolean modifierRabais(String oldCode,rabais r){
        //cherche le rabais dans l'array list correspondant au vieux code et modifie le bon rabais

        //pour bd: set rabais where code = oldcode, etc.

        //si un autre rabais a le meme code
        //return false

        return true;
    }
}
