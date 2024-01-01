package Controlleur;

import Vues.*;

import javax.swing.*;

import Modele.*;

import java.awt.*;
import java.awt.event.*;

public class ControlleurAffichageCommande extends JPanel implements ActionListener{
    // ***********************************
	// ******** ATTRIBUTS ****************
	// ***********************************

	private Pizzavers application;
	private Commande modele;
	private VueAffichagePetitCommande vue;
	private VueListPizza fenetreUtilisateur;

	// ***********************************
	JButton afficher = new JButton("Afficher");



	// ***********************************

	static public final String ACTION_AFFICHER = "AFFICHER";

    // ***********************************
	// ******** CONSTRUCTEUR *************
	// ***********************************

	public ControlleurAffichageCommande(Pizzavers application, Commande modele, VueAffichagePetitCommande vue, VueListPizza fenetreUtilisateur){
		this.application = application;
		this.modele = modele;
		this.vue = vue;
		this.fenetreUtilisateur = fenetreUtilisateur;

		afficher.addActionListener(this);
		afficher.setActionCommand(ACTION_AFFICHER);
		vue.add(afficher);
	}

    // ***********************************
	// ********** METHODES ***************
	// ***********************************

	public void actionPerformed(ActionEvent e){
		if(e.getActionCommand().equals(ACTION_AFFICHER)){
			fenetreUtilisateur.setDroite(new VueDetailCommande(application, modele, fenetreUtilisateur));
		}
	}
}
