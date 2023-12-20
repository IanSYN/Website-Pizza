package Controlleur;
import Modele.*;
import Vues.*;
import javax.swing.*;
import java.awt.*;
import java.awt.event.*;

public class ControlleurValidationCommande extends JPanel implements ActionListener{
    // ***********************************
    // ******** ATTRIBUTS ****************
    // ***********************************

    private Pizzavers application;
    private Commande modele;
    private VueDetailCommande vue;
    private VueListPizza fenetreUtilisateur;

    // ***********************************
    JButton valider = new JButton("Valider");
    static public final String ACTION_VALIDER = "VALIDER";

    // ***********************************
    // ******** CONSTRUCTEUR *************
    // ***********************************

    public ControlleurValidationCommande(Pizzavers application, Commande modele, VueDetailCommande vue, VueListPizza fenetreUtilisateur){
        this.application = application;
        this.modele = modele;
        this.vue = vue;
        this.fenetreUtilisateur = fenetreUtilisateur;

        valider.addActionListener(this);
        valider.setActionCommand(ACTION_VALIDER);
        vue.add(valider);
    }

    // ***********************************
    // ********** METHODES ***************
    // ***********************************

    public void actionPerformed(ActionEvent e){
        System.out.println("ça marche");
        // if(e.getActionCommand().equals(ACTION_VALIDER)){
        //     modele.setEtat("Valide");
        //     fenetreUtilisateur.setDroite(new VueDetailCommande(application, modele, fenetreUtilisateur));
        // }
    }
}
