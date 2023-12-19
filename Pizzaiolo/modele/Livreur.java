package modele;

import java.time.Duration;
import java.time.LocalDateTime;
import java.util.ArrayList;
import modele.Commande;

public class Livreur {
    private final static int MAXPLACE = 5;
    ArrayList<Commande>cargo = new ArrayList<Commande>(MAXPLACE);

    // Constructeur

    //setter et getter

    public ArrayList<Commande> getCargo() {
        return cargo;
    }

    // Setter pour l'ArrayList cargo
    public void setCargo(ArrayList<Commande> cargo) {
        this.cargo = cargo;
    }


    //Méthodes
    public void addCargo(Commande c){
        cargo.add(c);
    }

    public void removeCargo(int pos){
        cargo.remove(pos);
    }

    public void TrajTotal(){
        //Affiche la distance entre les deux adresses
    }

    //**Note : Le livreur n'a pas le choix de sa livraison**/
    /*première commande = temps */
    /* 2 emes commande = ratio temps / distance par rapport a commande 1 */
    /* repeat until 5 commandes */

    public Commande tempsMin(ArrayList<Commande> c) {
        if (c.isEmpty()) {
            return null; // Renvoyer null si la liste est vide
        }
    
        Commande minCommande = c.get(0); // Supposons que le premier élément a le temps restant minimum
    
        for (Commande commande : c) {
            if (commande.getTempsRestant() < minCommande.getTempsRestant()) {
                minCommande = commande;
            }
        }
    
        return minCommande;
    }

    public Commande meilleurRatio(ArrayList<Commande> c) {
        if (c.isEmpty()) {
            return null; // Renvoyer null si la liste est vide
        }
    
        Commande meilleureCommande = c.get(1); // Supposons que le premier élément a le meilleur ratio
        //Adresse adDepart = new Adresse("Boutique IUT d'Orsay",lat,long); // Adresse de départ pour la première commande

    
        for (int i = 1; i < c.size(); i++) {
            Commande commande = c.get(i);
            Adresse adDepartCommandePrecedente = c.get(i - 1).getAdresseArrivee();
            commande.calcRatio(commande.getTempsRestant(), adDepartCommandePrecedente);

            if (commande.getRatio() > meilleureCommande.getRatio()) {
                meilleureCommande = commande;
            }
        }
    
        return meilleureCommande;
    }

    public void DynamicPos(ArrayList<Commande> c){
        //Algorithme glouton pour trouver la position optimale
        while(!cargo.isEmpty()){
            for (Commande commande : c) {
                if(commande.getTempsRestant() <= 0){
                    DynamicNeg(c);
                }
                else if(cargo.isEmpty()){
                    cargo.add(tempsMin(c));
                    DynamicPos(c);
                }
                else{
                    cargo.add(meilleurRatio(c));
                }
            }
        }
    }

    //a ameliorer (pour l'instant ça ajoute une commande dans le cargo des que le temps restant passe au negatif)
    private void DynamicNeg(ArrayList<Commande> c) {
         while(!cargo.isEmpty()){
            for (Commande commande : c) {
                if(commande.getTempsRestant() <= 0){
                    if(commande.getTempsRestant() <= -15.00){
                        c.add(commande);
                        DynamicNeg(c);
                    }
                }else{
                    DynamicPos(c);
                }
            }
        }

    }

    public void afficherCargo(ArrayList<Commande> c) {
        System.out.println("Detail de livraison pour chaques Commande dans le Cargo :");
        
        for (Commande commande : c) {
            System.out.println("Numéro de commande : " + commande.getNumCommande());
            System.out.println("Temps restant : " + commande.getTempsRestant());
            System.out.println("L'adresse de livraison : " + commande.getAdresseArrivee());
            System.out.println("------------------------");
        }
    }

    

    
}