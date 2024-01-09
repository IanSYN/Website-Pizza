package Modele;

import java.time.Duration;
import java.time.LocalDateTime;
import java.util.ArrayList;

import Modele.Commande;

public class Livreur {
    private final static int MAXPLACE = 5;
    private final static double MAX_VALUE = 999999999999.9999;
    ArrayList<Commande> commandePrete = new ArrayList<Commande>();
    ArrayList<Commande> copyList = new ArrayList<Commande>();
    ArrayList<Commande> cargo = new ArrayList<Commande>(MAXPLACE);
    ArrayList<Commande> toRemove = new ArrayList<>();
    Commande adresseL1;

    // Constructeur

    //setter et getter
    public ArrayList<Commande> getCommandePrete() {
        return commandePrete;
    }

    public void setCommandePrete(ArrayList<Commande> commandeP) {
        this.commandePrete = commandeP;
    }

    public ArrayList<Commande> getCargo() {
        return cargo;
    }

    // Setter pour l'ArrayList cargo
    public void setCargo(ArrayList<Commande> cargo) {
        this.cargo = cargo;
    }

    public void setAdresseL1(Commande c) {
        this.adresseL1 = c;
    }

    //Méthodes
    public void addCommandePrete(Commande c){
        commandePrete.add(c);
    }

    public void rmvCommandePrete(int pos){
        commandePrete.remove(pos);
    }

    public void addCargo(Commande c){
        cargo.add(c);
    }

    public void removeCargo(int pos){
        cargo.remove(pos);
    }

    public void removeToRemove(ArrayList<Commande> c){
        for (Commande commande : c){
            for (Commande coToRemove : toRemove){
                if (commande.getNumCommande() == coToRemove.getNumCommande()) {
                    commandePrete.remove(commande);
                    toRemove.remove(coToRemove);
                }
            }   
        }
    }

    public void remplirCopyList(ArrayList<Commande> c){
        for (Commande commande : c){
            copyList.add(commande);
        }
    }

    public void commandeP(){
        
     //AffiremoveAll()ccargo
    }


    //**Note : Le livreur n'a pas le choix de sa livraison**/
    /*première commande = temps */
    /* 2 emes commande = ratio temps / distance par rapport a commande 1 */
    /* 3 emes commande = ratio temps / distance par rapport a commande 2 
     etc... */

    public Commande tempsMin(ArrayList<Commande> c) {
        if (c.isEmpty()) {
            return null; // Renvoyer null si la liste est vide
        }
    
        Commande minCommande = null; // Supposons que le premier élément a le temps restant minimum
    
        for (Commande commande : c) {
        // Ignorer les temps restants négatifs
        if (commande.getTempsRestant() >= 0) {
            if (minCommande == null || commande.getTempsRestant() < minCommande.getTempsRestant()) {
                minCommande = commande;
            }
        }
    }

        setAdresseL1(minCommande);
        return minCommande;
    }

    public Commande meilleurRatio(ArrayList<Commande> c) {
    if (c.isEmpty()) {
        return null; // Renvoyer null si la liste est vide
    }

    Commande meilleureCommande = c.get(0); // Supposons que le premier élément a le meilleur ratio
    Adresse adrMinArr = adresseL1.getAdresseArrivee(); // prenons l'adresse de la première commande du cargo
    Double meilleurRatio = Double.MAX_VALUE;

    // On prend la meilleure seconde adresse après la première déjà dans le cargo selon son ratio distance/temps
    if (cargo.size() == 1) {
        for (int i = 0; i < c.size(); i++) {
            if (c.get(i).calcRatio(c.get(i).getTempsRestant(), adrMinArr) < meilleurRatio) {
                meilleurRatio = c.get(i).calcRatio(c.get(i).getTempsRestant(), adrMinArr);
                meilleureCommande = c.get(i);
            }
        }
        return meilleureCommande;
    } else if (c.size() > 1) {
        for (int i = 1; i < c.size(); i++) {
            Adresse adCommandePrecedente = c.get(i - 1).getAdresseArrivee();
            if (c.get(i).calcRatio(c.get(i).getTempsRestant(), adCommandePrecedente) < meilleurRatio) {
                meilleurRatio = c.get(i).calcRatio(c.get(i).getTempsRestant(), adCommandePrecedente);
                meilleureCommande = c.get(i);
            }
        }
    }

    return meilleureCommande;
}


