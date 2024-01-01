package Modele;


public class Adresse {
    String addresseArrivee;
    double latitudeGPS;
    double longitudeGPS;

    public Adresse(String addresseArrivee, double latitudeGPS, double longitudeGPS) {
        this.addresseArrivee = addresseArrivee;
        this.latitudeGPS = latitudeGPS;
        this.longitudeGPS = longitudeGPS;
    }
    
    // Getters
    public double getLatitude() {
        return latitudeGPS;
    }
    
    public double getLongitude() {
       return longitudeGPS;
    }

    public String getAdresseArrivee() {
       return addresseArrivee;
    }
}
