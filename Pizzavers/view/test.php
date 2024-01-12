<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon panier</title>
        <link rel="stylesheet" href="view/css/style.css" />
    </head>
    <body>
        <?php
            foreach ($PizValue as $val2) {
                echo $val2->get('idPizzaPersonnalisee') . "<br>";
            }
        ?>
    </body>
</html>