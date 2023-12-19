package Vues;
import javax.swing.*;
import java.awt.*;
import java.util.ArrayList;

import Modele.*;
/**
 * VueDetailCommande
 */
public class VueDetailCommande extends JPanel{
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private Pizzavers application;
    private Commande Modele;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public VueDetailCommande(Pizzavers applications, Commande commande){
        this.application = applications;
        this.Modele = commande;

        this.setBackground(Color.WHITE);
        this.setBorder(BorderFactory.createLineBorder(Color.red));

        ArrayList<Produit> LaCommande = Modele.getCommande();
        for (Produit Produit : LaCommande) {
            VueEtapeCommande Etape = new VueEtapeCommande(application, Produit);
            this.add(Etape);
        }
    }

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    // ***********************************
    // ******* METHODES ******************
    // ***********************************
}