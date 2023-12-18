package Modele;

import Modele.Commande;
import Vues.VueListPizza;

public class Pizzavers {

    // Création du launcher de l'application
        public void lancerApplication(){
            //lancer la page d'accueil
            new VueListPizza(this, new Commande());
        }
    public static void main(String[] args) {
        try {

                Pizzavers application = new Pizzavers();

                application.lancerApplication();

            } catch (Exception e)   {
                System.out.println(e);
            }
	}
}
