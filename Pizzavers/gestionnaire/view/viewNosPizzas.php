<main>
    <h1>Nos Pizzas</h1>
    <?php
    foreach ($tableauProduits as $element) {

        // On n'accepte que les pizzas
        if ($element->get("idCategorie") == $idCategoriePizza) {

            $idProduit = $element->get("idProduit");
            $nomProduit = $element->get("nomProduit");
            $urlImage = $element->get("coverProduit");
            $alAffiche = $element->get("alAffiche");
           

            echo "<div class='blocPizza-AlAffiche'>";
            echo "<img src='img/$urlImage' />";
            echo "<p> Pizza ".$nomProduit." </p>";
            echo "<a href='index.php?objet=produit&action=mettreAlAffiche&idProduit=$idProduit'> <button type='button' /> Supprimer </button></a>";
            echo "</div>";
        }
    }
    ?>
    <a href='index.php?objet=produit&action=ajouterPizza'> <button type='button'> Ajouter </button></a>
</main>
