<div>
    <?php
    if (isset($_GET['nom']) && isset($_GET['prix']) && isset($_GET['picture'])) {
        $nom = $_GET['nom'];
        $prix = $_GET['prix'];
        $picture = $_GET['picture'];
        $idCategorie = 3;
        $alAffiche = 0;
        $idProduit = 0;
        $produit = new Produit($idProduit, $nom, $prix, $picture, $idCategorie, $alAffiche);
        $produit->save();
    }
    echo "h1>Pizza Ajouté</h1>";
    echo "<p> Pizza ".$nom." </p>";
    echo "<img src='img/$picture' />";
    echo "".$prix."";
    echo "<a href='index.php?objet=produit&action=nosPizzas'> <button type='button'> Retour </button></a>";
    ?>
</div>