package Vues;
import javax.swing.*;
import java.awt.*;
import java.util.*;

import Modele.Commande;
import Modele.Pizzavers;

public class VuePetitListCommande extends JPanel {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private Pizzavers application;
    //private ArrayList<ControlleurCommandeList> listCommande;
    VueCommandePetit vue;
    ArrayList<Commande> Modele;
    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public VuePetitListCommande(Pizzavers applications, ArrayList<Commande> commande){
        this.application = applications;
        this.Modele = commande;

        this.setBackground(Color.WHITE);
        this.setBorder(BorderFactory.createLineBorder(Color.black));

        vue = new VueCommandePetit(applications, commande);
        this.add(vue);  
    }
}
