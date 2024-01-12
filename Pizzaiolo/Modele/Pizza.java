package Modele;

public class Pizza extends Produit{
    // ***********************************
	// ******* ATTRIBUTS *****************
	// ***********************************

    private int idPizza;
    private String nomPizza;
    private String nomTaille;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public Pizza(int idPizza, String nomPizza, String nomTaille) {
        super(idPizza);
        this.nomPizza = nomPizza;
        this.nomTaille = nomTaille;
    }

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    public int getIdPizza() {
        return idPizza;
    }

    public String getNomPizza() {
        return nomPizza + " " + nomTaille;
    }

    public String getNomPizza(int idPizza) {
        return nomPizza;
    }

    public String getTaille() {
        return nomTaille;
    }

    public void setIdPizza(int idPizza) {
        this.idPizza = idPizza;
    }

    public void setNomPizza(String nomPizza) {
        this.nomPizza = nomPizza;
    }

    public void setTaille(String taille) {
        this.nomTaille = taille;
    }

    // ***********************************
    // ******* METHODES ******************
    // ***********************************
}
