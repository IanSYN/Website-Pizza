package Vues;
import javax.swing.*;
import java.awt.*;
import java.util.*;

import modele.Commande;
import modele.Pizzavers;

public class VueCommandePetit extends JPanel {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private Pizzavers application;
    private ArrayList<Commande> listCommande;

    //attrbut graphique
    JButton bouton;
    JLabel numCommande;
    JLabel tempsRestant;
    JLabel nbProduit;
    JLabel PrixCommande;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public VueCommandePetit(Pizzavers applications, ArrayList<Commande> commande){
        this.application = applications;
        this.listCommande = commande;

        this.setBackground(Color.WHITE);
        this.setBorder(BorderFactory.createLineBorder(Color.black));

        this.bouton = new JButton("Afficher");
        this.numCommande = new JLabel("Commande n°" + listCommande.get(0).getNumCommande());
        this.tempsRestant = new JLabel("Temps restant : " + listCommande.get(0).getTempsRestant());
        this.nbProduit = new JLabel("Nombre de produit : " + listCommande.get(0).getCommande().size());
        this.PrixCommande = new JLabel("Prix de la commande : " + listCommande.get(0).getPrixCommande());

        this.add(numCommande);
        this.add(tempsRestant);
        this.add(nbProduit);
        this.add(PrixCommande);
        this.add(bouton);

        this.setLayout(new BoxLayout(this, BoxLayout.Y_AXIS));
    }

}
