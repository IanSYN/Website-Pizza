package Vues;
import javax.swing.*;
import java.awt.*;
import java.util.ArrayList;

import Modele.Commande;
import Modele.Pizzavers;

public class VuePetitListCommande extends JPanel {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private Pizzavers application;
    //private ArrayList<ControlleurCommandeList> listCommande;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public VuePetitListCommande(Pizzavers applications){
        this.application = applications;

        this.setBackground(Color.WHITE);

        this.setBorder(BorderFactory.createLineBorder(Color.black));
    }
}
