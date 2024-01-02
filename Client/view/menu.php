<header>
    <div class="contenerBarre">
        <div class="barre">
            <div class="nom">
                <a href="index.php">Pizzavers</a>
            </div>
            <div>
                <a href="index.php">
                    <button type="submit">Accueil</button>
                </a>
            </div>
            <div>
                <a href="index.php?objet=info&action=afficherPage">
                    <button type="submit">qui sommes nous ?</button>
                </a>
            </div>
            <div>
                <a href="page2">
                    <button type="submit">Panier</button>
                </a>
            </div>
            <?php
                require_once("model/session.php");

                if (session::clientConnected()) {
                    $prenom = $_SESSION["prenom"];
                    $nom = $_SESSION["nom"];
                    echo "<div class='compte'>";
                    echo "<p> Bonjour $prenom $nom ! </p>";
                    echo "
                    <a href='index.php?objet=connexion&action=disconnect'>
                        <button type='submit'>Se déconnecter</button>
                    </a>
                    </div>";
                }
                else {
                    echo "
                    <div class='seConnecter'>
                    <!-- <img src='img/icons8-personne-homme-64.png' /> -->
                    <a href='index.php?objet=connexion&action=afficherConnexion'>
                        <button type='submit'><img src='img/icons8-personne-homme-64.png' />Se connecter</button>
                    </a>
                    </div>";
                }
            ?>
        </div>
    </div>
</header>
<body>
