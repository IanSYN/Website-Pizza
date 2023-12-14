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

DELIMITER ;
