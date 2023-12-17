DELIMITER //

-- Procédure qui retire une quantité d'un certain ingrédient
CREATE PROCEDURE prendreIngr(IN quantiteRetiree DECIMAL(10,2), IN idIngrRecherche INT(11))
BEGIN
    DECLARE quantiteActuelle DECIMAL(10,2);

    -- On sélectionne la quantité actuelle de l'ingrédient
    SELECT stockIngredient INTO quantiteActuelle
    FROM Ingredient
    WHERE idIngredient = idIngrRecherche;

    -- cas où la quantité retirée est supérieure à la quantité actuelle
    IF (quantiteRetiree > quantiteActuelle) THEN
        UPDATE Ingredient SET stockIngredient = 0.0 WHERE `Ingredient`.`idIngredient` = idIngrRecherche;
    ELSE
        UPDATE Ingredient SET stockIngredient = (quantiteActuelle - quantiteRetiree) WHERE `Ingredient`.`idIngredient` = idIngrRecherche;
    END IF;
END //

-- Procédure qui ajoute une quantité d'un certain ingrédient à son stock
CREATE PROCEDURE rechargerIngr(IN quantiteAjoutee DECIMAL(10,2), IN idIngrRecherche INT(11))
BEGIN
    DECLARE quantiteActuelle DECIMAL(10,2);

    -- On sélectionne la quantité actuelle de l'ingrédient
    SELECT stockIngredient INTO quantiteActuelle
    FROM Ingredient
    WHERE idIngredient = idIngrRecherche;

    -- rajoute le stock a l'ingrédient
    UPDATE Ingredient SET stockIngredient = (quantiteActuelle + quantiteAjoutee) WHERE `Ingredient`.`idIngredient` = idIngrRecherche;
END //
    
-- Procédure pour vérifier le stock d'ingrédients

CREATE PROCEDURE checkStockIngr(IN idIngrRecherche INT(11))
BEGIN
    DECLARE nomIngr VARCHAR(30);
    DECLARE seuilIngr INT;
    DECLARE stockIngr INT;

    -- Sélection du seuil d'alerte, du nouveau stock de l'ingrédient, de son nom 
    SELECT A.seuilIngredient, I.stockIngredient, I.nomIngredient
    INTO seuilIngr, stockIngr, nomIngr
    FROM Alerte A
    INNER JOIN Ingredient I ON A.idIngredient = I.idIngredient
    WHERE I.idIngredient = idIngrRecherche;

    -- Vérification du stock par rapport au seuil et envoi d'email si nécessaire
    IF stockIngr < seuilIngr THEN
        -- On envoie un mail pour alerter le gestionnaire
         UPDATE Alerte SET verifSeuil = TRUE WHERE `Alerte`.`idIngredient` = idIngrRecherche;
    ELSE 
         UPDATE Alerte SET verifSeuil = FALSE WHERE `Alerte`.`idIngredient` = idIngrRecherche;
    END IF;
END //
    
-- Déclencheur pour appeler la procédure après la mise à jour d'Ingredient
CREATE TRIGGER alerteManqueStock
AFTER UPDATE ON Ingredient
FOR EACH ROW
BEGIN
    IF (OLD.stockIngredient <> NEW.stockIngredient) THEN
    	CALL checkStockIngr(OLD.idIngredient);
    END IF;
END//

-- Insert dans Pizza les 2 autres tailles de la pizza medium inserée 
CREATE PROCEDURE pizzaTaille (IN idProd INT(11))
BEGIN    

    DECLARE idCate INT;

    SELECT idCategorie into idCate from Produit 
    Where idProduit = idProd;
    
    if idCate = 3 THEN 
        INSERT INTO `Pizza`(`idPizza`, `idProduit`, `idTaille`) VALUES (NULL,idProd,1), (NULL,idProd,2), (NULL,idProd,3);
    END IF;
