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
        UPDATE Ingredient SET stockIngredient = 0 WHERE idIngredient = idIngrRecherche;
    ELSE
        UPDATE Ingredient SET stockIngredient = (quantiteActuelle - quantiteRetiree) WHERE nomIngredient = nomIngrRecherche;
    END IF;
END //

DELIMITER;


-- Procédure pour vérifier le stock d'ingrédients
DELIMITER //

CREATE PROCEDURE checkStockIngr()
BEGIN
    DECLARE nomIngr VARCHAR(30);
    DECLARE mailGestio VARCHAR(30);
    DECLARE seuilIngr INT;
    DECLARE stockIngr INT;

    -- Sélection du seuil d'ingrédient depuis la table Alerte
    SELECT A.seuilIngredient, I.stockIngredient, I.nomIngredient, G.mailGestionnaire
    INTO seuilIngr, stockIngr, nomIngr, mailGestio
    FROM Alerte A
    INNER JOIN Ingredient I ON A.idIngredient = I.idIngredient
    INNER JOIN Gestionnaire G ON A.idGestionnaire = G.idGestionnaire;

    -- Vérification du stock par rapport au seuil et envoi d'email si nécessaire
    IF stockIngr < seuilIngr THEN
        -- On envoie un mail pour alerter le gestionnaire
        CALL ENVOI_EMAIL('sarah-myriam.messaoudi@universite-paris-saclay.fr', mailGestio, CONCAT('Warning: ', nomIngr, ' SUPPLIES'), CONCAT('Stock of the ingredient: ', nomIngr, ' needs supplying'));
    END IF;
END //

	
-- Déclencheur pour appeler la procédure après la mise à jour d'Ingredient
CREATE TRIGGER alerteManqueStock
AFTER UPDATE ON Ingredient
FOR EACH ROW
BEGIN
	IF (OLD.stockIngredient <> NEW.stockIngredient) THEN
   		CALL checkStockIngr();
	END IF;
END //
	
DELIMITER ;
