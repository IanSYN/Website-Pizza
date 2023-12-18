package modele;

import java.time.Duration;
import java.time.LocalDateTime;
import java.util.ArrayList;

public class Livreur {
    private final static int MAXPLACE = 5;
    ArrayList<Commande>cargo = new ArrayList<Commande>(MAXPLACE);

    // Constructeur

    //setter et getter

    //Méthodes

    public void addCargo(Commande c){
        //Ajoute une commande dans l'arraylist
    }

    public void removeCargo(int c){
        //Supprime une commande dans l'arraylist
    }

    public void afficherCargo(){
        //Affiche les commandes dans l'arraylist
    }

    

    public void TrajTotal(){
        //Affiche la distance entre les deux adresses
    }

    //**Note : Le livreur n'a pas le choix de sa livraison**/
    /*première commande = temps */
    /* 2 emes commande = ratio temps / distance par rapport a commande 1 */
    /* repeat until 5 commandes */

    public Commande tempsMin() {
        return null;
    }

    public void DynamicPos(ArrayList<Commande> c){
        //Algorithme glouton pour trouver la position optimale
        while(!cargo.isEmpty()){
            for (Commande commande : c) {
                if(commande.tempsRestant <= 0){
                    DynamicNeg(c);
                }
                else if(cargo.isEmpty()){
                    cargo.add(tempsMin());
                    DynamicPos(c);
                }
                else{
                    //cargo.Add()
                }
            }

        }
    }

    private void DynamicNeg(ArrayList<Commande> c) {

    }
}