package modele;

import java.time.Duration;
import java.time.LocalDateTime;
import java.util.ArrayList;

public class Commande {
    private double tempsRestant;
    private Adresse adresseArrivee;
    private ArrayList<Produit> laCommande;
    private boolean ready = false;
    //ArrayList<Commande> commandePrete;
    private double ratio;
    private LocalDateTime dateCommande;
    private int numCommande;

    //Constructeur
    public Commande(int numCommande, Adresse adresseArrivee, double tempsRest, ArrayList<Produit> laCommande) {
        this.numCommande = numCommande;
        this.adresseArrivee = adresseArrivee;
        this.tempsRestant = tempsRest;
        this.laCommande = laCommande;
        this.dateCommande = LocalDateTime.now();
        this.ratio = 0;
    }

    /*public Commande(int numCommande) {
        this.numCommande = numCommande;
        this.adresseArrivee = null;
        this.laCommande = null;
        this.dateCommande = LocalDateTime.now();
    }*/

    //merci de me laisser mon constructeur de test :
    public Commande(){
        this.numCommande = 1;
        this.adresseArrivee = null;
        this.laCommande = null;
        this.dateCommande = LocalDateTime.now();
    }

    // Getters and Setters
    public double getTempsRestant() {
        return tempsRestant;
    }

    public void setTempsRestant(float tempsRestant) {
        this.tempsRestant = tempsRestant;
    }

    public Adresse getAdresseArrivee() {
        return adresseArrivee;
    }

    public void setAdresseArrivee(Adresse adresseArrivee) {
        this.adresseArrivee = adresseArrivee;
    }

    public void setLaCommande(ArrayList<Produit> laCommande) {
        this.laCommande = laCommande;
    }

    public boolean isReady() {
        return ready;
    }

    public void setReady(boolean ready) {
        this.ready = ready;
    }

    public double getRatio() {
        return ratio;
    }

    public void setRatio(float ratio) {
        this.ratio = ratio;
    }

    public LocalDateTime getDateCommande() {
        return dateCommande;
    }

    public void setDateCommande(LocalDateTime dateCommande) {
        this.dateCommande = dateCommande;
    }

    public int getNumCommande(){
        return numCommande;
    }

    public void setNumCommande(int numCommande) {
        this.numCommande = numCommande;
    }

    public ArrayList<Produit> getCommande(){
        return laCommande;
    }

    public float getPrixCommande(){
        float prix = 0;
        for (Produit prod : laCommande) {
            prix += prod.getPrixProduit();
        }
        return prix;
    }

    //methode

    public String toString() {
        String resultat = "";

        for (int i = 0; i< laCommande.size(); i++){
            resultat += laCommande.get(i).toString() + ", ";
        }

        resultat = resultat.substring(0, resultat.length() - 2); // on retire les deux derniers caractères pour enlever la dernière virgule

        return resultat;
    }

    public void afficherLaCommande(){
        System.out.println("Version toString");
        toString();
        System.out.println("Version complete");
        int nbrProd = laCommande.size();
        System.out.println("La commande " + this.getNumCommande() + " est composé de " + nbrProd +" produits.");
        System.out.println("Elle contient : ");
        for (Produit prod  : this.laCommande) {
            if (prod != null){
                System.out.println(" - " +prod.getNomProduit());
            }
        }
    }

    public void calcRatio(double tempsRestant, Adresse ad1) {
        //float distance;
        Adresse ad2 = adresseArrivee;
        this.ratio = tempsRestant / calcDistance(ad1, ad2);
    }

    public Duration calcDureeRestante(LocalDateTime dateCom, LocalDateTime sysDate) {
        sysDate = LocalDateTime.now();
        return Duration.between(dateCom, sysDate);
    }

    public LocalDateTime dateHeureFinal(LocalDateTime dateCom, LocalDateTime sysDate) {
        sysDate = LocalDateTime.now();
        return LocalDateTime.now().minus(calcDureeRestante(dateCom, sysDate));
    }

    public void prete() {
        this.ready = true;
    }

    public float calcDistance(Adresse adresseArrivee, Adresse adresseDepart) {
        final int R = 6371; // Rayon de la Terre en kilomètres

        double lat1 = Math.toRadians(adresseDepart.getLatitude());
        double lon1 = Math.toRadians(adresseDepart.getLongitude());
        double lat2 = Math.toRadians(adresseArrivee.getLatitude());
        double lon2 = Math.toRadians(adresseArrivee.getLongitude());

        double dLat = lat2 - lat1;
        double dLon = lon2 - lon1;

        double a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                   Math.cos(lat1) * Math.cos(lat2) *
                   Math.sin(dLon / 2) * Math.sin(dLon / 2);

        double c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        float distance = (float) (R * c); // La distance résultante en kilomètres
        return distance;
    }
}
