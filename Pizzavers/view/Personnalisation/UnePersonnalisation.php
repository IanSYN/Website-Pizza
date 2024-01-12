<div class="conteneurProd">
    <div class="btnRetour">
        <?php
            echo "<a href='index.php?objet=Accueil&action=afficherOne&idProduit=$idProd' style='padding: 20px;'>Retour</a>"
        ?>
    </div>
    <div class="Separator">
        <div class="Prodimg">
            <img src="img/<?php echo $unProd->get('coverProduit'); ?>">
        </div>
        <div class="Prodinf">
            <?php
                echo "<form action='index.php?objet=personnalisation&action=ajouterPP&idProduit=$idProd' method='POST'>";
                $val = 0;
                foreach ($tabIngre as $ingre) {
                    echo "<div class='ingre'>";
                    //echo "<img src='img/ingredient/".$ingre->get('coverIngredient')."' />";
                    echo "<label for='ingre".$val."'>".$ingre->get('nomIngredient').": </label>
                    <input type='number' id='ingre".$val."' name='ingre".$val."' value='0' required>";
                    $val++;
                    echo "</div>";
                }
                echo "<br>";
                if (session::clientConnected()) {
                    echo "
                    <div>
                        <input type='submit' name='boutonCreer' value='Ajouter au panier' style='cursor: pointer;' />
                    </div>";
                }
                else {
                    echo "
                    <div class='seConnecter'>
                    <!-- <img src='img/icons8-personne-homme-64.png' /> -->
                    <a href='index.php?objet=connexion&action=afficherConnexion'>
                        <button type='submit'>Ajouter au panier</button>
                    </a>
                    </div>";
                }
            ?>
        </div>
    </div>
    </form>
</div>