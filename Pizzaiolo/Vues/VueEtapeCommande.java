package Vues;
import javax.swing.*;

import Modele.Commande;
import Modele.Pizzavers;
import Modele.Produit;

import java.awt.*;

public class VueEtapeCommande extends JPanel{
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private Pizzavers application;
    private Produit Modele;

    //Attribut graphique
    private JLabel titre;
    private JCheckBox Valider;
    private JCheckBox Manque;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public VueEtapeCommande(Pizzavers applications, Produit produit){
        this.application = applications;
        this.Modele = produit;

        this.setBackground(Color.WHITE);
        this.setBorder(BorderFactory.createLineBorder(Color.blue));
        //this.setLayout(new BoxLayout(this, BoxLayout.Y_AXIS));

        //Titre
        this.titre = new JLabel(this.Modele.getNomProduit());
        this.titre.setAlignmentX(Component.LEFT_ALIGNMENT);
        this.Valider = new JCheckBox("Valider");
        this.Manque = new JCheckBox("Manque");
        Valider.setAlignmentX(Component.RIGHT_ALIGNMENT);
        Manque.setAlignmentX(Component.RIGHT_ALIGNMENT);

        //ajout des composants
        this.add(titre);
        this.add(Valider);
        this.add(Manque);
    }

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    // ***********************************
    // ******* METHODES ******************
    // ***********************************

    public static void main(String[] args) {
        JFrame fenetre = new JFrame();
        fenetre.setSize(1280, 720);
        fenetre.setTitle("Application Pizza Commande");
        fenetre.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        fenetre.setVisible(true);
        Produit p1 = new Produit();
        System.out.println(p1.getNomProduit());
        VueEtapeCommande a1 = new VueEtapeCommande(new Pizzavers(), p1);
        fenetre.add(a1);
    }
}
