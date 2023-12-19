package Modele;

public class Produit {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private static int cpt = 1; // Pour identifier les produits

    private int IdProduit;
    private String NomProduit;
    private float PrixProduit;
    private String CoverProduit;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    // Constructeur test
    public Produit(){
        this.IdProduit = cpt;
        this.NomProduit = "test";
        this.PrixProduit = 1f;
        this.CoverProduit = null;
        cpt++;
    }

    public Produit(String nom, float prix, String cover){
        this.IdProduit = cpt;
        this.NomProduit = nom;
        this.PrixProduit = prix;
        this.CoverProduit = cover;
        cpt++;
    }

    public String getNomProduit() {
        return this.NomProduit;
    }
}