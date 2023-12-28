package Modele;

public class PizzaPersonnalisee extends Produit{
    private int idProduit;
    private int idPizza;
    private int idIngredient;
    private int quantitePizza;
    private int quantiteIngredient;

    public PizzaPersonnalisee(int idProduit, int idPizza, int idIngredient, int quantitePizza, int quantiteIngredient) {
        super(idProduit, idPizza, idIngredient, quantitePizza, quantiteIngredient );
    }

    public int getIdProduit() {
        return idProduit;
    }

    public int getIdIngredient() {
        return idIngredient;
    }

    public String getNomProduit() {
        return Pizzavers.listePizzas.get(idIngredient).getNomPizza();
    }
}