    //Une procédure qui prend en parametre une arrayList de commande définie comme prete a la livraison
    public void GloutonPos(ArrayList<Commande> c){
        //Algorithme glouton pour trouver la position optimale
        if (!commandePrete.isEmpty()){
                for (Commande commande : copyList) {
                    if(cargo.isEmpty()){
                        cargo.add(tempsMin(copyList));
                        toRemove.add(tempsMin(copyList));
                        copyList.remove(tempsMin(copyList));
                        GloutonPos(c);
                    }
                    else if(cargo.size()== MAXPLACE){
                        System.out.println(MAXPLACE +" commandes ont été ajoutées au cargo du livreur");
                        afficherCargo();
                        break;
                    }
                    else if(commande.getTempsRestant() >= 0){
                        cargo.add(meilleurRatio(copyList));
                        toRemove.add(meilleurRatio(copyList));
                        copyList.remove(meilleurRatio(copyList));
                        GloutonPos(c);
                    }
                    else if(commande.getTempsRestant() <= -12.00){
                        cargo.add(commande);
                        toRemove.add(commande);
                        copyList.remove(commande);
                        GloutonPos(c);
                    }else{
                        cargo.add(meilleurRatio(copyList));
                        toRemove.add(meilleurRatio(copyList));
                        copyList.remove(meilleurRatio(copyList));
                        GloutonPos(c);
                    }
                }
        }else{
            afficherLesCommandesPretes();
        }
                    
    }

    

    //a ameliorer (pour l'instant ça ajoute une commande dans le cargo des que le temps restant passe au negatif)
    /*private void GloutonNeg(ArrayList<Commande> c) {
        if (!commandePrete.isEmpty()){
                for (Commande commande : c) {
                    if(commande.getTempsRestant() <= -12.00){
                            cargo.add(commande);
                            commandePrete.remove(commande);
                            GloutonNeg(c);
                    }else if (commande.getTempsRestant() >= 0){
                        GloutonPos(c);
                    }else{
                        ignore(commande);
                    }
                }
        }else{
            afficherLesCommandesPretes();
        }
    }*/


    public void afficherLesCommandesPretes() {
        System.out.println("Detail de livraison pour chaques Commande prete a etre livrée :\n");
        System.out.println("------------------------");
        if (!commandePrete.isEmpty()){
            for (Commande commande : this.commandePrete) {
                System.out.println("COMMANDE TOUJOURS NON PRISE EN CHARGE");
                System.out.println("Numéro de commande : " + commande.getNumCommande());
                System.out.println("Temps restant : " + commande.getTempsRestant());
                System.out.println("L'adresse de livraison : " + commande.getAdresseArrivee().getAdresseArrivee());
                System.out.println("------------------------");
            }
        }else{
            System.out.println("Il n'y a aucune commande en attente de livraison ! \n");
        }
    }

    public void afficherCargo() {
        System.out.println("Detail de livraison pour chaques Commande dans le Cargo :\n");
        System.out.println("------------------------");
        if (!cargo.isEmpty()){
            for (Commande commande : this.cargo) {
                System.out.println("COMMANDE PRISE EN CHARGE");
                System.out.println("Numéro de commande : " + commande.getNumCommande());
                System.out.println("Temps restant : " + commande.getTempsRestant());
                System.out.println("L'adresse de livraison : " + commande.getAdresseArrivee().getAdresseArrivee());
                System.out.println("------------------------");
            }       
        }else{
            System.out.println("Le cargo de livraison est actuellement vide ! \n");
        }
        
    }

    

    
}