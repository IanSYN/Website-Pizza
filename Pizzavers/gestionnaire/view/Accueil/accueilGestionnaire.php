
    <h1>Mon espace gestionnaire</h1>
    <br />
    <section class="menuGestionnaire">
        <div class="ContenerGestionnaire">
            <div>
                <a href="index.php?objet=produit&action=pizzaAlAffiche">
                    <button>Pizza à l'affiche</button>
                </a>
            </div>
            <div>
                <a href="index.php?objet=produit&action=nosPizzas">
                    <button>Gérer les pizzas</button>
                </a>
            </div>
            <div>
                <a href="index.php?objet=produit&action=nosProduit">
                    <button>Gérer les produit</button>
                </a>
            </div>
            <div>
                <a href="index.php?objet=ingredient&action=afficherEtatStock">
                    <button>Etat des stocks</button>
                </a>
            </div>
        </div>
        <br>
        <div class="ContenerStatistique">
            <div>
                <h2>Statistique de la journée</h2>
                <?php
                    $NbCommande = $Statjour->get("nbrCommande");
                    if ($NbCommande == 0) {
                        $CA = 0;
                    }
                    else {
                        $CA = $Statjour->get("CATotal");
                    }
                    echo "<p>Nombre de commande : ".$NbCommande."</p><br><p>Chiffre d'affaire : ".$CA."€</p>";
                ?>
            </div>
            <div>
                <h2>Statistique de la semaine</h2>
                <?php
                    $NbCommande = $Stathebdo->get("nbrCommande");
                    if ($NbCommande == 0) {
                        $CA = 0;
                    }
                    else {
                        $CA = $Stathebdo->get("CATotal");
                    }
                    echo "<p>Nombre de commande : ".$NbCommande."</p><br><p>Chiffre d'affaire : ".$CA."€</p>";
                ?>
            </div>
            <div>
                <h2>Statistique du mois</h2>
                <?php
                    $NbCommande = $StatMensuel->get("nbrCommande");
                    if ($NbCommande == 0) {
                        $CA = 0;
                    }
                    else {
                        $CA = $StatMensuel->get("CATotal");
                    }
                    echo "<p>Nombre de commande : ".$NbCommande."</p><br><p>Chiffre d'affaire : ".$CA."€</p>";
                ?>
            </div>
            <div>
                <h2>Statistique global</h2>
                <?php
                    $NbCommande = $StatGlobal->get("nbrCommande");
                    if ($NbCommande == 0) {
                        $CA = 0;
                    }
                    else {
                        $CA = $StatGlobal->get("CATotal");
                    }
                    echo "<p>Nombre de commande : ".$NbCommande."</p><br><p>Chiffre d'affaire : ".$CA."€</p>";
                ?>
            </div>
        </div>
        <!--
        <span id="pizza-affiche">
            <a href="index.php?objet=pizza?action=pizzaAlAffiche">
                <img src="img/pizza_a_l_affiche.jpeg" />
                <p>Pizza du jour</p>
            </a>
        </span>
        -->
    </section>
</main>
</body>
</html>