package tamtam.tamtam;

public class produit {

    String nom;
    float prix;
    String format;

    public produit(String nom, float prix, String format) {
        this.nom = nom;
        this.prix = prix;
        this.format = format;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public float getQuantite() {
        return prix;
    }

    public void setQuantite(float prix) {
        this.prix = prix;
    }

    public String getFormat() {
        return format;
    }

    public void setFormat(String format) {
        this.format = format;
    }
}
