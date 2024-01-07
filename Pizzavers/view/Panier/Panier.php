<div>
    <h1>Panier</h1>
    <?php
        echo "<p>$id</p>";
        echo "<p>$identifiant</p>";
        echo "<p>$classe</p>";
        foreach ($value as $val) {
            echo "<div class='row'>";
            echo "<h1>".$val->get('nomProduit')."</h1>";
            echo "<h1>".$val->get('quantiteProduit')."</h1>";
            echo "<h1>".$val->get('prixTotal')."</h1>";
            echo "</div>";
        }
    ?>
    <form action="index.php?objet=panier&action=pagePaiement" method="POST">
        <input type="submit" name="boutonPayer" value="Payer" style="cursor: pointer;" />
</div>