package Vues;
import javax.swing.*;

import Modele.Commande;
import Modele.Pizzavers;

import java.util.*;
import java.util.Timer;

import Modele.*;
import java.awt.*;
import inter.*;

public class VueListPizza extends JFrame {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private Pizzavers Application;
    private JPanel panelMilieu;
    private ArrayList<Commande> listeCommande;

    private static int compteur = 0;

    //les 2 parties de l'interface
    private VuePetitListCommande gauche;
    private VueDetailCommande droite;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public VueListPizza(Pizzavers application, ArrayList<Commande> listeCommande) {
        this.Application = application;
        this.listeCommande = listeCommande;

        this.setBackground(Colors.redBG);

        setMinimumSize(new Dimension(800,600));
        //setResizable(false);
        setTitle("Application Pizza Commande");
		setDefaultCloseOperation(EXIT_ON_CLOSE);

        panelMilieu = new JPanel(new GridLayout(1, 2));
        gauche = new VuePetitListCommande(application, listeCommande, this);

        panelMilieu.add(gauche);
		this.getContentPane().add(panelMilieu);

        this.setVisible(true);

        startTimer();
        reload();
        //System.out.println("fin");
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

    public void startTimer() {
        Timer timer = new Timer();
        timer.schedule(new TimerTask() {
            public void run() {
                compteur++;
                System.out.println(compteur);
                if (compteur == 10) {
                    compteur = 0;
                    reloadCommande();
                }
            }
        }, 0, 1000); // Change the delay to 1000 milliseconds (1 second) and set the initial delay to 0
    }

    public void reload() {
        panelMilieu.removeAll();
        gauche = new VuePetitListCommande(Application, listeCommande, this);
        panelMilieu.add(gauche);
        if (droite != null) {
            panelMilieu.add(droite);
        }
        pack();
		repaint();
		revalidate();
    }

    public void reloadCommande() {
        listeCommande = Application.reload();
        // for (Commande commande : newlisteCommande) {
        //     if (!listeCommande.contains(commande)) {
        //         listeCommande.add(commande);
        //     }
        // }
        // for (Commande commande2 : listeCommande) {
        //         if (!newlisteCommande.contains(commande2)) {
        //             listeCommande.remove(commande2);
        //         }
        // }
        reload();
    }

    public void test() {
        System.out.println("test");
    }

}
