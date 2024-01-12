<div class="ContenerSuivie">
    <div class="listSuivie">
        <?php
            foreach ($commandes as $value) {
                echo "<div class='commande'>";
                echo "<p>Commande n°".$value->get('idCommande')."</p>";
                echo "<p>Date : ".$value->get('dateCommande')."</p>";
                echo "<p>Prix : ".$value->get('prixTotalCommande')."€</p>";
                $idEtat = $value->get('idEtatCommande');
                if ($idEtat == 2) {
                    echo "<p>Etat : En cuisine</p>";
                }
                else if ($idEtat == 3) {
                    echo "<p>Etat : En Attente de prise en charge</p>";
                }
                else if ($idEtat == 4) {
                    echo "<p>Etat : En cours de livraison</p>";
                }
                else if ($idEtat == 5) {
                    echo "<p>Etat : livrée</p>";
                }
                echo "</div>";
            }
        ?>
    </div>
</div>