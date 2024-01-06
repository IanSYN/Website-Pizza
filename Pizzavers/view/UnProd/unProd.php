<div class="conteneurProd">
    <div class="btnRetour">
        <a href="index.php" style="padding: 20px;">Retour</a>
    </div>
    <div class="Separator">
        <div class="Prodimg">
            <img src="img/<?php echo $unProd->get('coverProduit'); ?>">
        </div>
        <div class="Prodinf">
            <?php
                echo "<h1>".$unProd->get('nomProduit')."</h1>";
            ?>
            <?php
                require_once("model/session.php");
                $id = $unProd->get($identifiant);

                if (session::clientConnected()) {
                    $prenom = $_SESSION["prenom"];
                    $nom = $_SESSION["nom"];
                    echo "
                    <div>
                    <a href='index.php?objet=accueil&action=afficherAjoute&$identifiant=$id'>
                        <button type='submit'>Ajouter au panier2</button>
                    </a>
                    </div>";
                }
                else {
                    echo "
                    <div class='seConnecter'>
                    <!-- <img src='img/icons8-personne-homme-64.png' /> -->
                    <a href='index.php?objet=connexion&action=afficherConnexion'>
                        <button type='submit'>Ajouter au panier</button>
                    </a>
                    </div>";
                }
            ?>
        </div>
    </div>
</div>