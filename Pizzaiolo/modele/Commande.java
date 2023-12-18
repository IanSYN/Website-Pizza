package modele;

import java.time.Duration;
import java.time.LocalDateTime;
import java.util.ArrayList;

public class Commande {
    float tempsRestant;
    Adresse adresseArrivee;
    ArrayList<Produit>commande;
    boolean ready = false;
    ArrayList<Commande> commandePrete;
    float ratio;
    LocalDateTime dateCommande;
    int numCommande;

    //Constructeur 
    //methode
    public Commande calcRatio(int tempsRestant, Adresse ad1) {
        //float distance;
        Adresse ad2 = adresseArrivee;
        this.ratio = tempsRestant / calcDistance(ad1, ad2);
        return null;
    }

    public int getIntCommande(){
        return numCommande;
    }

    public Duration calcDureeRestante(LocalDateTime dateCom, LocalDateTime sysDate) {
        sysDate = LocalDateTime.now();
        return Duration.between(dateCom, sysDate);
    }

    public LocalDateTime dateHeureFinal(LocalDateTime dateCom, LocalDateTime sysDate) {
        sysDate = LocalDateTime.now();
        return LocalDateTime.now().minus(calcDureeRestante(dateCom, sysDate));
    }

    public void prete() {
        this.ready = true;
    }

    public float calcDistance(Adresse AdresseArrivee, Adresse AdresseDepart){
        //calculer la distance entre les deux adresses
        return 0;
    }
}
