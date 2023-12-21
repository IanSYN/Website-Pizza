<div class="Accueil">
    <div class="contener">
        <div class="EnAvant">

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
                                    //echo "<img src='../img.".$val2->get('imageProduit')."'><br>";
                                    echo '<img src="img/pza.jpg"><br>';
                                    echo "<a href='index.php?objet=Accueil&action=afficher'>$val2</a><br>";
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