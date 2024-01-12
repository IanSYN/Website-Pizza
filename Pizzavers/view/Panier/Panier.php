<div class="Panier">
    <div class="ContenerPanier">
        <div class="PanierProd">
            <h1>Produit</h1>
            <?php
                $prixPP = 7;
                $prixTotal = 0;
                $nbPP = 0;
                if (!empty($PizValue)) {
                    $idPP = $PizValue[0]->get('idPizzaPersonnalisee');
                    $listIngre = array();
                    $QIngre = array();
                    $prix = array();
                    for ($i = 0; $i < count($PizValue); $i++) {
                        if($PizValue[$i]->get('idPizzaPersonnalisee') == $idPP && $i != count($PizValue)-1){
                            array_push($listIngre, $PizValue[$i]->get('nomIngredient'));
                            array_push($QIngre, $PizValue[$i]->get('quantiteSupplement'));
                            array_push($prix, $PizValue[$i]->get('prixIngredient'));
                        }
                        else{
                            $nbPP++;
                            echo "<div class='rowPP'>";
                            echo "<h1>PizzaPersonnalisée</h1>";
                            echo "<div>";
                            for($j = 0; $j < count($listIngre); $j++){
                                $prixPP += $QIngre[$j]*$prix[$j];
                                echo "<h2>".$listIngre[$j]." x".$QIngre[$j]." - ".$QIngre[$j]*$prix[$j]."€</h2>";
                            }
                            echo "</div>";
                            echo"
                            <a href='index.php?objet=panier&action=supprimerPP&idPP=".$idPP."'>
                                <button class='Supp' type='submit'>Supprimer</button>
                            </a>
                            </div>";
                            $idPP = $PizValue[$i]->get('idPizzaPersonnalisee');
                            reset($listIngre);
                            reset($QIngre);
                            array_push($listIngre, $PizValue[$i]->get('idPizzaPersonnalisee'));
                            array_push($QIngre, $PizValue[$i]->get('quantiteSupplement'));
                        }
                    }
                }
                if (!empty($value)) {
                    foreach ($value as $val) {
                        echo "<div class='row'>";
                        echo "<div><img src='img/".$val->get('coverProduit')."'></div>";
                        echo "<div><h2>".$val->get('nomProduit')."</h2></div>";
                        echo "<div><h2>".$val->get('quantiteProduit')."</h2></div>";
                        echo "<div class='bouton'>
                                <div class='ajouterIngr'>
                                    <a href='index.php?objet=panier&action=up&idCommande=".$val->get('idCommande')."&idProduit=".$val->get('idProduit')."' style='text-decoration: none; color: black;'>
                                        <button class='ajouterIngr' type='button'> + </button>
                                    </a>
                                </div>
                                <div class='diminuerIngr'>";
                                    if ($val->get('quantiteProduit') > 1) {
                                        echo "<a href='index.php?objet=panier&action=down&idCommande=".$val->get('idCommande')."&idProduit=".$val->get('idProduit')."' style='text-decoration: none; color: black;'>
                                            <button class='diminuerIngr' type='button'> - </button>
                                            </a>";
                                    }
                                    else {
                                        echo "<button class='diminuerIngr' type='button' disabled> - </button>";
                                    }
                        echo "</div>
                            </div>";
                        echo "<div>
                        <a href='index.php?objet=panier&action=supprimerPanier&idCommande=".$val->get('idCommande')."&idProduit=".$val->get('idProduit')."'>
                            <button class='Supp' type='submit'>Supprimer</button>
                        </a>
                        </div>";
                        echo "</div>";
                    }
                }
                if (empty($value) && empty($PizValue)) {
                    echo "<h2>Votre panier est vide</h2>";
                }
                echo "</div>
                <div class='Fond'>
                    <div class='ContenerResume'>
                        <h1>Résumé</h1>
                        <br>";
                    if (!empty($value) || !empty($PizValue)) {
                        $prixTotal = 0;
                        if(!empty($PizValue)){
                            for ($i = 0; $i < $nbPP; $i++) {
                                echo "<label>Pizza Personnalisée x1</labels>";
                            }
                        }
                        if(!empty($value)){
                            foreach ($value as $val) {
                                echo "<label>".$val->get('nomProduit')." x".$val->get('quantiteProduit')."</labels>";
                                foreach ($prod as $val2) {
                                    if ($val->get('idProduit') == $val2->get('idProduit')) {
                                        $prixTotal += $val2->get('prixProduit') * $val->get('quantiteProduit');
                                    }
                                }
                                $prixTotal += $prixPP;
                            }
                        }

                        echo "<h2> Total: ".$prixTotal."</h2>";
                    }
                echo "<form action='index.php?objet=panier&action=pagePaiement&idClient=$id&prixTotal=$prixTotal&idCommande=$idPan' method='POST'>
                      <input class='Paye' type='submit' name='boutonPayer' value='Payer' style='cursor: pointer;' />";
                ?>
            </div>
        </div>
    </div>
    <br>
</div>