package Vues;
import javax.swing.*;
import java.util.*;
import Modele.Commande;
import Modele.Pizzavers;

import java.awt.*;
import inter.*;

public class VueListPizza extends JFrame {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private Pizzavers Application;
    private JPanel panelMilieu;
    private Commande modele;
    private ArrayList<Commande> listeCommande;

    //les 2 parties de l'interface
    private VuePetitListCommande gauche;
    private VueDetailCommande droite;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public VueListPizza(Pizzavers application, Commande modele, ArrayList<Commande> listeCommande) {
        this.Application = application;
        this.modele = modele;
        this.listeCommande = listeCommande;

        this.setBackground(Colors.redBG);

        setMinimumSize(new Dimension(800,600));
        setTitle("Application Pizza Commande");
		setDefaultCloseOperation(EXIT_ON_CLOSE);

        panelMilieu = new JPanel(new GridLayout(1, 2));
        gauche = new VuePetitListCommande(application, listeCommande, this);

        panelMilieu.add(gauche);
		this.getContentPane().add(panelMilieu);

        this.setVisible(true);

        reload();
    }

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    public Pizzavers getApplication() {
        return Application;
    }

    public void setApplication(Pizzavers application) {
        Application = application;
    }

    public JPanel getPanelMilieu() {
        return panelMilieu;
    }

    public void setPanelMilieu(JPanel panelMilieu) {
        this.panelMilieu = panelMilieu;
    }

    public Commande getModele() {
        return modele;
    }

    public void setModele(Commande modele) {
        this.modele = modele;
    }

    public ArrayList<Commande> getListeCommande() {
        return listeCommande;
    }

    public void setListeCommande(ArrayList<Commande> listeCommande) {
        this.listeCommande = listeCommande;
    }

    public VuePetitListCommande getGauche() {
        return gauche;
    }

    public void setGauche(VuePetitListCommande gauche) {
        this.gauche = gauche;
        this.add(gauche);
        reload();
    }

    public VueDetailCommande getDroite() {
        return droite;
    }

    public void setDroite(VueDetailCommande droite) {
        this.droite = droite;
        this.add(droite);
        reload();
    }

    // ***********************************
    // ******* METHODES ******************
    // ***********************************

    public void reload() {
        panelMilieu.removeAll();

        gauche = new VuePetitListCommande(Application, listeCommande, this);
        panelMilieu.add(gauche);
        panelMilieu.add(droite);

        pack();
		repaint();
		revalidate();
    }

}
