package Modele;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.*;
import Config.OutilsJDBC;
import Modele.*;
import Vues.VueListPizza;

public class Pizzavers {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    // Connexion à la base de données
    public static Connection co = OutilsJDBC.openConnection();

    public static ArrayList<Commande> listeCommandes = new ArrayList<Commande>();
    public static ArrayList<Produit> listeProduits = new ArrayList<Produit>();
    public static ArrayList<Adresse> listeAdresses = new ArrayList<Adresse>();
    public static ArrayList<Pizza> listePizzas = new ArrayList<Pizza>();
    public static ArrayList<Ingredient> listeIngredients = new ArrayList<Ingredient>();

    // ***********************************
    // ******* METHODES ******************
    // ***********************************

    public static void remplirListeProduits() throws SQLException {

        String query = "SELECT idProduit, nomProduit FROM Produit";
        ResultSet rs = OutilsJDBC.exec1Requete(query, co, 1);

        // On récupère les produits et on en forme des instances de Produit
        while (rs.next()) {
            Produit P = new Produit(rs.getInt(1), rs.getString(2));
            if (!listeProduits.contains(P)) {
                listeProduits.add(P);
            }
        }
        //ça marche
        // for (Produit Produit : listeProduits) {
        //     System.out.println(Produit.getNomProduit());
        // }

        query = "SELECT numRue, nomRue, ville, CodePostal, latitudeGPS, longitudeGPS FROM `Adresse`";
        rs = OutilsJDBC.exec1Requete(query, co, 1);

        while (rs.next()) {
            listeAdresses.add(null);
            String adr = rs.getString(1) + " " + rs.getString(2) + " " + rs.getString(3) + " " + rs.getString(4);
            Adresse Adresse = new Adresse(adr, rs.getDouble(5), rs.getDouble(6));
            if(!listeAdresses.contains(Adresse)){
                listeAdresses.add(Adresse);
            }
        }

        //ça marche
        // for (Adresse adresse : listeAdresses) {
        //     System.out.println(adresse.getAdresseArrivee());
        // }

        query = "SELECT idPizza, nomProduit, nomTaille FROM `VPizza`";
        rs = OutilsJDBC.exec1Requete(query, co, 1);

        while (rs.next()) {
            Pizza S = new Pizza(rs.getInt(1), rs.getString(2), rs.getString(3));
            if (!listePizzas.contains(S)) {
                listePizzas.add(S);
            }
        }

        // for (Pizza pizza : listePizzas) {
        //     System.out.println(pizza.getNomPizza());
        // }

        query = "SELECT idIngredient, nomIngredient, stockIngredient, prixIngredient FROM `Ingredient`";
        rs = OutilsJDBC.exec1Requete(query, co, 1);

        while (rs.next()) {
            Ingredient I = new Ingredient(rs.getInt(1), rs.getString(2), rs.getInt(3), rs.getInt(4));
            if (!listeIngredients.contains(I)) {
                listeIngredients.add(I);
            }
        }

        // for (Ingredient ingredient : listeIngredients) {
        //     System.out.println(ingredient.getNomIngredient());
        // }

        query = "SELECT idCommande, prixTotalCommande, idAdresse FROM `Commande` WHERE idEtatCommande = 2";
        rs = OutilsJDBC.exec1Requete(query, co, 1);

        while (rs.next()) {
            Commande C = new Commande(rs.getInt(1), listeAdresses.get(rs.getInt(3)), rs.getFloat(2));
            if(!listeCommandes.contains(C)){
                listeCommandes.add(C);
            }
        }

        // for (Commande commande : listeCommandes) {
        //     commande.afficherPanier();
        // }
        //listeCommandes.get(0).afficherPanier();
    }

    // Création du launcher de l'application
    public void lancerApplication(ArrayList<Commande> listeCommande){
        //lancer la page d'accueil
        new VueListPizza(this, listeCommande);
        reload();
    }

    // public void afficher(ArrayList<Object> list){
    //     for (Object object : list) {
    //         System.out.println(object);
    //     }
    // }

    public ArrayList<Commande> reload(){
        clearAll();
        try {
            co = OutilsJDBC.openConnection();
            remplirListeProduits();
            OutilsJDBC.closeConnection(co);
        }
        catch (SQLException e) {
            e.printStackTrace();
        }
        return listeCommandes;
    }

    public void clearAll(){
        listeCommandes.clear();
        listeProduits.clear();
        listeAdresses.clear();
        listePizzas.clear();
        listeIngredients.clear();
    }

    public static void main(String[] args) {
        try {
                remplirListeProduits();
                System.out.println();

                Pizzavers application = new Pizzavers();
                application.lancerApplication(listeCommandes);

            } catch (Exception e)   {
                System.out.println(e);
            }
	}
}
