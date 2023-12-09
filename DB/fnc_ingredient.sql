-- Version ORACLE
CREATE OR REPLACE PROCEDURE prendreIngr(quantiteRetiree IN Ingredient.stockIngredient%TYPE, nomIngrRecherche IN Ingredient.nomIngrRecherche%TYPE)
RETURN DECIMAL(10,2) IS
	quantiteActuelle Ingredient.stockIngredient%TYPE;
BEGIN

	-- On sélectionne la quantité actuelle de l'ingrédient
	SELECT stockIngredient INTO quantiteActuelle
    FROM Ingredient
    WHERE nomIngredient = nomIngrRecherche;

	-- cas où la quantité retirée est supérieure à la quantité actuelle
    IF (quantiteRetiree > quantiteActuelle) THEN
    	UPDATE Ingredient SET stockIngredient = 0 WHERE nomIngredient = nomIngrRecherche;
    ELSE
    	UPDATE Ingredient SET stockIngredient = (quantiteActuelle-quantiteRetiree) WHERE nomIngredient = nomIngrRecherche;
    END IF;
END;
/

-- Version MariaDB (merci ChatGPT)
DELIMITER //

CREATE PROCEDURE prendreIngr(IN quantiteRetiree DECIMAL(10,2), IN nomIngrRecherche VARCHAR(255))
BEGIN
    DECLARE quantiteActuelle DECIMAL(10,2);

    -- On sélectionne la quantité actuelle de l'ingrédient
    SELECT stockIngredient INTO quantiteActuelle
    FROM Ingredient
    WHERE nomIngredient = nomIngrRecherche;

    -- cas où la quantité retirée est supérieure à la quantité actuelle
    IF (quantiteRetiree > quantiteActuelle) THEN
        UPDATE Ingredient SET stockIngredient = 0 WHERE nomIngredient = nomIngrRecherche;
    ELSE
        UPDATE Ingredient SET stockIngredient = (quantiteActuelle - quantiteRetiree) WHERE nomIngredient = nomIngrRecherche;
    END IF;
END //

DELIMITER;
