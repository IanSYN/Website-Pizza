package Vues;

import Modele.*;
import Vues.*;
import javax.swing.*;
import java.awt.*;
import java.awt.event.*;

public class VueAffichagePetitCommande extends JPanel{
    // ***********************************
	// ******** ATTRIBUTS ****************
	// ***********************************

    private Commande modele;
    private Pizzavers application;

    //attribut graphique
    private JLabel numCommande = new JLabel();
    private JLabel prixCommandeTotal = new JLabel();
    private JLabel tempsRestant = new JLabel();
    private JLabel nbProduit = new JLabel();

    // ***********************************
	// ******** CONSTRUCTEUR *************
	// ***********************************

    public VueAffichagePetitCommande(Pizzavers Applications, Commande co){
        this.application = Applications;

        numCommande.setText(Integer.toString(co.getIdCommande()));
        prixCommandeTotal.setText(Integer.toString(co.getIdCommande()));
        tempsRestant.setText(Integer.toString(co.getIdCommande()));
        nbProduit.setText(Integer.toString(co.getIdCommande()));

        this.setBorder(BorderFactory.createLineBorder(Color.red));

    }

    // ***********************************
	// ********** METHODES ***************
	// ***********************************
}
