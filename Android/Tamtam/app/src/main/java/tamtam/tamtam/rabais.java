package tamtam.tamtam;

import java.util.Date;

public class rabais {

    private String code_rabais;
    private float montant;
    private String description;
    private String dateDebut;
    private String dateFin;
    private int id_type;

    public rabais() {

    }

    public rabais(String code_rabais, float montant, String description, String dateDebut, String dateFin, int id_type) {
        this.code_rabais = code_rabais;
        this.montant = montant;
        this.description = description;
        this.dateDebut = dateDebut;
        this.dateFin = dateFin;
        this.id_type = id_type;
    }

    public String getCode_rabais() {
        return code_rabais;
    }

    public void setCode_rabais(String code_rabais) {
        this.code_rabais = code_rabais;
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

    public int getId_type() {
        return id_type;
    }

    public void setId_type(int id_type) {
        this.id_type = id_type;
    }
}
