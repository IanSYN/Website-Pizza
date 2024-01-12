<main>
    <h1>Nos produits</h1>
    <?php
    foreach ($tableauProduits as $element) {
        if ($element->get("idCategorie") != 3) {

            $idProduit = $element->get("idProduit");
            $nomProduit = $element->get("nomProduit");
            $urlImage = $element->get("coverProduit");
            $alAffiche = $element->get("alAffiche");

            echo "<div class='blocProduit'>";
            echo "<img src='img/$urlImage' />";
            echo "<p>$nomProduit</p>";
            echo "<a href='index.php?objet=produit&action=mettreAlAffiche&idProduit=$idProduit'> <button type='button' /> Supprimer </button></a>";
            echo "</div>";
        }
    }
    ?>
    <div class="buttonDiv">
        <a href='index.php?objet=produit&action=ajouterPizza'> <button type='button'> Ajouter </button></a>
    </div>
</main>
</body>