END //
    
    
-- Calcule les quantitées des Tailles, Large et Medium des pizzas (depuis la taille medium) 
CREATE PROCEDURE qtnIngrTaille_Insert(IN idPi INT(11), IN idIngr INT(11))
BEGIN
    DECLARE idTailleP INT;
    DECLARE qtnDefaut INT;
    DECLARE qtnLarge INT;
    DECLARE qtnXL INT;

    SELECT idTaille into idTailleP FROM Pizza
    WHERE idPizza = idPi;

    if idTailleP = 1 THEN 
        SELECT B.idIngredient, B.quantiteIngredient 
        qtnDefaut FROM Base B
        WHERE B.idPizza = idPi and B.idIngredient = idIngr;

        SET qtnLarge = qtnDefaut * 1.5;
        SET qtnXL = qtnDefaut * 2;

        INSERT INTO `Base`(`idPizza`, `idIngredient`, `quantiteIngredient`) VALUES (idPi+1, idIngr, qtnLarge);
        INSERT INTO `Base`(`idPizza`, `idIngredient`, `quantiteIngredient`) VALUES (idPi+2, idIngr, qtnXL);
        
    END IF;

END //

-- Calcule les quantitées des Tailles, Large et Medium des pizzas (depuis la taille medium) 
CREATE PROCEDURE qtnIngrTaille_Update(IN idPi INT(11), IN idIngr INT(11))
BEGIN
    DECLARE idTailleP INT;
    DECLARE qtnDefaut INT;
    DECLARE qtnLarge INT;
    DECLARE qtnXL INT;

    SELECT idTaille INTO idTailleP FROM Pizza
    WHERE idPizza = idPi;


    IF idTailleP = 1 THEN 
        SELECT B.quantiteIngredient 
        INTO qtnDefaut FROM Base B
        WHERE B.idPizza = idPi AND B.idIngredient = idIngr;

        SET qtnLarge = qtnDefaut * 1.5;
        SET qtnXL = qtnDefaut * 2;

        UPDATE `Base` SET `quantiteIngredient` = qtnLarge WHERE `idPizza` = NEW.idPizza + 1 AND `idIngredient` = idIngr;
        UPDATE `Base` SET `quantiteIngredient` = qtnXL WHERE `idPizza` = NEW.idPizza + 2 AND `idIngredient` = idIngr;
    END IF;
END //

-- Trigger qui met les 3 tailles des pizzas si le produit inseré est de categorie pizza
CREATE TRIGGER alerteInsertTaille
AFTER INSERT ON Produit
FOR EACH ROW
BEGIN
    CALL pizzaTaille (NEW.idProduit);
END//
    
-- Trigger pour appeler la procédure de calcule des quantités selon Taille apres une insertion dans Base
-- Créer le déclencheur pour AFTER INSERT
CREATE TRIGGER alerteQtnTaille_Insert
AFTER INSERT ON Base
FOR EACH ROW
BEGIN
    -- Déclarer une variable de session pour suivre le nombre d'insertions
    SET @insertion_counter := IFNULL(@insertion_counter, 0);

    -- Si le compteur est égal à 1, appeler la procédure stockée
    IF @insertion_counter = 1 THEN
        CALL qtnIngrTaille_Insert(NEW.idPizza, NEW.idIngredient, NEW.quantiteIngredient);
    END IF;

    -- Incrémenter le compteur à chaque insertion
    SET @insertion_counter := @insertion_counter + 2;

    -- Réinitialiser le compteur après chaque deuxième insertion
    IF @insertion_counter > 3 THEN
        SET @insertion_counter := 0;
    END IF;
END //


DELIMITER ;

-- Trigger pour appeler la procédure de calcule des quantités selon Taille apres une mise a jour dans Base
-- Créer le déclencheur pour AFTER UPDATE
CREATE TRIGGER alerteQtnTaille_Update
AFTER UPDATE ON Base
FOR EACH ROW
BEGIN
    IF (OLD.quantiteIngredient <> NEW.quantiteIngredient) THEN
    CALL qtnIngrTaille_Update(OLD.idPizza, OLD.idIngredient);
END//

    
DELIMITER ;
