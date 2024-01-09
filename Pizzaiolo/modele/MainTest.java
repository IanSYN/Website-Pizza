package Modele;

import java.util.ArrayList;

public class MainTest {
    public static void main(String[] args) {
        Livreur livreur = new Livreur();
        ArrayList<Produit> commandeEnAttenteDeLivraison1 = new ArrayList<>();
        ArrayList<Produit> commandeEnAttenteDeLivraison2 = new ArrayList<>();
        ArrayList<Produit> commandeEnAttenteDeLivraison3 = new ArrayList<>();
        Produit produit1 = new Produit(1,"Pizza 4 fromages");
        Produit produit2 = new Produit(2,"Pizza de la hess");
        Produit produit3 = new Produit(3,"Coca");
        Produit produit4 = new Produit(4,"Pistache");
        Produit produit5 = new Produit(5,"Pizza du crous");
        commandeEnAttenteDeLivraison1.add(produit1);
        commandeEnAttenteDeLivraison1.add(produit2);
        commandeEnAttenteDeLivraison2.add(produit4);
        commandeEnAttenteDeLivraison3.add(produit3);
        commandeEnAttenteDeLivraison3.add(produit5);

        // Création de quelques commandes
        Commande commande1 = new Commande(1, new Adresse("13 Avenue des sciences Gif sur yvette",48.711734, 2.1705202),15.0, commandeEnAttenteDeLivraison1);
        Commande commande2 = new Commande(2, new Adresse("25 Rue de la Paix Evry",48.629080, 2.441800), 6.00 ,commandeEnAttenteDeLivraison3);
        Commande commande3 = new Commande(3, new Adresse("8 Rue du Commerce Massy",48.714170,2.245200), -5.0, commandeEnAttenteDeLivraison2);
        Commande commande4 = new Commande(4, new Adresse("Avenue de la République",8.696670,2.308330), 12.0, commandeEnAttenteDeLivraison1);
        Commande commande5 = new Commande(5, new Adresse("8 Rue du Commerce Massy",48.676670,2.350000), 22.0, commandeEnAttenteDeLivraison2);
        Commande commande6 = new Commande(6, new Adresse("4 avenue des Pere pleins",48.672220,2.383330), -15.00, commandeEnAttenteDeLivraison3);
        Commande commande7 = new Commande(7, new Adresse("92 boulevard du ménage",48.612500,2.315830), -7.0, commandeEnAttenteDeLivraison3);
        Commande commande8 = new Commande(8, new Adresse("6 rue du sapristi",48.707780,2.386110), 2.0, commandeEnAttenteDeLivraison2);
        Commande commande9 = new Commande(9, new Adresse("96 Avenue de Komaeda",48.637500,2.327780), 35, commandeEnAttenteDeLivraison1);
        Commande commande10 = new Commande(10, new Adresse("444 rue de la mort",48.726620, 2.274420), 13.0, commandeEnAttenteDeLivraison2);

        commande1.afficherLaCommande();
        System.out.println("ici \n");

        // Ajout des commandes au cargo du livreur
        livreur.addCommandePrete(commande1);
        livreur.addCommandePrete(commande2);
        livreur.addCommandePrete(commande3);
        livreur.addCommandePrete(commande4);
        livreur.addCommandePrete(commande5);
        livreur.addCommandePrete(commande6);
        livreur.addCommandePrete(commande7);
        livreur.addCommandePrete(commande8);
        livreur.addCommandePrete(commande9);
        livreur.addCommandePrete(commande10);

        livreur.remplirCopyList(livreur.getCommandePrete());

        System.out.println("Debut du test de l'algo d'ajout des commandes pour la livraison \n");
        // Affichage de toutes les commandes en attente de prise en charge
        livreur.afficherLesCommandesPretes();
        // Affichage de toutes les commandes actuellement dans le cargo/batch de livraison
        livreur.afficherCargo();
        
        //test 
        System.out.println("Voici la commande ayant le temps le moins élevé parmis les temps positifs \n");
        livreur.tempsMin(livreur.getCommandePrete()).afficherLaCommande();
        System.out.println("Voici la commande ayant actuellement le meilleur ratio Temps/Distance \n"); 
        livreur.meilleurRatio(livreur.getCommandePrete()).afficherLaCommande();       

        /*Rajoute a hauteur de 5 commandes max dans le cargo, les commandes qui doivent etre livré en priorité 
        (parmi les commandes pretes et en attente de prise en charge)
        et optimise l'ordre de livraison des commandes dans le cargo*/
        livreur.GloutonPos(livreur.getCommandePrete());
        livreur. removeToRemove(livreur.getCommandePrete());

        //Nous Raffichons les commandes en attente de prise en charge 
        livreur.afficherLesCommandesPretes();
        System.out.println("Le test a bien fonctionné ! \n");
        //Nous raffichons les commandes actuellement dans le cargo/batch de livraison
        //livreur.afficherCargo();
    }
}
