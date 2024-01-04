CREATE TABLE `Client`(
   `idClient` INT(11) NOT NULL AUTO_INCREMENT,
   `mailClient` VARCHAR(50)  NOT NULL,
   `mdpClient` VARCHAR(50)  NOT NULL,
   `nomClient` VARCHAR(50)  NOT NULL,
   `prenomClient` VARCHAR(50)  NOT NULL,
   `telClient` VARCHAR(16)  NOT NULL,
   PRIMARY KEY(`idClient`),
   UNIQUE(`mailClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Livreur`(
   `idLivreur` INT(11) NOT NULL AUTO_INCREMENT,
   `nomLivreur` VARCHAR(50)  NOT NULL,
   `prenomLivreur` VARCHAR(50)  NOT NULL,
   `telLivreur` INT(11) NOT NULL,
   PRIMARY KEY(`idLivreur`),
   UNIQUE(`telLivreur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Allergene`(
   `idAllergene` INT(11) NOT NULL AUTO_INCREMENT,
   `nomAllergene` VARCHAR(50)  NOT NULL,
   PRIMARY KEY(`idAllergene`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Taille`(
   `idTaille` INT(11) NOT NULL AUTO_INCREMENT,
   `nomTaille` VARCHAR(50)  NOT NULL CHECK (nomTaille in ('Medium', 'Large', 'XL')),
   PRIMARY KEY(`idTaille`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Coupon`(
   `codeCoupon` CHAR(8), -- Le code coupon contient strictement 8 caractères
   `datePeremptionCoupon` DATE NOT NULL,
   `idClient` INT(11) NOT NULL,
   PRIMARY KEY(`codeCoupon`),
   FOREIGN KEY(`idClient`) REFERENCES `Client`(`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Categorie`(
   `idCategorie` INT(11) NOT NULL AUTO_INCREMENT,
   `nomCategorie` VARCHAR(50)  NOT NULL CHECK (`nomCategorie` in ('Dessert','Boisson','Pizza','Petite faim')),
   PRIMARY KEY(`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `EtatCommande`(
   `idEtatCommande` INT(11) NOT NULL AUTO_INCREMENT,
   `nomEtatCommande` VARCHAR(50)  NOT NULL CHECK (nomEtatCommande in ('Attente de paiement', 'En cuisine', 'En attente de prise en charge', 'En cours de livraison', 'Livré')),
   PRIMARY KEY(`idEtatCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Gestionnaire`(
   `idGestionnaire` INT(11) NOT NULL AUTO_INCREMENT,
   `mdpGestionnaire` VARCHAR(50)  NOT NULL,
   `mailGestionnaire` VARCHAR(50)  NOT NULL,
   `telGestionnaire` VARCHAR(16)  NOT NULL,
   PRIMARY KEY(`idGestionnaire`),
   UNIQUE(`mailGestionnaire`),
   UNIQUE(`telGestionnaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Adresse`(
   `idAdresse` INT(11) NOT NULL AUTO_INCREMENT,
   `numRue` INT(11) NOT NULL,
   `nomRue` VARCHAR(75)  NOT NULL,
   `ville` VARCHAR(50)  NOT NULL,
   `codePostal` CHAR(5)  NOT NULL,
   `latitudeGPS` VARCHAR(12) ,
   `longitudeGPS` VARCHAR(12) ,
   PRIMARY KEY(`idAdresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `MoyenPaiement`(
   `idMoyenPaiement` INT(11) NOT NULL AUTO_INCREMENT,
   `nomMoyenPaiement` VARCHAR(50) NOT NULL CHECK (nomMoyenPaiement in ('Carte', 'Espèce', 'Chèque', 'Apple pay', 'Google pay', 'Paypal', 'Ticket restaurant')),
   PRIMARY KEY(`idMoyenPaiement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Commande`(
   `idCommande` INT(11) NOT NULL AUTO_INCREMENT,
   `dateCommande` DATETIME NOT NULL,
   `prixTotalCommande` DECIMAL(15,2)   NOT NULL,
   `idMoyenPaiement` INT(11) NOT NULL,
   `idAdresse` INT(11),
   `idEtatCommande` INT(11) NOT NULL,
   `codeCoupon` CHAR(8) ,
   `idClient` INT(11),
   PRIMARY KEY(`idCommande`),
   UNIQUE(`codeCoupon`),
   FOREIGN KEY(`idMoyenPaiement`) REFERENCES `MoyenPaiement`(`idMoyenPaiement`),
   FOREIGN KEY(`idAdresse`) REFERENCES `Adresse`(`idAdresse`),
   FOREIGN KEY(`idEtatCommande`) REFERENCES `EtatCommande`(`idEtatCommande`),
   FOREIGN KEY(`codeCoupon`) REFERENCES `Coupon`(`codeCoupon`),
   FOREIGN KEY(`idClient`) REFERENCES `Client`(`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Produit`(
   `idProduit` INT(11) NOT NULL AUTO_INCREMENT,
   `nomProduit` VARCHAR(50)  NOT NULL,
   `prixProduit` DECIMAL(15,2)   NOT NULL,
   `coverProduit` VARCHAR(50)  NOT NULL,
   `AlAffiche` TINYINT(4) NOT NULL DEFAULT 0,
   `idCategorie` INT(11) NOT NULL,
   PRIMARY KEY(`idProduit`),
   FOREIGN KEY(`idCategorie`) REFERENCES `Categorie`(`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Ingredient`(
   `idIngredient` INT(11) NOT NULL AUTO_INCREMENT,
   `nomIngredient` VARCHAR(50)  NOT NULL,
   `stockIngredient` DECIMAL(10,2)   NOT NULL,
   `prixIngredient` DECIMAL(10,2)   NOT NULL,
   `coverIngredient` VARCHAR(50)  NOT NULL,
   `idAllergene` INT(11),
   PRIMARY KEY(`idIngredient`),
   FOREIGN KEY(`idAllergene`) REFERENCES `Allergene`(`idAllergene`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Livraison`(
   `idLivraison` INT(11) NOT NULL AUTO_INCREMENT,
   `heureLivraison` DATETIME NOT NULL,
   `idCommande` INT(11) NOT NULL,
   `idLivreur` INT(11) NOT NULL,
   PRIMARY KEY(`idLivraison`),
   FOREIGN KEY(`idCommande`) REFERENCES `Commande`(`idCommande`),
   FOREIGN KEY(`idLivreur`) REFERENCES `Livreur`(`idLivreur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Pizzeria`(
   `idPizzeria` INT(11) NOT NULL AUTO_INCREMENT,
   `idAdresse` INT(11) NOT NULL,
   PRIMARY KEY(`idPizzeria`),
   UNIQUE(`idAdresse`),
   FOREIGN KEY(`idAdresse`) REFERENCES `Adresse`(`idAdresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Pizza`(
   `idPizza` INT(11) NOT NULL AUTO_INCREMENT,
   `idProduit` INT(11) NOT NULL,
   `idTaille` INT(11) NOT NULL,
   PRIMARY KEY(`idPizza`),
   FOREIGN KEY(`idProduit`) REFERENCES `Produit`(`idProduit`),
   FOREIGN KEY(`idTaille`) REFERENCES `Taille`(`idTaille`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `PizzaPersonnalisee`(
   `idPizzaPersonnalisee` INT(11) NOT NULL,
   `quantitePizza` INT(11) NOT NULL,
   `idPizza` INT(11),
   `idCommande` INT(11),
   PRIMARY KEY(`idPizzaPersonnalisee`),
   FOREIGN KEY(`idPizza`) REFERENCES `Pizza`(`idPizza`),
   FOREIGN KEY(`idCommande`) REFERENCES `Commande`(`idCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Panier`(
   `idCommande` INT(11),
   `idProduit` INT(11),
   `quantiteProduit` INT(11) NOT NULL CHECK (quantiteProduit > 0),
   PRIMARY KEY(`idCommande`, `idProduit`),
   FOREIGN KEY(`idCommande`) REFERENCES `Commande`(`idCommande`),
   FOREIGN KEY(`idProduit`) REFERENCES `Produit`(`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Base`(
   `idPizza` INT(11),
   `idIngredient` INT(11),
   `quantiteIngredient` VARCHAR(50)  NOT NULL,
   PRIMARY KEY(`idPizza`, `idIngredient`),
   FOREIGN KEY(`idPizza`) REFERENCES `Pizza`(`idPizza`),
   FOREIGN KEY(`idIngredient`) REFERENCES `Ingredient`(`idIngredient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Supplement`(
   `idIngredient` INT(11),
   `idPizza` INT(11),
   `idCommande` INT(11),
   `idPizzaPersonnalisee` INT(11),
   `quantiteSupplement` VARCHAR(50) CHECK (quantiteSupplement >= 0),
   PRIMARY KEY(`idIngredient`, `idPizzaPersonnalisee`),
   FOREIGN KEY(`idIngredient`) REFERENCES `Ingredient`(`idIngredient`),
   FOREIGN KEY( `idPizzaPersonnalisee`) REFERENCES `PizzaPersonnalisee`(`idPizzaPersonnalisee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Alerte`(
   `idIngredient` INT(11),
   `idGestionnaire` INT(11),
   `seuilIngredient` INT(11) CHECK (seuilIngredient >= 0),
   `verifSeuil` BOOL,
   PRIMARY KEY(`idIngredient`, `idGestionnaire`),
   FOREIGN KEY(`idIngredient`) REFERENCES `Ingredient`(`idIngredient`),
   FOREIGN KEY(`idGestionnaire`) REFERENCES `Gestionnaire`(`idGestionnaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
