package Modele;

public class Produit {
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    private int cpt = 1;
    private int IdProduit;
    private String NomProduit;
    private float PrixProduit;
    private String CoverProduit;
    private int idCategorie;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public Produit(){
        this.IdProduit = cpt;
        this.NomProduit = "test";
        this.PrixProduit = 1f;
        this.CoverProduit = null;
        this.idCategorie = 1;
        cpt++;
    }

    public Produit(String nom, float prix, String cover, int idCategorie){
        this.IdProduit = cpt;
        this.NomProduit = nom;
        this.PrixProduit = prix;
        this.CoverProduit = cover;
        this.idCategorie = idCategorie;
        cpt++;
    }

    public String getNomProduit() {
        return this.NomProduit;
    }
}