import javax.swing.*;

import Modele.Commande;
import Modele.Pizzavers;

import java.awt.*;

public class ListPizza extends JFrame {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private Pizzavers Application;
    private BarreMenu taskBar;
    private JPanel panel;
    private Commande modele;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public ListPizza(Pizzavers application, Commande modele) {
        this.Application = application;
        this.modele = modele;

        this.setBackground(Color.WHITE);

        setSize(1280, 720);
		setTitle("Application Pizza Commande");
		setDefaultCloseOperation(EXIT_ON_CLOSE);

        // Création du panel barre des tâches
        taskBar = new BarreMenu(this, application, modele);
		taskBar.setCouleurFond(modele.getCouleur());

        his.getContentPane().add(taskBar, BorderLayout.NORTH);

        panel = new JPanel(new GridLayout(1, 1));
		this.getContentPane().add(panel);

        reload();
    }

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    public ListPizza getApplication() {
        return Application;
    }

    // ***********************************
    // ******* METHODES ******************
    // ***********************************

    public void reload() {
        panel.removeAll();

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
