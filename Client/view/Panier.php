<main class="Produit">
    <div class='Gauche'>
        <p>Catégorie</p>
        <?php
        foreach ($tableau as $ligne){
            echo "<a href='index.php?controller=produit&action=afficherProduit&id=$ligne->idProduit'>$ligne->nomProduit</a><br>";
        }
        ?>
    </div>
    <div class='Droite'>
        <h1>Produit</h1>
        <p>Voici le produit</p>
    </div>
</main>
</body>