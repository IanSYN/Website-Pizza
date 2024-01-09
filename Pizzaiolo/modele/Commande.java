package Modele;

import java.sql.ResultSet;
import java.time.Duration;
import java.time.LocalDateTime;
import java.util.ArrayList;

import javax.naming.spi.DirStateFactory.Result;

import Config.*;
import Modele.*;

public class Commande {
    private double tempsRestant;
    private Adresse adresseArrivee;
    private ArrayList<Produit> laCommande;
    private boolean ready = false;
    private double ratio;
    private LocalDateTime dateCommande;
    private int numCommande;
    private float prixCommande;

    //Constructeur
    public Commande(int numCommande, Adresse adresseArrivee, double tempsRest, ArrayList<Produit> laCommande) {
        this.numCommande = numCommande;
        this.adresseArrivee = adresseArrivee;
        this.tempsRestant = tempsRest;
        this.laCommande = laCommande;
        this.dateCommande = LocalDateTime.now();
        this.ratio = 0;
    }

    public Commande(int numCommande, Adresse AdresseArrivee, ArrayList<Produit> laCommande) {
        this.numCommande = numCommande;
        this.adresseArrivee = AdresseArrivee;
        this.tempsRestant = 45.0;
        this.laCommande = Panier(numCommande);
        this.dateCommande = LocalDateTime.now();
        this.ratio = calcRatio(tempsRestant, adresseArrivee);
    }

    /*public Commande(int numCommande) {
        this.numCommande = numCommande;
        this.adresseArrivee = null;
        this.laCommande = null;
        this.dateCommande = LocalDateTime.now();
    }*/

    //merci de me laisser mon constructeur de test :
    public Commande(int numCommande, Adresse adresseArrivee, float prixCommande) {
        this.numCommande = numCommande;
        this.adresseArrivee = adresseArrivee;
        this.tempsRestant = 45.0;
        this.laCommande = Panier(this.numCommande);
        this.dateCommande = LocalDateTime.now();
        this.prixCommande = prixCommande;
        this.ratio = 0;
    }

    // Getters and Setters
    public double getTempsRestant() {
        return tempsRestant;
    }

    public void MoinsTempsRestant() {
        this.tempsRestant-=1;
    }

    public Adresse getAdresseArrivee() {
        return adresseArrivee;
    }

    public void setAdresseArrivee(Adresse adresseArrivee) {
        this.adresseArrivee = adresseArrivee;
    }

    /*public void setLaCommande(ArrayList<Produit> laCommande) {
        this.laCommande = laCommande;
    }*/

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
        return prixCommande;
    }

    // public float getPrixCommande(){
    //     float prix = 0;
    //     for (Produit prod : laCommande) {
    //         prix += prod.getPrixProduit();
    //     }
    //     return prix;
    // }

    //methode

    /*public String toString() {
        String resultat = "";

        for (int i = 0; i< laCommande.size(); i++){
            resultat += laCommande.get(i).toString() + ", ";
        }

        resultat = resultat.substring(0, resultat.length() - 2); // on retire les deux derniers caractères pour enlever la dernière virgule

        return resultat;
    }*/

    public void afficherLaCommande(){
        int nbrProd = laCommande.size();
        System.out.println("La commande " + this.getNumCommande() + " est composé de " + nbrProd +" produits.");
        System.out.println("Elle contient : ");
        for (Produit prod  : this.laCommande) {
            if (prod != null){
                System.out.println(" - " +prod.getNomProduit());
            }
        }
    }

    public Double calcRatio(double tempsRestant, Adresse ad1) {
        //float distance;
        Adresse ad2 = adresseArrivee;
        this.ratio = tempsRestant / calcDistance(ad1, ad2);
        return this.ratio;
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

    public ArrayList<Produit> Panier(int numCommande){
        System.out.println("\t commande " + numCommande + " , en cours");
        ArrayList<Produit> panier = new ArrayList<Produit>();
        String query = "SELECT idPizzaPersonnalisee, idPizza, idIngredient, quantitePizza, quantiteSupplement FROM `VPizzaPersonnalisee` WHERE idCommande = " + numCommande;
        ResultSet rs  = OutilsJDBC.ExecuteurSQL(query);
        try {
            while (rs.next()) {
                PizzaPersonnalisee p = new PizzaPersonnalisee(rs.getInt(1), rs.getInt(2), rs.getInt(3), rs.getInt(4), rs.getInt(5));
                panier.add(p);
            }
        }
        catch (Exception e){
            System.out.println(e);
        }
        //query = "SELECT idProduit, quantiteProduit FROM `VCommande` WHERE idCommande = " + numCommande;
        query = "SELECT idProduit, quantiteProduit FROM `Panier` WHERE idCommande = " + numCommande;
        rs  = OutilsJDBC.ExecuteurSQL(query);
        try {
            rs.absolute(0);
            while (rs.next()) {
                int idProduit = rs.getInt(1);
                //System.out.println(idProduit + " " + Pizzavers.listeProduits.get(idProduit-1).getNomProduit());;
                if(Pizzavers.listeProduits.get(idProduit-1) != null){
                    int valeur = rs.getInt(2);
                    for (int i = 0; i < valeur; i++) {
                        panier.add(Pizzavers.listeProduits.get(idProduit-1));
                    }
                }
                else{
                    System.out.println("Le produit n'existe pas");
                }
                // for (Produit produit : Pizzavers.listeProduits) {
                //     if (produit.getIdProduit() == idProduit) {
                //         int valeur = rs.getInt(2);
                //         for (int i = 0; i < valeur; i++) {
                //             panier.add(produit);
                //         }
                //     }
                // }
            }
        } catch (Exception e) {
            System.out.println(e);
        }
        return panier;
    }

    public void afficherPanier(){
        for (Produit produit : laCommande) {
            System.out.println(produit.getNomProduit() + "\t");
        }
    }
    
    public void codePromo(){
        //génération du code promo aleatoire et insert to base de donnée
        String codePromo = "";
        for (int i = 0; i < 8; i++) {
            int random = (int) (Math.random() * 26);
            codePromo += (char) (random + 65);
        }
        // String query = "INSERT INTO `Coupon`(`codeCoupon`, 'datePeremptionCoupon', `idClient`) VALUES ('" + codePromo + "', null, null')";
        // OutilsJDBC.ExecuteurSQL(query);
        System.out.println("Votre code promo est : " + codePromo);
    }
}