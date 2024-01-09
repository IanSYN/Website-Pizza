package Vues;
import javax.swing.*;

import Controlleur.ControlleurValidationCommande;
import Modele.*;

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
    private VueListPizza vueListPizza;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public VueDetailCommande(Pizzavers applications, Commande commande, VueListPizza vueListPizza) {
        this.application = applications;
        this.Modele = commande;
        this.vueListPizza = vueListPizza;

        this.setBackground(Color.WHITE);
        this.setBorder(BorderFactory.createLineBorder(Color.red));

        ArrayList<Produit> LaCommande = Modele.getCommande();
        for (Produit Produit : LaCommande) {
            VueEtapeCommande Etape = new VueEtapeCommande(application, Produit);
            this.add(Etape);
        }
        new ControlleurValidationCommande(applications, commande, this, vueListPizza);
        this.setLayout(new FlowLayout(FlowLayout.CENTER, 0, 0));
    }

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    public VueListPizza getApplication() {
        return vueListPizza;
    }

    // ***********************************
    // ******* METHODES ******************
    // ***********************************
}