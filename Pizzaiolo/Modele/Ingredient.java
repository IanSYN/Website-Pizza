package Modele;

public class Ingredient {
    // Attributs
    private int idIngredient;
    private String nomIngredient;
    private int stockIngredient;
    private int prixIngredient;

    // Constructeur
    public Ingredient(int idIngredient, String nomIngredient, int stockIngredient, int prixIngredient) {
        this.idIngredient = idIngredient;
        this.nomIngredient = nomIngredient;
        this.stockIngredient = stockIngredient;
        this.prixIngredient = prixIngredient;
    }

    // Methodes
    public void setStockIngredient(int stockIngredient) {
        this.stockIngredient = stockIngredient;
    }

    public int getStockIngredient() {
        return stockIngredient;
    }

    public int getIdIngredient() {
        return idIngredient;
    }

    public String getNomIngredient() {
        return nomIngredient;
    }

    public int getPrixIngredient() {
        return prixIngredient;
    }

    public void setPrixIngredient(int prixIngredient) {
        this.prixIngredient = prixIngredient;
    }

    public void setNomIngredient(String nomIngredient) {
        this.nomIngredient = nomIngredient;
    }

    public void setIdIngredient(int idIngredient) {
        this.idIngredient = idIngredient;
    }

    public void setStockIngredient(Integer stockIngredient) {
        this.stockIngredient = stockIngredient;
    }

    public void setPrixIngredient(Integer prixIngredient) {
        this.prixIngredient = prixIngredient;
    }

}
