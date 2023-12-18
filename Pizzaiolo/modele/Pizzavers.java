package Modele;

public class Pizzavers {
    public static void main(String[] args) {

        // Création du launcher de l'application
        public void lancerApplication(){
            //lancer la page d'accueil
            new ListPizza(this, new Commande());
        }

        public static void main(String[] args) {
		try {

			Pizzavers application = new PizzaPizzavers();

			application.lancerApplication();

		} catch (Exception e) {
			System.out.println(e);
		}
	}
}
