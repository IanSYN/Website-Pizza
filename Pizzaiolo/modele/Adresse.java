package Modele;

public class Adresse {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private int cpt = 1;
    private int IdAdresse;
    private float Latitude;
    private float Longitude;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public Adresse(float latitude, float longitude) {
        this.IdAdresse = cpt;
        this.Latitude = latitude;
        this.Longitude = longitude;
        cpt++;
    }

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    public int getIdAdresse() {
        return IdAdresse;
    }

    public void setIdAdresse(int idAdresse) {
        this.IdAdresse = idAdresse;
    }

    public float getLatitude() {
        return Latitude;
    }

    public void setLatitude(float latitude) {
        this.Latitude = latitude;
    }

    public float getLongitude() {
        return Longitude;
    }

    public void setLongitude(float longitude) {
        this.Longitude = longitude;
    }

    // ***********************************
    // ******* METHODES ******************
    // ***********************************
}
