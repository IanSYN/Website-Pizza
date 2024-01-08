<main>
    <h1>Nos produit</h1>
    <?php
    foreach ($tableauProduits as $element) {
        if ($element->get("idCategorie") != 3) {

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
</main>
</body>