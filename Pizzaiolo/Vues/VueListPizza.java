package Vues;
import javax.swing.*;
import java.util.*;
import Modele.Commande;
import Modele.Pizzavers;

import java.awt.*;

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

        this.setBackground(Color.WHITE);

        setSize(1280, 720);
		setTitle("Application Pizza Commande");
		setDefaultCloseOperation(EXIT_ON_CLOSE);

        panelMilieu = new JPanel(new GridLayout(1, 2));
        gauche = new VuePetitListCommande(application, listeCommande);
        droite = new VueDetailCommande(application, listeCommande);

        panelMilieu.add(gauche);
        panelMilieu.add(droite);
		this.getContentPane().add(panelMilieu);

        this.setVisible(true);

        //reload();
    }

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    public Pizzavers getApplication() {
        return Application;
    }

    // ***********************************
    // ******* METHODES ******************
    // ***********************************

    public void reload() {
        panelMilieu.removeAll();

		// for (Commande com : modele.getContenuTableau()) {
		// 	// Création de la vue associée à la liste courante
		// 	// la création du controleur associé à la vue courante est gérée par le
		// 	// constructeur de ConteneurListe.
		// 	ConteneurListe conteneurListe = new ConteneurListe(liste, this, application);
		// 	panelCentral.add(conteneurListe);
		// }

		// // On recrée le bouton pour ajouter une nouvelle liste.
		// panelCentral.add(new ControleurAjouterListe(modele, new AjouterListe(application), this, application));

		repaint();
		revalidate();
    }

}
