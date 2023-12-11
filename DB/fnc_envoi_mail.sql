DELIMITER //

CREATE FUNCTION ENVOI_EMAIL(dest VARCHAR(100), exp VARCHAR(100), objet VARCHAR(100), contenu VARCHAR(100))
RETURNS BOOLEAN
BEGIN

    DECLARE success BOOLEAN DEFAULT FALSE; -- On met par défaut FALSE 

    DECLARE cmd VARCHAR(255); -- Contiendra la commande pour envoyer le mail
    SET cmd = CONCAT('php /pizzavers/config/send_email.php "', dest, '" "', exp, '" "', objet, '" "', contenu, '"'); -- On exécute la commande avec les arguments
    SET success = sys_exec(cmd);

    RETURN success;
END //

DELIMITER ;
