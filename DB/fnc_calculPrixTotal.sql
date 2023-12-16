DELIMITER //

CREATE PROCEDURE calculPrixTotal(idCommandeCible INT(11))
BEGIN
    DECLARE sommePrixProduits DECIMAL(15,2);
    DECLARE sommePrixPizzas DECIMAL(15,2);

    -- Curseur qui sélectionnera les produits du panier, leur prix et
    -- leur quantité commandée
    DECLARE crsProduits CURSOR FOR 
        SELECT PR.idProduit, PR.prixProduit, PA.quantiteProduit
        FROM `Produit` PR
        INNER JOIN `Panier` PA ON PR.idProduit = PA.idProduit
        WHERE PA.idCommande = idCommandeCible;

    -- Curseur qui sélectionnera les pizza personnalisées des clients,
    -- leurs quantités et leur prix
    DECLARE crsPizzasPersos CURSOR FOR
        SELECT PP.idPizzaPersonnalisee, PP.quantitePizza, PR.prixProduit
        FROM `PizzaPersonnalisee` PP
        INNER JOIN `Pizza` PI ON PP.idPizza = PI.idPizza
        INNER JOIN `Produit` PR ON PI.idProduit = PR.idProduit
        WHERE PP.idCommande = idCommandeCible;

    -- Curseur qui prend l'identifiant de l'ingrédient supplémentaire (ou à retirer) 
    -- et son prix au kilo, en fonction de la pizza personnalisée
    DECLARE crsSupplements(PizzaPersoCible INT(11)) CURSOR FOR
        SELECT  S.quantiteSupplement, I.prixIngredient, B.quantiteIngredient
        FROM `Supplement` S
        INNER JOIN `Ingredient` I ON S.idIngredient = I.idIngredient
        INNER JOIN `Base` B ON I.idIngredient = B.idIngredient
        WHERE S.idPizzaPersonnalisee = PizzaPersoCible;
        
    /* Partie à traduire */
    
    -- Calcul de la somme de tous les produits (autres que les pizzas)
    FOR unProduit IN crsProduits
    LOOP
        sommePrixProduits := sommePrixProduits + (unProduit.prixProduit*unProduit.quantiteProduit);
    END LOOP;


    -- Calcul de la somme de toutes les pizzas commandées
    FOR unePizza IN crsPizzasPersos
    LOOP
        -- on ajoute le prix original de la pizza à la somme
        sommePrixPizzas := sommePrixPizzas + (unePizza.prixProduit*unePizza.quantitePizza);

        -- on recherche les suppléments de chaque pizza personnalisée
        FOR unSupplement IN crsSupplements(unePizza.idPizzaPersonnalisee)
        LOOP
            -- Si quantiteSupplement = 0, on considère que l'ingrédient doit être retiré
            IF unSupplement.quantiteIngredient = 0 THEN
                sommePrixPizzas := sommePrixPizzas - (unSupplement.prixIngredient*(unSupplement.quantiteSupplement/1000));
            ELSE -- On ajoute les suppléments
                sommePrixPizzas := sommePrixPizzas + ((unSupplement.prixIngredient*(unSupplement.quantiteSupplement/1000)) * unSupplement.quantiteSupplement);
            END IF;
        END LOOP;
    END LOOP;

    /* Fin de la partie à traduire */

    -- On met à jour la table et on insère le prix total
    UPDATE `Commande` SET prixTotalCommande = (sommePrixPizzas + sommePrixProduits) WHERE idCommande = idCommandeCible;
END //
DELIMITER ;