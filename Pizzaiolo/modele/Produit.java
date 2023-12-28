package modele;

public class Produit{
    // ***********************************
    // ******* ATTRIBUTS *****************
    // ***********************************

    //private static int cpt = 1; // Pour identifier les produits

    private int IdProduit;
    private String NomProduit;
    //private float PrixProduit;

    //pour pizza personnalisee
    private int idPizza;
    private int idIngredient;
    private int quantitePizza;
    private int quantiteIngredient;

    //pour pizza
    private String nomTaille;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    // Constructeur test
    // public Produit(){
    //     this.IdProduit = 1;
    //     this.NomProduit = "test";
    //     this.PrixProduit = 1f;
    // }

    // Constructeur
    public Produit(int IdProduit,  int idPizza, int idIngredient, int quantitePizza, int quantiteIngredient){
        this.IdProduit = IdProduit;
        this.idPizza = idPizza;
        this.idIngredient = idIngredient;
        this.quantitePizza = quantitePizza;
        this.quantiteIngredient = quantiteIngredient;
    }

    public Produit(int IdProduit, String nom){
        this.IdProduit = IdProduit;
        this.NomProduit = nom;
    }

    public Produit(int idPizza){
        this.idPizza = idPizza;
    }

    public String getNomProduit() {
        return this.NomProduit;
    }

    public int getIdProduit() {
        return this.IdProduit;
    }
}