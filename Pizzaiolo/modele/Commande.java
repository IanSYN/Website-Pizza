package Modele;

import java.time.LocalDateTime;
import java.util.ArrayList;

import Modele.Adresse;
import Modele.Produit;

public class Commande {
    // ***********************************
	// ******* ATTRIBUTS *****************
	// ***********************************

    private int IdCommande;
    private float PrixCommandeTotal;
    private float tempsRestant;
    private Adresse adresseArrivee;
    private ArrayList<Produit> laCommande;
    private boolean ready = false;
    //private ArrayList<Commande> commandePrete;
    private float ratio;
    private LocalDateTime dateCommande;
    private int numCommande;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public Commande(Adresse adresseArrivee, ArrayList<Produit> commande) {
        this.adresseArrivee = adresseArrivee;
        this.laCommande = commande;
        this.dateCommande = LocalDateTime.now();
    }

    //Constructeur test
    public Commande(){
        this.adresseArrivee = new Adresse(ratio, numCommande);
        this.laCommande = new ArrayList<Produit>();
        this.dateCommande = LocalDateTime.now();
    }


    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    public int getIdCommande(){
        return this.IdCommande;
    }

    public float getPrixCommandeTotal(){
        return this.PrixCommandeTotal;
    }

    // ***********************************
    // ******* METHODES ******************
    // ***********************************

    public String indexCommandeNom(int i){
        return this.laCommande.get(i).getNomProduit();
    }
}

