<div>
    <p>Je suis la</p>
    <?php
        echo "<p>$id</p>";
        echo "<p>$identifiant</p>";
        echo "<p>$classe</p>";
        foreach ($value as $val) {
            echo "<div class='row'>";
            echo "<h1>".$val->get('nomProduit')."</h1>";
            echo "<h2>".$val->get('quantiteProduit')."</h2>";
            echo "<h3>".$val->get('prixTotal')."</h3>";
            echo "</div>";
        }
    ?>
</div>