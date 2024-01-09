package Controlleur;
import Vues.*;
import Config.*;
import javax.swing.*;
import Modele.*;
import java.awt.*;
import java.awt.event.*;

public class ControlleurActualiser extends JPanel implements ActionListener{
    // ***********************************
    // ******** ATTRIBUTS ****************
    // ***********************************

    private Pizzavers application;
    private VuePetitListCommande vue;

    // ***********************************
    JButton valider = new JButton("Actualiser");
    static public final String ACTION_ACTUALISER = "ACTUALISER";

    // ***********************************
    // ******** CONSTRUCTEUR *************
    // ***********************************

    public ControlleurActualiser(Pizzavers application, VuePetitListCommande vue){
        this.application = application;

        this.vue = vue;

        valider.addActionListener(this);
        valider.setActionCommand(ACTION_ACTUALISER);
        vue.add(valider);
    }

    // ***********************************
    // ********** METHODES ***************
    // ***********************************

    public void actionPerformed(ActionEvent e){
        vue.getApplication().reloadCommande();
    }
}
