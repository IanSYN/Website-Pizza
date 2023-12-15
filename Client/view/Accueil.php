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
                            echo "<a href='?classe=$val'>$val</a>";
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
                            foreach($listProd as $val2){
                                if($val->get('nomCategorie') == $val2->get('nomCategorie')){
                                    echo "<a href='index.php?objet=produit&action=afficher'>$val2</a><br>";
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>