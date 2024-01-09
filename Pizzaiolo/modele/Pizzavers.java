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
    //public static Connection co = OutilsJDBC.openConnection();

    public static ArrayList<Commande> listeCommandes = new ArrayList<Commande>();
    public static ArrayList<Produit> listeProduits = new ArrayList<Produit>();
    public static ArrayList<Adresse> listeAdresses = new ArrayList<Adresse>();
    public static ArrayList<Pizza> listePizzas = new ArrayList<Pizza>();
    public static ArrayList<Ingredient> listeIngredients = new ArrayList<Ingredient>();

    // ***********************************
    // ******* METHODES ******************
    // ***********************************

    // public static void remplirListeProduits() throws SQLException {

    //     String query = "SELECT idProduit, nomProduit FROM Produit";
    //     ResultSet rs = OutilsJDBC.exec1Requete(query, co, 1);

    //     // On récupère les produits et on en forme des instances de Produit
    //     while (rs.next()) {
    //         Produit P = new Produit(rs.getInt(1), rs.getString(2));
    //         if (!listeProduits.contains(P)) {
    //             listeProduits.add(P);
    //         }
    //     }
    //     //ça marche
    //     // for (Produit Produit : listeProduits) {
    //     //     System.out.println(Produit.getNomProduit());
    //     // }

    //     query = "SELECT numRue, nomRue, ville, CodePostal, latitudeGPS, longitudeGPS FROM `Adresse`";
    //     rs = OutilsJDBC.exec1Requete(query, co, 1);

    //     while (rs.next()) {
    //         listeAdresses.add(null);
    //         String adr = rs.getString(1) + " " + rs.getString(2) + " " + rs.getString(3) + " " + rs.getString(4);
    //         Adresse Adresse = new Adresse(adr, rs.getDouble(5), rs.getDouble(6));
    //         if(!listeAdresses.contains(Adresse)){
    //             listeAdresses.add(Adresse);
    //         }
    //     }

    //     //ça marche
    //     // for (Adresse adresse : listeAdresses) {
    //     //     System.out.println(adresse.getAdresseArrivee());
    //     // }

    //     query = "SELECT idPizza, nomProduit, nomTaille FROM `VPizza`";
    //     rs = OutilsJDBC.exec1Requete(query, co, 1);

    //     while (rs.next()) {
    //         Pizza S = new Pizza(rs.getInt(1), rs.getString(2), rs.getString(3));
    //         if (!listePizzas.contains(S)) {
    //             listePizzas.add(S);
    //         }
    //     }

    //     // for (Pizza pizza : listePizzas) {
    //     //     System.out.println(pizza.getNomPizza());
    //     // }

    //     query = "SELECT idIngredient, nomIngredient, stockIngredient, prixIngredient FROM `Ingredient`";
    //     rs = OutilsJDBC.exec1Requete(query, co, 1);

    //     while (rs.next()) {
    //         Ingredient I = new Ingredient(rs.getInt(1), rs.getString(2), rs.getInt(3), rs.getInt(4));
    //         if (!listeIngredients.contains(I)) {
    //             listeIngredients.add(I);
    //         }
    //     }

    //     // for (Ingredient ingredient : listeIngredients) {
    //     //     System.out.println(ingredient.getNomIngredient());
    //     // }

    //     query = "SELECT idCommande, prixTotalCommande, idAdresse FROM `Commande` WHERE idEtatCommande = 2";
    //     rs = OutilsJDBC.exec1Requete(query, co, 1);

    //     while (rs.next()) {
    //         Commande C = new Commande(rs.getInt(1), listeAdresses.get(rs.getInt(3)), rs.getFloat(2));
    //         if(!listeCommandes.contains(C)){
    //             listeCommandes.add(C);
    //         }
    //     }

    //     // for (Commande commande : listeCommandes) {
    //     //     commande.afficherPanier();
    //     // }
    //     //listeCommandes.get(0).afficherPanier();
    // }

    // Création du launcher de l'application
    public void lancerApplication(ArrayList<Commande> listeCommande){
        //lancer la page d'accueil
        new VueListPizza(this, listeCommande);
        //reload();
    }

    // public void afficher(ArrayList<Object> list){
    //     for (Object object : list) {
    //         System.out.println(object);
    //     }
    // }

    // public ArrayList<Commande> reload(){
    //     clearAll();
    //     try {
    //         co = OutilsJDBC.openConnection();
    //         remplirListeProduits();
    //         OutilsJDBC.closeConnection(co);
    //     }
    //     catch (SQLException e) {
    //         e.printStackTrace();
    //     }
    //     return listeCommandes;
    // }

    public void clearAll(){
        listeCommandes.clear();
        listeProduits.clear();
        listeAdresses.clear();
        listePizzas.clear();
        listeIngredients.clear();
    }

    public static void main(String[] args) {
        Produit produit1 = new Produit(1,"Pizza 4 fromages");
        Produit produit2 = new Produit(2,"Pizza de la hess");
        Produit produit3 = new Produit(3,"Coca");
        Produit produit4 = new Produit(4,"Pistache");
        Produit produit5 = new Produit(5,"Pizza du crous");
        Produit produit6 = new Produit(6,"Pizza de la mort");
        Produit produit7 = new Produit(7,"Pizza de la vie");
        Produit produit8 = new Produit(8,"Pizza de la fin");
        Produit produit9 = new Produit(9,"Pizza de la faim");
        listeProduits.add(produit1);
        listeProduits.add(produit2);
        listeProduits.add(produit3);
        listeProduits.add(produit4);
        listeProduits.add(produit5);
        listeProduits.add(produit6);
        listeProduits.add(produit7);
        listeProduits.add(produit8);
        listeProduits.add(produit9);

        Commande commande1 = new Commande(1, new Adresse("13 Avenue des sciences Gif sur yvette",48.711734, 2.1705202),15.0, listeProduits);
        Commande commande2 = new Commande(2, new Adresse("25 Rue de la Paix Evry",48.629080, 2.441800), 6.00 ,listeProduits);
        Commande commande3 = new Commande(3, new Adresse("8 Rue du Commerce Massy",48.714170,2.245200), -5.0, listeProduits);
        Commande commande4 = new Commande(4, new Adresse("Avenue de la République",8.696670,2.308330), 12.0, listeProduits);
        Commande commande5 = new Commande(5, new Adresse("8 Rue du Commerce Massy",48.676670,2.350000), 22.0, listeProduits);
        Commande commande6 = new Commande(6, new Adresse("4 avenue des Pere pleins",48.672220,2.383330), -15.00, listeProduits);
        Commande commande7 = new Commande(7, new Adresse("92 boulevard du ménage",48.612500,2.315830), -7.0, listeProduits);
        Commande commande8 = new Commande(8, new Adresse("6 rue du sapristi",48.707780,2.386110), 2.0, listeProduits);
        Commande commande9 = new Commande(9, new Adresse("96 Avenue de Komaeda",48.637500,2.327780), 35, listeProduits);
        Commande commande10 = new Commande(10, new Adresse("444 rue de la mort",48.726620, 2.274420), 13.0, listeProduits);
        
        listeCommandes.add(commande1);
        listeCommandes.add(commande2);
        // listeCommandes.add(commande3);
        // listeCommandes.add(commande4);
        // listeCommandes.add(commande5);
        // listeCommandes.add(commande6);
        // listeCommandes.add(commande7);
        // listeCommandes.add(commande8);
        // listeCommandes.add(commande9);
        // listeCommandes.add(commande10);

        try {
                //remplirListeProduits();
                System.out.println();

                Pizzavers application = new Pizzavers();
                application.lancerApplication(listeCommandes);

            } catch (Exception e)   {
                System.out.println(e);
            }
	}
}
