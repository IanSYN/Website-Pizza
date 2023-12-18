package view;

import javax.swing.*;
import java.awt.*;
import modele.Commande;

public class VCuisine extends JPanel {

    // JPanel instantiation
    JPanel mainPan = new JPanel();
    JPanel hautPan = new JPanel();
    JPanel subPan = new JPanel();
    JPanel panComm = new PanelCommande();

    GridLayout globalGrid = new GridLayout(2, 1);

    // Label

	JLabel numComm = new JLabel(String.valueOf(commande.getIntCommande()));
    JLabel txtCommande = new JLabel("Commande en cours :");
	JLabel logo = new JLabel("logo.png");

    public VCuisine() {
        setLayout(new BorderLayout());
        mainPan.setLayout(globalGrid);

        // Add components to panels
		mainPan.add(hautPan);
        mainPan.add(subPan);

        hautPan.add(logo);
		subPan.add(panComm);

        add(mainPan, BorderLayout.CENTER);
		
    }
}