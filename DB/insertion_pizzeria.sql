INSERT INTO `Client`(`idClient`, `mailClient`, `mdpClient`, `nomClient`, `prenomClient`, `telClient`) VALUES
(1, 'alice.dubois@mail.com', 'mdpclient1', 'Dubois', 'Alice', '0781390645'),
(2, 'bob.lefevre@mail.com', 'mdpclient2', 'Lefevre', 'Bob', '0777664961'),
(3, 'claire.martin@mail.com', 'mdpclient3', 'Martin', 'Claire', '0771974892'),
(4, 'david.garcia@mail.com', 'mdpclient4', 'Garcia', 'David', '0798026891'),
(5, 'emma.moreau@mail.com', 'mdpclient5', 'Moreau', 'Emma', '0639547309'),
(6, 'fabrice.fournier@mail.com', 'mdpclient6', 'Fournier', 'Fabrice', '0608565297'),
(7, 'gaelle.girard@mail.com', 'mdpclient7', 'Girard', 'Gaelle', '0771196567'),
(8, 'hugo.caron@mail.com', 'mdpclient8', 'Caron', 'Hugo', '0637849894'),
(9, 'isabelle.roy@mail.com', 'mdpclient9', 'Roy', 'Isabelle', '0739854405'),
(10, 'julie.roux@mail.com', 'mdpclient10', 'Roux', 'Julie', '0630027927'),
(11, 'kevin.leroy@mail.com', 'mdpclient11', 'Leroy', 'Kevin', '0772668151'),
(12, 'laura.andre@mail.com', 'mdpclient12', 'Andre', 'Laura', '0746885652'),
(13, 'maxime.petit@mail.com', 'mdpclient13', 'Petit', 'Maxime', '0794209480'),
(14, 'nathalie.sanchez@mail.com', 'mdpclient14', 'Sanchez', 'Nathalie', '0798864293'),
(15, 'olivier.dupont@mail.com', 'mdpclient15', 'Dupont', 'Olivier', '0709180878');

INSERT INTO `Livreur`(`idLivreur`, `nomLivreur`, `prenomLivreur`, `telLivreur`)VALUES
(1,'Messaoudi','Sarah','0612345678'),
(2,'Boukhris','Yassine','0623456789'),
(3,'Dupont','Jean','0634567890'),
(4,'Martin','Sophie','0645678901'),
(5,'Lefevre','Pierre','0656789012'),
(6,'Garcia','Emma','0667890123'),
(7,'Moreau','Lucas','0678901234'),
(8,'Fournier','Camille','0689012345'),
(9,'Girard','Thomas','0690123456'),
(10,'Caron','Manon','0701234567'),
(11,'Roy','Nicolas','0712345678'),
(12,'Roux','Julie','0723456789'),
(13,'Leroy','Alexandre','0734567890'),
(14,'Andre','Laura','0745678901'),
(15,'Petit','Maxime','0756789012');

INSERT INTO `Allergene`(`idAllergene`, `nomAllergene`) VALUES
(1, 'Arachides'),
(2, 'Lactose'),
(3, 'Gluten'),
(4, 'Crustacés'),
(5, 'Soja'),
(6, 'Fruits à coque'),
(7, 'Oeufs'),
(8, 'Poisson'),
(9, 'Moutarde'),
(10, 'Sésame'),
(11, 'Acide citrique');

INSERT INTO `Taille` VALUES
(1, 'Medium'),
(2, 'Large'), -- 1.5x le medium
(3, 'XL'); -- 2x le medium

INSERT INTO `Coupon`(`codeCoupon`, `datePeremptionCoupon`, `idClient`) VALUES
('ABCD1234', '2023-12-31', 1),
('WXYZ5678', '2023-11-15', 3),
('EFGH9101', '2024-01-10', 5),
('JKLM2345', '2023-09-30', 7),
('QRST6789', '2023-12-25', 9);

INSERT INTO `Categorie` VALUES
(1, 'Dessert'),
(2, 'Boisson'),
(3, 'Pizza'),
(4, 'Petite faim');

INSERT INTO `EtatCommande` VALUES
(1, 'Attente de paiement'),
(2, 'En cuisine'),
(3, 'En attente de prise en charge'),
(4, 'En cours de livraison'),
(5, 'Livré');

INSERT INTO `Gestionnaire`(`idGestionnaire`, `mdpGestionnaire`, `mailGestionnaire`, `telGestionnaire`) VALUES
(1, 'mdpGest1', 'gest1@example.com', '0612345678'),
(2, 'mdpGest2', 'gest2@example.com', '0698765432'),
(3, 'mdpGest3', 'gest3@example.com', '0655555555');
(4, 'mdpGest4', 'sarahmy.messaoudi@gmail.com', '0625000000');

