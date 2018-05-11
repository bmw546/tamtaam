package tamtam.tamtam;

import java.util.Date;

public class rabais {

    private String code;
    private float montant;
    private String description;
    private String dateDebut;
    private String dateFin;
    private char type; //lire l'id du type (1=%, 2=$) et mettre la bonne val dans cette var

    public rabais() {

    }

    public rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, char type) {
        this.code = code_rabais;
        this.montant = montant;
        this.description = description;
        this.dateDebut = dateDebut;
        this.dateFin = dateFin;
        this.type = type;
    }

    public String getCode() {
        return code;
    }

    public void setCode(String code_rabais) {
        this.code = code_rabais;
    }

    public float getMontant() {
        return montant;
    }

    public void setMontant(float montant) {
        this.montant = montant;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getDateDebut() {
        return dateDebut;
    }

    public void setDateDebut(String dateDebut) {
        this.dateDebut = dateDebut;
    }

    public String getDateFin() {
        return dateFin;
    }

    public void setDateFin(String dateFin) {
        this.dateFin = dateFin;
    }

    public String getType() {
        String type = "mauvais type";
        if (this.type == 1){
            type = "$";
        }else if(this.type == 2){
            type = "%";
        }
        return  type;
    }

    public int getNoType(){
        int type = 0;
        if (this.type == '$'){
            type = 1;
        }else if(this.type == '%'){
            type = 2;
        }

        return type;
    }

    public void setType(char id_type) {
        this.type = id_type;
    }
}
