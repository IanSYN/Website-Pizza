package Vues;
import javax.swing.*;

import Modele.Commande;
import Modele.Pizzavers;
import Modele.Produit;

import java.awt.*;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;

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
    // ******* METHODES ******************
    // ***********************************

    public boolean Valide(){
        boolean selection = false;
        if (this.Valider.isSelected() || this.Manque.isSelected()) {
            selection = true;
        }
        return selection;
    }
}