INSERT INTO `Adresse`(`idAdresse`, `numRue`, `nomRue`, `ville`, `codePostal`, `latitudeGPS`, `longitudeGPS`) VALUES
(1,13,'Avenue des sciences','Gif sur yvette','91190','48.711734','2.1705202'),
(2,25,'Rue de la Paix','Evry','91000','48.629080','2.441800'),
(3,8,'Rue du Commerce','Massy','91300','48.726620','2.274420'),
(4,42,'Avenue de la République','Palaiseau','91120','48.714170','2.245200'),
(5,17,'Rue des Lilas','Savigny-sur-Orge','91600','48.676670','2.350000'),
(6,9,'Avenue Jean Jaurès','Viry-Châtillon','91170','48.672220','2.383330'),
(7,3,'Rue de la Mairie','Athis-Mons','91200','48.707780','2.386110'),
(8,11,'Avenue de la Libération','Sainte-Geneviève-des-Bois','91700','48.637500','2.327780'),
(9,6,'Rue de la Gare','Longjumeau','91160','48.696670','2.308330'),
(10,19,'Avenue du Général de Gaulle','Brétigny-sur-Orge','91220','48.612500','2.315830'),
(11,7,'Rue des Écoles','Les Ulis','91940','48.682780','2.169440'),
(12,14,'Avenue Charles de Gaulle','Orsay','91400','48.697780','2.189440'),
(13,21,'Rue Victor Hugo','Morangis','91420','48.706670','2.336110'),
(14,4,'Avenue Gabriel Péri','Chilly-Mazarin','91380','48.705560','2.312500'),
(15,12,'Rue de la Poste','Vigneux-sur-Seine','91270','48.703330','2.416670');

INSERT INTO `MoyenPaiement` VALUES
(1, 'Carte'),
(2, 'Ticket restaurant'),
(2, 'Espèce'),
(3, 'Chèque'),
(4, 'Apple pay'),
(5, 'Google pay'),
(6, 'Paypal');

INSERT INTO `Produit` VALUES
(1, 'Margarita', 7, 'margarita.png', 3),
(2, 'Tiramisu', 1.50, 'tiramisu.png', 1),
(3, 'Coca cola', 1.50, 'cocacola.png', 2),
(4, '4 Nuggets', 5, 'nuggets.png', 4),
(5, 'Kinder bueno', 1.35, 'kinderbueno.png', 1),
(6, 'Saumon', 7, 'pizzaSaumon.png', 3),
(7, 'Quatres Fromages', 7, '4Fromages.png', 3),
(8, 'Savoyarde', 7, 'savoyarde.png', 3),
(9, 'Calzone', 7, 'calzone.png', 3),
(10, 'Salami', 7, 'salami.png', 3);

INSERT INTO `Ingredient`(`idIngredient`, `nomIngredient`, `stockIngredient`, `prixIngredient`, `coverIngredient`, `idAllergene`) VALUES
(1, 'Mozzarella', 1553, 0.99, 'mozzarella.png', 2),
(2, 'Parmesan reggiano', 758, 12, 'parmesanReggiano.png', 2),
(3, 'Huile d`olive', 57, 7, 'huileOlive.png', NULL),
(4, 'Basilic', 323, 0.70, 'basilic.png', NULL),
(5, 'Origan', 120, 0.80, 'origan.png', NULL),
(6, 'Saumon', 1205, 13, 'saumon.png', 8),
(7, 'Citron', 380, 2, 'citron.png', 11),
(8, 'Houmous', 540, 10, 'houmous.png', 10),
(9, 'Camembert', 1369, 5, 'camembert.png', 2),
(10, 'Chorizo', 978, 10, 'chorizo.png', 2),
(11, 'Olive verte', 640, 12, 'oliveV.png', NULL),
(12, 'Olive noire', 423, 30, 'oliveN.png', NULL);

INSERT INTO `Pizzeria` VALUES
(1, 1);

INSERT INTO `Pizza` VALUES
--Les 3 tailles de la Margarita (idP 1)
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
--Les 3 tailles de la Saumon (idP 6)
(4, 6, 1),
(5, 6, 2),
(6, 6, 3),
--Les 3 tailles de la Quatres Fromages (idP 7)
(7, 7, 1),
(8, 7, 2),
(9, 7, 3),
--Les 3 tailles de la Savoyarde (idP 8)
(10, 8, 1),
(11, 8, 2),
(12, 8, 3),
--Les 3 tailles de la Calzone (idP 9)
(13, 9, 1),
(14, 9, 2),
(15, 9, 3),
--Les 3 tailles de la Salami (idP 10)
(16, 10, 1),
(17, 10, 2),
(18, 10, 3);
  
INSERT INTO `Base` (`idPizza`, `idIngredient`, `quantiteIngredient`) VALUES
--les ingrédients de la Margarita (les 3 tailles)
(1, 1, 150),
(1, 2, 7),
(1, 3, 0.2),
(1, 4, 5),
(2, 1, 225),
(2, 2, 10.5),
(2, 3, 0.3),
(2, 4, 7.5),
(3, 1, 300),
(3, 2, 14),
(3, 3, 0.4),
(3, 4, 10);
--les ingrédients de la Saumon (les 3 tailles)
(4, 6, 200),
(4, 1, 250),
(4, 3, 0.2),
(4, 5, 5),
(4, 7, 55),
(5, 6, 300),
(5, 1, 375),
(5, 3, 0.3),
(5, 5, 7.5),
(5, 7, 82.5),
(6, 6, 400),
(6, 1, 500),
(6, 3, 0.4),
(6, 5, 10),
(6, 7, 110);


INSERT INTO `Alerte` VALUES
(1, 4, 450),
(2, 4, 300),
(3, 4, 55),
(4, 4, 200),
(5, 4, 100),
(6, 4, 500);










