package tamtam.tamtam;

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
    public void ajouterRabais(rabais r){
        listeRabais.add(r);
    }

    public void supprimerRabais(rabais r){
        listeRabais.remove(r);
    }

    public void modifierRabais(rabais r){

    }
}
