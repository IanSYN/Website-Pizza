<main>
    <h1>Pizzas à l'affiche</h1>
    <?php
    foreach ($tableauProduits as $element) {

        // On n'accepte que les pizzas
        if ($element->get("idCategorie") == $idCategoriePizza) {

            $idProduit = $element->get("idProduit");
            $nomProduit = $element->get("nomProduit");
            $urlImage = $element->get("coverProduit");
            $alAffiche = $element->get("alAffiche");
           

            echo "<div class='blocProduit'>";
            echo "<img src='img/$urlImage' />";
            echo "<p> Pizza ".$nomProduit." </p>";

            // Cas où la pizza est déjà à l'affiche
            if ($alAffiche) {
                echo "<button type='button' class='disabled' disabled/> Déjà à l'affiche </button>";
            }
            else {
                echo "<a href='index.php?objet=produit&action=mettreAlAffiche&idProduit=$idProduit'> <button type='button' /> Mettre à l'affiche </button></a>";
            }
            echo "</div>";
        }
    }
    ?>
</main>
</body>