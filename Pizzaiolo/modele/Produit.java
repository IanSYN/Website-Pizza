package Modele;

public class Produit {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    //private static int cpt = 1; // Pour identifier les produits

    private int IdProduit;
    private String NomProduit;
    private float PrixProduit;
    private String CoverProduit;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    // Constructeur test
    public Produit(){
        this.IdProduit = 1;
        this.NomProduit = "test";
        this.PrixProduit = 1f;
    }

    public Produit(int IdProduit, String nom, float prix){
        this.IdProduit = IdProduit;
        this.NomProduit = nom;
        this.PrixProduit = prix;
    }

    public String getNomProduit() {
        return this.NomProduit;
    }

    public float getPrixProduit() {
        return this.PrixProduit;
    }
}