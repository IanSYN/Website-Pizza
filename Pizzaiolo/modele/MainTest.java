package Modele;

import java.util.ArrayList;

public class MainTest {
    public static void main(String[] args) {
        Livreur livreur = new Livreur();

        // Création de quelques commandes
        Commande commande1 = new Commande(1, new Adresse("13 Avenue des sciences Gif sur yvette",48.711734, 2.1705202),15.00, new ArrayList<>());
        Commande commande2 = new Commande(2, new Adresse("25 Rue de la Paix Evry",48.629080, 2.441800), 20.00 ,new ArrayList<>());
        Commande commande3 = new Commande(3, new Adresse("8 Rue du Commerce Massy",48.726620, 2.274420), -5.00, new ArrayList<>());

        commande1.afficherLaCommande();
        System.out.println("ici");

        // Ajout des commandes au cargo du livreur
        livreur.addCargo(commande1);
        livreur.addCargo(commande2);
        livreur.addCargo(commande3);

        // Affichage du contenu initial du cargo
        livreur.afficherCargo(livreur.getCargo());
        System.out.println("la");

        // Appel de la méthode DynamicPos pour optimiser la position des commandes dans le cargo
        livreur.DynamicPos(livreur.getCargo());

        // Affichage du cargo après l'optimisation
        livreur.afficherCargo(livreur.getCargo());
        System.out.println("li");
    }
}
