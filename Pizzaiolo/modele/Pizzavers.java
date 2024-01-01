package Modele;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.*;
import Config.OutilsJDBC;
<<<<<<< HEAD
import Modele.*;
=======
import Modele.Commande;
>>>>>>> refs/remotes/origin/main
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

    public static void remplirListeProduits() throws SQLException {

        String query = "SELECT idProduit, nomProduit FROM Produit";
        //ResultSet rs = OutilsJDBC.exec1Requete(query, co, 1);

        // On récupère les produits et on en forme des instances de Produit
        while (rs.next()) {
            Produit P = new Produit(rs.getInt(1), rs.getString(2));
            listeProduits.add(P);
        }
        //ça marche
        // for (Produit Produit : listeProduits) {
        //     System.out.println(Produit.getNomProduit());
        // }

        query = "SELECT numRue, nomRue, ville, CodePostal, latitudeGPS, longitudeGPS FROM `Adresse`";
        rs = OutilsJDBC.exec1Requete(query, co, 1);
        while (rs.next()) {
            String adr = rs.getString(1) + " " + rs.getString(2) + " " + rs.getString(3) + " " + rs.getString(4);
            Adresse Adresse = new Adresse(adr, rs.getDouble(5), rs.getDouble(6));
            listeAdresses.add(Adresse);
        }

        //ça marche
        // for (Adresse adresse : listeAdresses) {
        //     System.out.println(adresse.getAdresseArrivee());
        // }

        query = "SELECT idPizza, nomProduit, nomTaille FROM `VPizza`";
        rs = OutilsJDBC.exec1Requete(query, co, 1);

        while (rs.next()) {
            Pizza S = new Pizza(rs.getInt(1), rs.getString(2), rs.getString(3));
            listePizzas.add(S);
        }

        // for (Pizza pizza : listePizzas) {
        //     System.out.println(pizza.getNomPizza());
        // }

        query = "SELECT idIngredient, nomIngredient, stockIngredient, prixIngredient FROM `Ingredient`";
        rs = OutilsJDBC.exec1Requete(query, co, 1);

        while (rs.next()) {
            Ingredient I = new Ingredient(rs.getInt(1), rs.getString(2), rs.getInt(3), rs.getInt(4));
            listeIngredients.add(I);
        }

        // for (Ingredient ingredient : listeIngredients) {
        //     System.out.println(ingredient.getNomIngredient());
        // }

        //Doublons
        // query = "SELECT idPizza, nomProduit, nomTaille FROM `VPizza`";
        // rs = OutilsJDBC.exec1Requete(query, co, 1);

        // while (rs.next()) {
        //     Pizza S = new Pizza(rs.getInt(1), rs.getString(2), rs.getString(3));
        //     listePizzas.add(S);
        // }

        // for (Pizza pizza : listePizzas) {
        //     System.out.println(pizza.getNomPizza());
        // }

        query = "SELECT idCommande, prixTotalCommande, idAdresse FROM `Commande` WHERE idEtatCommande = 2";
        rs = OutilsJDBC.exec1Requete(query, co, 1);

        while (rs.next()) {
            Commande C = new Commande(rs.getInt(1), listeAdresses.get(rs.getInt(3) - 1), rs.getFloat(2));
            if(!listeCommandes.contains(C)){
                listeCommandes.add(C);
            }
        }

        // for (Commande commande : listeCommandes) {
        //     commande.afficherPanier();
        // }
        listeCommandes.get(0).afficherPanier();
    }

    // Création du launcher de l'application
    public void lancerApplication(ArrayList<Commande> listeCommande){
        //lancer la page d'accueil
        new VueListPizza(this, listeCommande);
    }

    // public void afficher(ArrayList<Object> list){
    //     for (Object object : list) {
    //         System.out.println(object);
    //     }
    // }

    public void reload(){
        Timer timer = new Timer();
        timer.schedule(new TimerTask() {
            @Override
            public void run() {
                try {
                    remplirListeProduits();
                    reload();
                    lancerApplication(listeCommandes);
                } catch (SQLException e) {
                    System.err.println(e);
                }
                System.out.println("nouvelle commande");
            }
        }, 10, 1);
    }

    public static void main(String[] args) {
        // ArrayList<Produit> listeProduits = new ArrayList<Produit>();
        // Produit produit1 = new Produit(1,"Pizza 4 fromages", 10.00f);
        // Produit produit2 = new Produit(1,"Pizza de la hess ", 18.00f);
        // listeProduits.add(produit1);
        // listeProduits.add(produit2);

        // ArrayList<Produit> listeProduits2 = new ArrayList<Produit>();
        // Produit produit3 = new Produit(1,"Pizza 2 fromages", 10.00f);
        // Produit produit4 = new Produit(1,"Pizza de la richesse ", 18.00f);
        // listeProduits2.add(produit3);
        // listeProduits2.add(produit4);

        // Commande commande1 = new Commande(1, new Adresse("13 Avenue des sciences Gif sur yvette",48.711734, 2.1705202),15.00, listeProduits);
        // Commande commande2 = new Commande(2, new Adresse("13 Avenue des sciences Gif sur yvette",48.711734, 2.1705202),15.00, listeProduits2);

        // listeCommandes = new ArrayList<Commande>();
        // listeCommandes.add(commande1);
        // listeCommandes.add(commande2);
        try {
                //remplirListeProduits();

                Produit produit1 = new Produit(1,"Pizza 4 fromages");
                Produit produit2 = new Produit(1,"Pizza de la hess ");

                listeProduits.add(produit1);
                listeProduits.add(produit2);


                Commande c1 = new Commande(1, null, 45.00, listeProduits);
                Commande c2 = new Commande(2, null, 15.00, listeProduits);
                Commande c3 = new Commande(3, null, 25.00, listeProduits);
                listeCommandes.add(c1);
                listeCommandes.add(c2);
                listeCommandes.add(c3);

                Pizzavers application = new Pizzavers();
                application.lancerApplication(listeCommandes);

                //OutilsJDBC.closeConnection(co);
            } catch (Exception e)   {
                System.out.println(e);
            }
	}
}
