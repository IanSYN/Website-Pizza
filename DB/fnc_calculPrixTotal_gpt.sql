DELIMITER //

CREATE PROCEDURE calculPrixTotal(idCommandeCible INT(11))
BEGIN

    /* Variables de somme des prix */
    DECLARE sommePrixProduits DECIMAL(15,2) DEFAULT 0.00;
    DECLARE sommePrixPizzas DECIMAL(15,2) DEFAULT 0.00;

    /* Variables temporaires pour stocker les FETCH dans les curseurs */
    -- crsProduits
    DECLARE produit_idProduit INT(11);
    DECLARE produit_prixProduit DECIMAL(15,2);
    DECLARE produit_quantiteProduit INT(11);

    -- crsPizzasPersos
    DECLARE pizza_idPizzaPerso INT(11);
    DECLARE pizza_quantitePizza INT(11);
    DECLARE pizza_prixProduit DECIMAL(15,2);

    -- crsSupplements
    DECLARE supplement_quantiteSupplement INT(11);
    DECLARE supplement_prixIngredient DECIMAL(15,2);
    DECLARE supplement_quantiteIngredient INT(11);

    -- Curseur qui sélectionnera les produits du panier, leur prix et
    -- leur quantité commandée
    DECLARE produits_finished INT DEFAULT 0; -- Pour déterminer si le curseur a été parcouru en entier
    DECLARE crsProduits CURSOR FOR 
        SELECT PR.prixProduit, PA.quantiteProduit
        FROM `Produit` PR
        INNER JOIN `Panier` PA ON PR.idProduit = PA.idProduit
        WHERE PA.idCommande = idCommandeCible;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET produits_finished = 1;

    OPEN crsProduits;
    produits_loop: LOOP
        FETCH crsProduits INTO produit_idProduit, produit_prixProduit, produit_quantiteProduit;
        IF produits_finished THEN
            LEAVE produits_loop;
        END IF;
        SET sommePrixProduits = sommePrixProduits + (produit_prixProduit * produit_quantiteProduit);
    END LOOP;
    CLOSE crsProduits;

    -- Sélection des pizzas personnalisées
    DECLARE pizzas_finished INT DEFAULT 0;
    DECLARE crsPizzasPersos CURSOR FOR
        SELECT PP.idPizzaPersonnalisee, PP.quantitePizza, PR.prixProduit
        FROM `PizzaPersonnalisee` PP
        INNER JOIN `Pizza` PI ON PP.idPizza = PI.idPizza
        INNER JOIN `Produit` PR ON PI.idProduit = PR.idProduit
        WHERE PP.idCommande = idCommandeCible;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET pizzas_finished = 1;

    OPEN crsPizzasPersos;
    pizzas_loop: LOOP
        FETCH crsPizzasPersos INTO pizza_idPizzaPerso, pizza_quantitePizza, pizza_prixProduit;
        IF pizzas_finished THEN
            LEAVE pizzas_loop;
        END IF;

        SET sommePrixPizzas = sommePrixPizzas + (pizza_prixProduit * pizza_quantitePizza);

        -- Sélection des suppléments pour chaque pizza personnalisée
        DECLARE crsSupplements CURSOR FOR
            SELECT S.quantiteSupplement, I.prixIngredient, B.quantiteIngredient
            FROM `Supplement` S
            INNER JOIN `Ingredient` I ON S.idIngredient = I.idIngredient
            INNER JOIN `Base` B ON I.idIngredient = B.idIngredient
            WHERE S.idPizzaPersonnalisee = pizza_idPizzaPerso;

        DECLARE CONTINUE HANDLER FOR NOT FOUND BEGIN END;
        OPEN crsSupplements;
        supplements_loop: LOOP
            FETCH crsSupplements INTO supplement_quantiteSupplement, supplement_prixIngredient, supplement_quantiteIngredient;
            IF supplement_quantiteIngredient = 0 THEN
                SET sommePrixPizzas = sommePrixPizzas - (supplement_prixIngredient * (supplement_quantiteSupplement / 1000));
            ELSE
                SET sommePrixPizzas = sommePrixPizzas + ((supplement_prixIngredient * (supplement_quantiteSupplement / 1000)) * supplement_quantiteSupplement);
            END IF;
        END LOOP;
        CLOSE crsSupplements;
    END LOOP;
    CLOSE crsPizzasPersos;

    -- Mise à jour de la table Commande avec le prix total
    UPDATE `Commande` SET prixTotalCommande = (sommePrixPizzas + sommePrixProduits) WHERE idCommande = idCommandeCible;
END //

DELIMITER ;
