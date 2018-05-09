package tamtam.tamtam;

public class type_rabais {

    private int id;
    private String nom;
    private String description;

    public type_rabais() {
        this.id = 0;
        this.nom = "";
        this.description = "";
    }

    public type_rabais(int id, String nom, String description) {
        this.id = id;
        this.nom = nom;
        this.description = description;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }
}
