package Modele;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import Config.OutilsJDBC;
import Modele.Commande;
import Vues.VueListPizza;

public class Pizzavers {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************
    
    // Connexion à la base de données
    // public static String url = "jdbc:mysql://projets.iut-orsay.fr:3306/saes3pizzavers";
    // public static Connection co = OutilsJDBC.openConnection(url);

    public static ArrayList<Commande> listeCommandes = new ArrayList<Commande>();
    //public static ArrayList<Produit> listeProduits = new ArrayList<Produit>();

    // ***********************************
    // ******* METHODES ******************
    // ***********************************

    // public static void remplirListeProduits() throws SQLException {

    //     String query = "SELECT nomProduit, prixProduit, coverProduit FROM `Produit`";
    //     ResultSet rs = OutilsJDBC.exec1Requete(query, co, 1);

    //     // On récupère les produits et on en forme des instances de Produit
    //     while (rs.next()) {
    //         listeProduits.add(new Produit(rs.getString(1), rs.getFloat(2), rs.getString(3)));
    //     }
    // }

    // public static void remplirListeCommandes() throws SQLException {

    //     String query = "SELECT nomProduit, prixProduit, coverProduit FROM `Produit`";
    //     ResultSet rs = OutilsJDBC.exec1Requete(query, co, 1);
    // }

    // Création du launcher de l'application
    public void lancerApplication(ArrayList<Commande> listeCommande){
        //lancer la page d'accueil
        new VueListPizza(this, new Commande(), listeCommande);
    }

    // public void afficher(ArrayList<Object> list){
    //     for (Object object : list) {
    //         System.out.println(object);
    //     }
    // }

    public static void main(String[] args) {
        ArrayList<Produit> listeProduits = new ArrayList<Produit>();
        Produit produit1 = new Produit("Pizza 4 fromages", 10.00f, "https://www.pizzapai.fr/var/ezdemo_site/storage/images/media/images/pizza-4-fromages/104-1-fre-FR/Pizza-4-fromages.jpg");
        listeProduits.add(produit1);

        Commande commande1 = new Commande(1, new Adresse("13 Avenue des sciences Gif sur yvette",48.711734, 2.1705202),15.00, listeProduits);
        listeCommandes = new ArrayList<Commande>();
        listeCommandes.add(commande1);
        try {
                //remplirListeProduits();

                Pizzavers application = new Pizzavers();
                application.lancerApplication(listeCommandes);

            } catch (Exception e)   {
                System.out.println(e);
            }
	}
}
