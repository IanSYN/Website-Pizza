package Vues;

import javax.print.attribute.standard.JobHoldUntil;
import javax.swing.*;
import Controlleur.*;
import Modele.*;

import java.awt.*;
import java.util.*;
import java.util.Timer;


public class VueAffichagePetitCommande extends JPanel{
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private Pizzavers application;
    private Commande Modele;
    private VueListPizza fenetreUtilisateur;

    // attribut graphique
    JLabel numCommande;
    JLabel tempsRestant;
    JLabel prixTotal;
    JLabel nbProduit;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public VueAffichagePetitCommande(Pizzavers applications, Commande commande, VueListPizza vueListPizza){
        this.application = applications;
        this.Modele = commande;
        this.fenetreUtilisateur = vueListPizza;

        this.setBackground(Color.WHITE);
        this.setBorder(BorderFactory.createLineBorder(Color.red));

        this.setLayout(new BoxLayout(this, BoxLayout.Y_AXIS));
        this.numCommande = new JLabel("Commande n°" + Modele.getNumCommande());
        this.tempsRestant = new JLabel("Temps restant : " + Modele.getTempsRestant());
        this.prixTotal = new JLabel("Prix total : " + Modele.getPrixCommande());
        this.nbProduit = new JLabel("Nombre de produit : " + Modele.getCommande().size());

        this.add(numCommande);
        this.add(tempsRestant);
        this.add(prixTotal);
        this.add(nbProduit);
        startTimer();

        new ControlleurAffichageCommande(application, Modele, this, fenetreUtilisateur);
    }

    public void startTimer() {
        Timer timer = new Timer();
        timer.schedule(new TimerTask() {
            public void run() {
                System.out.println(Modele.getTempsRestant());
                if (Modele.getTempsRestant() == 0) {
                    System.out.println("génération du code promo");
                    Modele.codePromo();
                    tempsRestant.setForeground(Color.RED);
                    setBackground(Color.WHITE);
                }
                Modele.MoinsTempsRestant();
                tempsRestant.setText("Temps restant (min): " + Modele.getTempsRestant());
            }
        }, 0, 10000); // Change the delay to 1000 milliseconds (1 second) and set the initial delay to 0
    }
}


// ///exemple de code

// //couleur timer rouge
// tempsRestant.setForeground(Color.RED);

// //function génération code promo
// public void genererCodePromo(){
//     //génération du code promo aleatoire et insert to base de donnée
// }