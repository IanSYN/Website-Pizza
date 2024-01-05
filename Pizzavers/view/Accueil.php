<div class="Accueil">
    <div class="contener">
        <div class="EnAvant" style='background-image: url("img/pizzaRegina.jpg");'>

        </div>
        <div class="contenerListe">
            <div class="ContenerNav">
                <div class="Navigation">
                    <h1>Nos offres</h1>
                    <?php
                        foreach ($listCate as $val) {
                            echo "<a href='?classe=#.$val'>$val</a>";
                        }
                    ?>
                </div>
            </div>
            <div class="conteneurListeP">
                <div class="ListeP">
                    <p>Liste de produit</p>
                    <?php
                        foreach ($listCate as $val) {
                            echo "<h1>$val</h1><br>";
                            echo "<div class=containerObjet>";
                            foreach($listProd as $val2){
                                if($val->get('nomCategorie') == $val2->get('nomCategorie')){
                                    echo "<div class='$val2'>";
                                    $id = $val2->get($identifiant);
                                    echo "<img src='img/".$val2->get('coverProduit')."'><br>";
                                    echo "<a href='index.php?objet=Accueil&action=afficherOne&$identifiant=$id'>$val2</a><br>";
                                    echo "</div>";
                                }
                            }
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>