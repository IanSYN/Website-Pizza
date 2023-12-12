DELIMITER //

-- Procédure qui retire une quantité d'un certain ingrédient
CREATE PROCEDURE prendreIngr(IN quantiteRetiree DECIMAL(10,2), IN idIngrRecherche INT(11), OUT msg VARCHAR(50))
BEGIN
    DECLARE quantiteActuelle DECIMAL(10,2);

    -- On sélectionne la quantité actuelle de l'ingrédient
    SELECT stockIngredient INTO quantiteActuelle
    FROM Ingredient
    WHERE idIngredient = idIngrRecherche;

    -- cas où la quantité retirée est supérieure à la quantité actuelle
    IF (quantiteRetiree > quantiteActuelle) THEN
        UPDATE Ingredient SET stockIngredient = 0 WHERE idIngredient = idIngrRecherche;
    ELSE
        UPDATE Ingredient SET stockIngredient = (quantiteActuelle - quantiteRetiree) WHERE idIngredient = idIngrRecherche;
    END IF;
    SET msg = "UPDATE DONE";
END //

DELIMITER;

-- Procédure pour vérifier le stock d'ingrédients
DELIMITER //

CREATE PROCEDURE checkStockIngr(IN idIngrRecherche INT(11))
BEGIN
    DECLARE nomIngr VARCHAR(30);
    DECLARE mailGestio VARCHAR(30);
    DECLARE seuilIngr INT;
    DECLARE stockIngr INT;

    -- Sélection du seuil d'alerte, du nouveau stock de l'ingrédient, de son nom et de l'adresse mail du gestionnaire 
    SELECT A.seuilIngredient, I.stockIngredient, I.nomIngredient, G.mailGestionnaire
    INTO seuilIngr, stockIngr, nomIngr, mailGestio
    FROM Alerte A
    INNER JOIN Ingredient I ON A.idIngredient = I.idIngredient
    INNER JOIN Gestionnaire G ON A.idGestionnaire = G.idGestionnaire
    WHERE I.idIngredient = idIngrRecherche;

    -- Vérification du stock par rapport au seuil et envoi d'email si nécessaire
    IF stockIngr < seuilIngr THEN
        -- On envoie un mail pour alerter le gestionnaire
        CALL ENVOI_EMAIL('sarah-myriam.messaoudi@universite-paris-saclay.fr', mailGestio, CONCAT('Warning: ', nomIngr, ' SUPPLIES'), CONCAT('Stock of the ingredient: ', nomIngr, ' needs supplying'));
    END IF;
END //

DELIMITER ;

-- Déclencheur pour appeler la procédure après la mise à jour d'Ingredient
CREATE TRIGGER alerteManqueStock
AFTER UPDATE ON Ingredient
FOR EACH ROW
BEGIN
    IF (OLD.stockIngredient <> NEW.stockIngredient) THEN
    	CALL checkStockIngr(OLD.idIngredient);
    END IF;
END;
