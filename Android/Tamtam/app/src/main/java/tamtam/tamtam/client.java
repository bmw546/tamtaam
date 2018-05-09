package tamtam.tamtam;

public class client {

    private int id;
    private String nom;
    private String mot_de_passe;
    private String courriel;
    private String adresse;
    private String telephone;
    private int longitude;
    private int latitude;

    public client(int id, String nom, String mot_de_passe, String courriel, String adresse, String telephone, int longitude, int latitude) {
        this.id = id;
        this.nom = nom;
        this.mot_de_passe = mot_de_passe;
        this.courriel = courriel;
        this.adresse = adresse;
        this.telephone = telephone;
        this.longitude = longitude;
        this.latitude = latitude;
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

    public String getMot_de_passe() {
        return mot_de_passe;
    }

    public void setMot_de_passe(String mot_de_passe) {
        this.mot_de_passe = mot_de_passe;
    }

    public String getCourriel() {
        return courriel;
    }

    public void setCourriel(String courriel) {
        this.courriel = courriel;
    }

    public String getAdresse() {
        return adresse;
    }

    public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

    public String getTelephone() {
        return telephone;
    }

    public void setTelephone(String telephone) {
        this.telephone = telephone;
    }

    public int getLongitude() {
        return longitude;
    }

    public void setLongitude(int longitude) {
        this.longitude = longitude;
    }

    public int getLatitude() {
        return latitude;
    }

    public void setLatitude(int latitude) {
        this.latitude = latitude;
    }
}

