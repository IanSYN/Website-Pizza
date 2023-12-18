package modele;

public class Adresse {
    double latitudeGPS;
    double longitudeGPS;

    public Adresse(double latitudeGPS, double longitudeGPS) {
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
}
