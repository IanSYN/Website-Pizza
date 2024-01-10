<div class="Panier">
    <div class="ContenerPanier">
        <div class="PanierProd">
            <h1>Produit</h1>
            <?php
                foreach ($value as $val) {
                    echo "<div class='row'>";
                    echo "<div><h2>".$val->get('coverProduit')."</h2></div>";
                    echo "<div><h2>".$val->get('nomProduit')."</h2></div>";
                    echo "<div><h2>".$val->get('quantiteProduit')."</h2></div>";
                    echo "<div class='bouton'>
                            <div class='ajouterIngr'>
                                <a href='index.php?objet=panier&action=up&idCommande=".$val->get('idCommande')."&idProduit=".$val->get('idProduit')."' style='text-decoration: none; color: black;'>
                                    <button class='ajouterIngr' type='button'> + </button>
                                </a>
                            </div>
                            <div class='diminuerIngr'>
                                <a href='index.php?objet=panier&action=down&idCommande=".$val->get('idCommande')."&idProduit=".$val->get('idProduit')."' style='text-decoration: none; color: black;'>
                                    <button class='diminuerIngr' type='button'> - </button>
                                </a>
                            </div>
                        </div>";
                    //echo "<img src='img/".$val->get('coverProduit').">";
                    echo "<div>
                    <a href='index.php?objet=panier&action=supprimerPanier&idCommande=".$val->get('idCommande')."&idProduit=".$val->get('idProduit')."'>
                        <button class='Supp' type='submit'>Supprimer</button>
                    </a>
                    </div>";
                    echo "</div>";
                }
            ?>  
        </div>
        <div class="Fond">
            <div class="ContenerResume">
                <h1>Résumé</h1>
                <br>
                <?php
                    foreach ($value as $val) {
                        echo "<label>".$val->get('nomProduit')." x".$val->get('quantiteProduit')."</labels>";
                    }
                    echo "<h2> Total: ".$val->get('prixTotalCommande')."</h2>";
                ?>
                <form action="index.php?objet=panier&action=pagePaiement" method="POST">
                <input class="Paye" type="submit" name="boutonPayer" value="Payer" style="cursor: pointer;" />
            </div>
        </div>
    </div>
</div>