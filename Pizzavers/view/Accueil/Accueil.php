<div class="Accueil fadeIn">
    <div>
        <br>
        <h1 style="text-align: center;">Bienvenue dans votre PizzaVers</h1>
        <h1 style="text-align: center;">Bien plus qu'une pizza, une explosion de saveurs à chaque bouchée !</h1>
    </div>
    <div class="contener">
        <div class="ContenerEnAvant entrer"> <!-- à mettre : un code php affichant la pizza à l'affiche -->
            <?php
                $id = $AlAffiche->get($identifiant);
                echo "<a href='index.php?objet=Accueil&action=afficherOne&$identifiant=$id'><div class='EnAvant' style='background-image: url(img/".$AlAffiche->get('coverProduit').");'></div></a>";
                echo "<div class='infoEnAvant'>
                <p>La pizza du moment</p>
                <h1>".$AlAffiche->get('nomProduit')."</h1>
                <p>".$AlAffiche->get('prixProduit')."€</p>
                <br>
                <br>
                <a href='index.php?objet=Accueil&action=afficherOne&$identifiant=$id'>
                    <button class='VoirP' type='submit'>Voir plus</button>
                </a>
                </div>";
            ?>
        </div>
        <div class="contenerListe">
            <div class="ContenerNav">
                <div class="Navigation">
                    <h1>Nos offres</h1>
                    <?php
                        foreach ($listCate as $val) {
                            echo "<a href=index.php?#".$val.">". $val->get('nomCategorie') ."</a>";
                        }
                    ?>
                </div>
            </div>
            <div class="conteneurListeP">
                <div class="ListeP">
                    <p>Liste de produit</p>
                    <?php
                        foreach ($listCate as $val) {
                            echo "<h1 class=\"$val\">".$val->get('nomCategorie')."</h1><br>";
                            echo "<div class=containerObjet>";
                            foreach($listProd as $val2){
                                if($val->get('nomCategorie') == $val2->get('nomCategorie')){
                                    echo "<div class='Produit entrer'>";
                                    $id = $val2->get($identifiant);
                                    echo "<a href='index.php?objet=Accueil&action=afficherOne&$identifiant=$id'><img src='img/".$val2->get('coverProduit')."'><br>";
                                    echo "<h1>".$val2->get('nomProduit')."</h1><br>";
                                    echo "</div></a>";
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