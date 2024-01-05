<main>
    <h1>Pizza à l'affiche</h1>
    <?php
    foreach ($tableauProduits as $element) {

        // On n'accepte que les pizzas
        if ($element->get("idCategorie") == $idCategoriePizza) {

            $idProduit = $element->get("idProduit");
            $nomProduit = $element->get("nomProduit");
            $urlImage = $element->get("coverProduit");
            $alAffiche = $element->get("alAffiche");
           

            echo "<div class='blockPizza'>";
            echo "<img src='img/$urlImage' />";
            echo "<p> Pizza ".$nomProduit." </p>";
            echo "<a href='index.php?objet=produit&action=mettreAlAffiche&idProduit=$idProduit'> <button type='button'";

            // Cas où la pizza est déjà à l'affiche
            if ($alAffiche) {
                echo "class='disabled' disabled/> Déjà à l'affiche <button>";
            }
            else {
                echo "/> Mettre à l'affiche <button>";
            }
            echo "</a></div>";
        }
    }
    ?>
</main>
</body>