<section class='alerte'>
<?php
    echo "<img src='img/ingredient/$cover' />";
    echo "<h3> $nom </h3>";
    echo "<p> Stock actuel : $stock g </p>";
?>
    <input type="number" id="<?php echo "$idIngr"?>" name="<?php echo "$idIngr"?>" value="<?php echo $seuil?>" min="0.0" step="0.1" required/>
</section>