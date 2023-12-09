<body>
    <div class="enAvant">
        <?php
        foreach ($tableau as $element) {
            ?>
            <div class="element">
                <a href="index.php?objet=pizza&action=displayOne&idIngredient=<?php echo $element->getIdIngredient(); ?>">
                    <img src="<?php echo $element->getCoverIngredient(); ?>" alt="<?php echo $element->getNomIngredient(); ?>">
                    <h2><?php echo $element->getNomIngredient(); ?></h2>
                </a>
            </div>
            <?php
        }
        ?>
    </div>
</body>