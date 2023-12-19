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
    private ArrayList<Commande> Modele;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public VueDetailCommande(Pizzavers applications, ArrayList<Commande> commande){
        this.application = applications;
        this.Modele = commande;

        this.setBackground(Color.WHITE);
        this.setBorder(BorderFactory.createLineBorder(Color.red));

        ArrayList<Produit> LaCommande = Modele.get(0).getCommande();
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

    public void reload(){
        this.removeAll();

        this.setLayout(new BoxLayout(this, BoxLayout.Y_AXIS));

        //for (Commande commande : Modele) {
            
        //}

        this.revalidate();
        this.repaint();
    }

    public static void main(String[] args) {
        JFrame fenetre = new JFrame();
        fenetre.setSize(1280, 720);
        fenetre.setTitle("Application Pizza Commande");
        fenetre.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        fenetre.setVisible(true);
        ArrayList<Commande> listeCommande = new ArrayList<Commande>();
        Commande commande1 = new Commande(1, new Adresse("13 Avenue des sciences Gif sur yvette",48.711734, 2.1705202),15.00, new ArrayList<>());
        listeCommande.add(commande1);
        VueDetailCommande v1 = new VueDetailCommande(new Pizzavers(), listeCommande);
        fenetre.add(v1);
    }
}