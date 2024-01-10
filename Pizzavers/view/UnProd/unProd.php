<div class="conteneurProd">
    <div class="btnRetour">
        <a href="index.php" style="padding: 20px;">Retour</a>
    </div>
    <div class="Separator">
        <div class="Prodimg">
            <img src="img/<?php echo $unProd->get('coverProduit'); ?>">
            <?php
                if(!empty($lstAllergene)){
                    echo "<h2>Les Allergènes</h2>";
                echo "<ul style='list-style-type:none;>'";
                foreach($lstAllergene as $unL){
                    echo "<li>".$unL->get('nomAllergene')."</li>";
                } echo "</ul>";
            }
            ?>
            <?php
                require_once("model/session.php");
                $id = $unProd->get($identifiant);

                if (session::clientConnected()) {
                    $prenom = $_SESSION["prenom"];
                    $nom = $_SESSION["nom"];
                    echo "
                    <div>
                    <a href='index.php?objet=panier&action=ajoutePanier&$identifiant=$id'>
                        <button type='submit'>Ajouter au panier</button>
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
        <div class="Prodinf">
            <?php
                echo "<h1>".$unProd->get('nomCategorie')." ".$unProd->get('nomProduit')."</h1>";
                if(!empty($lstIngr)){
                    echo "<h2>Les Ingrédients</h2>";
                echo "<ul style='list-style-type:none;>'";
                foreach($lstIngr as $unElement){
                        echo "<li><img src='img/ingredient/".$unElement->get('coverIngredient')."' /></li>";
                        echo "<li>".$unElement->get('nomIngredient')."</li>";
                        echo "<li class='qtn'>" .$unElement->get('quantiteIngredient')." g - cl </li>";
                        echo "<li><button class='diminuerIngr' type='button'> - </button>";
                        echo "<button class='ajouterIngr' type='button'> + </button></li>";
                } echo "</ul>";
                }
            ?>
            <?php
            //     require_once("model/session.php");
            //     $id = $unProd->get($identifiant);

            //     if (session::clientConnected()) {
            //         $prenom = $_SESSION["prenom"];
            //         $nom = $_SESSION["nom"];
            //         echo "
            //         <div>
            //         <a href='index.php?objet=panier&action=ajoutePanier&$identifiant=$id'>
            //             <button type='submit'>Ajouter au panier</button>
            //         </a>
            //         </div>";
            //     }
            //     else {
            //         echo "
            //         <div class='seConnecter'>
            //         <!-- <img src='img/icons8-personne-homme-64.png' /> -->
            //         <a href='index.php?objet=connexion&action=afficherConnexion'>
            //             <button type='submit'>Ajouter au panier</button>
            //         </a>
            //         </div>";
            //     }
            ?>  
        </div>
    </div>
</div>