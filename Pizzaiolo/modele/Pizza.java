package modele;

public class Pizza {
    // ***********************************
	// ******* ATTRIBUTS *****************
	// ***********************************

    private int idPizza;
    private String nomPizza;
    private String taille;

    // ***********************************
    // ******* CONSTRUCTEURS *************
    // ***********************************

    public Pizza(int idPizza, String nomPizza, String taille) {
        this.idPizza = idPizza;
        this.nomPizza = nomPizza;
        this.taille = taille;
    }

    // ***********************************
    // ******* GETTERS ET SETTERS ********
    // ***********************************

    public int getIdPizza() {
        return idPizza;
    }

    public String getNomPizza() {
        return nomPizza;
    }

    public String getTaille() {
        return taille;
    }

    public void setIdPizza(int idPizza) {
        this.idPizza = idPizza;
    }

    public void setNomPizza(String nomPizza) {
        this.nomPizza = nomPizza;
    }

    public void setTaille(String taille) {
        this.taille = taille;
    }

    // ***********************************
    // ******* METHODES ******************
    // ***********************************
}
