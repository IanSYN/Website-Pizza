<main>
    <h1>Mon compte gestionnaire</h1>
    <?php
    echo "<div>";
    echo "<h2>Adresse mail</h2>";
    echo "<p>".$gest->get('mailGestionnaire')."</p>";
    echo "<button type='button'>Modifier</button>";

    echo "<h2>Numéro de Téléphone</h2>";
    echo "<p>".$gest->get('telGestionnaire')."</p>";
    echo "<button type='button'>Modifier</button>";
    echo "<a href='index.php?objet=connexion&action=disconnect'>";
    echo "<button>Déconnexion</button> </a>";
    echo "</div>"
    ?>
    
</main>
