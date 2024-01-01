package Vues;
import javax.swing.*;

import Modele.Commande;
import Modele.Pizzavers;

import java.awt.*;
import java.util.*;

public class VuePetitListCommande extends JPanel {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private Pizzavers application;
    //private ArrayList<ControlleurCommandeList> listCommande;
    private VueAffichagePetitCommande vue;
    private ArrayList<Commande> Modele;
    private VueListPizza fenetreUtilisateur;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public VuePetitListCommande(Pizzavers applications, ArrayList<Commande> commande, VueListPizza vueListPizza){
        this.application = applications;
        this.Modele = commande;
        this.fenetreUtilisateur = vueListPizza;

        this.setBackground(Color.WHITE);
        this.setBorder(BorderFactory.createLineBorder(Color.black));

        for (Commande commande2 : Modele) {
            vue = new VueAffichagePetitCommande(application, commande2, fenetreUtilisateur);
            this.add(vue);
        }
    }

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    public void addElement(JPanel element){
        vue.add(element);
    }
}
