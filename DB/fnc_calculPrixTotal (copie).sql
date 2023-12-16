DELIMITER //

CREATE FUNCTION calculSupplements(pizza_idPizzaPerso INT(11))
RETURNS DECIMAL(15,2)
BEGIN
		DECLARE resultat DECIMAL(15,2) DEFAULT 0.00;

		-- Déclaration des variables temporaires pour curseur
    DECLARE supplement_quantiteSupplement INT(11);
    DECLARE supplement_prixIngredient DECIMAL(15,2);
    DECLARE supplement_quantiteIngredient INT(11);

		-- Curseur qui prend l'identifiant de l'ingrédient supplémentaire (ou à retirer) 
    -- et son prix au kilo, en fonction de la pizza personnalisée
    DECLARE crsSupplement_fini INT DEFAULT FALSE; 
    DECLARE crsSupplements CURSOR FOR
        SELECT  S.quantiteSupplement, I.prixIngredient, B.quantiteIngredient
        FROM `Supplement` S
        INNER JOIN `Ingredient` I ON S.idIngredient = I.idIngredient
        INNER JOIN `Base` B ON I.idIngredient = B.idIngredient
        WHERE S.idPizzaPersonnalisee = PizzaPersoCible;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET crsSupplement_fini = TRUE;

		OPEN crsSupplements(pizza_idPizzaPerso); -- On ouvre le curseur avec l'identifiant de la pizza personnalisée correspondante
        supplements_loop: LOOP
            FETCH crsSupplements INTO supplement_quantiteSupplement, supplement_prixIngredient, supplement_quantiteIngredient;

            -- Si on arrive à la fin 
            IF crsSupplement_fini THEN
                LEAVE supplements_loop;
            END IF;

            -- Si la quantité du supplément est à 0, on considère que l'ingrédient est à retirer
            IF supplement_quantiteIngredient = 0 THEN
                SET resultat = resultat - (supplement_prixIngredient * (supplement_quantiteSupplement / 1000));
            ELSE
                SET resultat = resultat + ((supplement_prixIngredient * (supplement_quantiteSupplement / 1000)) * supplement_quantiteSupplement);
            END IF;
        END LOOP;
		CLOSE crsSupplements;
		
		RETURN resultat;
END //


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

    
    /* Partie des curseurs */

    -- Curseur qui sélectionnera les produits du panier, leur prix et
    -- leur quantité commandée
    DECLARE crsProduits_fini INT DEFAULT FALSE; -- Pour déterminer si le curseur a été parcouru en entier
    DECLARE crsProduits CURSOR FOR 
        SELECT PR.idProduit, PR.prixProduit, PA.quantiteProduit
        FROM `Produit` PR
        INNER JOIN `Panier` PA ON PR.idProduit = PA.idProduit
        WHERE PA.idCommande = idCommandeCible;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET crsProduits_fini = TRUE; -- Se mettra à TRUE lorsqu'on aura parcouru le curseur


    -- Curseur qui sélectionnera les pizza personnalisées des clients,
    -- leurs quantités et leur prix
    DECLARE crsPizzasPersos_fini INT DEFAULT FALSE; 
    DECLARE crsPizzasPersos CURSOR FOR
        SELECT PP.idPizzaPersonnalisee, PP.quantitePizza, PR.prixProduit
        FROM `PizzaPersonnalisee` PP
        INNER JOIN `Pizza` PI ON PP.idPizza = PI.idPizza
        INNER JOIN `Produit` PR ON PI.idProduit = PR.idProduit
        WHERE PP.idCommande = idCommandeCible;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET crsPizzasPersos_fini = TRUE;    

       

    /* Partie de calcul */
    
    -- Calcul de la somme de tous les produits (autres que les pizzas)
    OPEN crsProduits;
    produits_loop: LOOP
        FETCH crsProduits INTO produit_idProduit, produit_prixProduit, produit_quantiteProduit;
        IF crsProduits_fini THEN
            LEAVE produits_loop;
        END IF;
        SET sommePrixProduits = sommePrixProduits + (produit_prixProduit * produit_quantiteProduit);
    END LOOP;
    CLOSE crsProduits;


    -- Calcul de la somme de toutes les pizzas commandées
    OPEN crsPizzasPersos;
    pizzas_loop: LOOP
        FETCH crsPizzasPersos INTO pizza_idPizzaPerso, pizza_quantitePizza, pizza_prixProduit;
        IF crsPizzasPersos_fini THEN
            LEAVE pizzas_loop;
        END IF;

        -- on ajoute à la somme le prix original de la pizza + les supplements
        SET sommePrixPizzas = sommePrixPizzas + ((pizza_prixProduit + calculerSupplement(pizza_idPizzaPerso)) * pizza_quantitePizza);

    END LOOP;
    CLOSE crsPizzasPersos;

    -- On met à jour la table et on insère le prix total
    UPDATE `Commande` SET prixTotalCommande = (sommePrixPizzas + sommePrixProduits) WHERE idCommande = idCommandeCible;
END //
DELIMITER ;