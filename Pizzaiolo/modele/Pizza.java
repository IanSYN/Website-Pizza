package Modele;

public class Pizza {
    // ***********************************
	// ******* ATTRIBUTS *****************
	// ***********************************

    private int IdPizza;
    private int IdProduit;
    private int IdTaille;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public Pizza(int idPizza, int idProduit, int idTaille) {
        this.IdPizza = idPizza;
        this.IdProduit = idProduit;
        this.IdTaille = idTaille;
    }

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    public int getIdPizza() {
        return IdPizza;
    }

    public void setIdPizza(int idPizza) {
        this.IdPizza = idPizza;
    }

    public int getIdProduit() {
        return IdProduit;
    }

    public void setIdProduit(int idProduit) {
        this.IdProduit = idProduit;
    }

    public int getIdTaille() {
        return IdTaille;
    }

    public void setIdTaille(int idTaille) {
        this.IdTaille = idTaille;
    }

    // ***********************************
    // ******* METHODES ******************
    // ***********************************
}
