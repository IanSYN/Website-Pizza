-- Cette vue permet d'afficher les produits du catalogue, avec leurs prix et leurs catégories
CREATE OR REPLACE VIEW VCatalogue AS
    SELECT C.idCategorie, C.nomCategorie, P.nomProduit, P.prixProduit, P.coverProduit
    FROM `Categorie` C
    INNER JOIN `Produit` P ON C.idCategorie = P.idCategorie;

CREATE OR REPLACE VIEW VPizza 
AS 
	(SELECT Pizza.idPizza, nomProduit, nomTaille, coverProduit FROM Pizza
	inner join Produit on Produit.idProduit = Pizza.idProduit
	inner join Taille on Taille.idTaille = Pizza.idTaille
	GROUP BY Pizza.idPizza, nomProduit, nomTaille);

CREATE OR REPLACE VIEW VStatGlobal 
AS 
	(SELECT count(*) as nbrCommande, SUM(prixTotalCommande) as CATotal from `Commande`);


CREATE OR REPLACE VIEW VStatJournee 
AS 
	(SELECT count(*) as nbrCommande, SUM(prixTotalCommande) as CATotal from `Commande`
	where dateCommande = SYSDATE());


CREATE OR REPLACE VIEW VStatSemaine
AS 
	(SELECT count(*) as nbrCommande, SUM(prixTotalCommande) as CATotal from `Commande`
	where dateCommande = WEEK(SYSDATE()));


CREATE OR REPLACE VIEW VStatMois
AS 
	(SELECT count(*) as nbrCommande, SUM(prixTotalCommande) as CATotal from `Commande`
	where dateCommande = MONTH(SYSDATE()));



/*CREATE OR REPLACE VIEW VPizzaioloCommande
AS
	(SELECT idCommande, nomProduit, nomTaille, nomIngredient, quantitePizza, quantiteIngredient*quantiteSupplement as qntProduitPizza FROM Pizza
	inner join Produit on Produit.idProduit = Pizza.idProduit
	inner join Taille on Taille.idTaille = Pizza.idTaille
	natural join Base
 	natural join Ingredient
	natural join PizzaPersonnalisee
	natural join Supplement
	GROUP BY idCommande, nomProduit, nomTaille, nomIngredient, quantitePizza, qntProduitPizza);
*/

CREATE OR REPLACE VIEW VStockIngr
AS 
	(SELECT idIngredient, nomIngredient, stockIngredient, coverIngredient
	FROM Ingredient);


CREATE OR REPLACE VIEW VAllergenePizza
AS 
	(SELECT DISTINCT A.idAllergene, idPizza, nomAllergene
	FROM Allergene A
	INNER JOIN Ingredient I on I.idAllergene = A.idAllergene
	INNER JOIN Base B on B.idIngredient = I.idIngredient);


CREATE OR REPLACE VIEW VIngrPersonnalisee
AS 
	(SELECT S.idPizzaPersonnalisee, nomIngredient, prixIngredient, quantiteIngredient, quantiteSupplement, S.idIngredient
	FROM Supplement S
	INNER JOIN Ingredient I on I.idIngredient = S.idIngredient
    	INNER JOIN Base B on B.idIngredient = I.idIngredient
	INNER JOIN PizzaPersonnalisee PP on PP.idPizzaPersonnalisee = S.idPizzaPersonnalisee);


CREATE OR REPLACE VIEW VIngrBase
AS 
	(SELECT P.idPizza, P.idProduit, P.idTaille, B.idIngredient, nomIngredient, quantiteIngredient, coverIngredient
	FROM Pizza P
	INNER JOIN Base B on B.idPizza = P.idPizza
   	INNER JOIN Ingredient I on I.idIngredient = B.idIngredient);


CREATE OR REPLACE VIEW VPizzaIngr
AS
	(SELECT nomProduit, nomIngredient, nomTaille, coverIngredient, nomAllergene, prixProduit from Ingredient
	natural join Allergene 
	inner join Base on Base.idIngredient = Ingredient.idIngredient
	inner join Pizza on Pizza.idPizza = Base.idPizza
	inner join Taille on Taille.idTaille = Pizza.idTaille
	inner join Produit on Produit.idProduit = Pizza.idProduit
	GROUP BY nomProduit, nomIngredient, nomTaille, coverIngredient, nomAllergene, prixProduit);

CREATE OR REPLACE VIEW VPanier 
AS
	(SELECT C.idCommande, nomProduit, quantiteProduit, E.idEtatCommande, C.idClient, prenomClient, prixTotalCommande
	FROM `Commande` C
	INNER JOIN `EtatCommande` E ON E.idEtatCommande = C.idEtatCommande
	INNER JOIN `Client` Cl ON Cl.idClient = C.idClient
	INNER JOIN `Panier` P ON P.idCommande = C.idCommande
	INNER JOIN `Produit` Pr ON Pr.idProduit = P.idProduit);


CREATE OR REPLACE VIEW VPanierPizza
AS
	(SELECT C.idCommande, nomProduit, quantitePizza, idEtatCommande, C.idClient, prenomClient, prixTotalCommande
	FROM `Commande` C
	INNER JOIN `Client` Cl ON Cl.idClient = C.idClient
	INNER JOIN `PizzaPersonnalisee` Pp ON Pp.idCommande = C.idCommande
	INNER JOIN `Pizza` P ON P.idPizza = Pp.idPizza
	INNER JOIN `Produit` Pr ON Pr.idProduit = P.idProduit);


--pas bonne--
CREATE OR REPLACE VIEW VPanierGlobal
AS 
	(SELECT DISTINCT C.idCommande, Pr.nomProduit, quantiteProduit, quantitePizza, C.idClient, prenomClient, prixTotalCommande
	FROM `Commande` C
	INNER JOIN `Client` Cl ON Cl.idClient = C.idClient
    	INNER JOIN `Panier` Pa ON Pa.idCommande = C.idCommande
   	INNER JOIN `Produit` Pro ON Pro.idProduit = Pa.idProduit
	INNER JOIN `PizzaPersonnalisee` Pp ON Pp.idCommande = C.idCommande
	INNER JOIN `Pizza` P ON P.idPizza = Pp.idPizza
	INNER JOIN `Produit` Pr ON Pr.idProduit = P.idProduit);


CREATE OR REPLACE VIEW VPCommande
AS
	(SELECT idCommande, nomProduit, nomTaille, quantitePizza, quantiteIngredient*quantiteSupplement as qntProduitPizza FROM Pizza
	inner join Produit on Produit.idProduit = Pizza.idProduit
	inner join Taille on Taille.idTaille = Pizza.idTaille
	natural join Base
 	natural join Ingredient
	natural join PizzaPersonnalisee
	natural join Supplement);


CREATE OR REPLACE VIEW VCommande
AS
	(SELECT c.idCommande, idProduit, idPizzaPersonnalisee, quantiteProduit, quantitePizza From Commande c
    	inner join Panier p on p.idCommande = c.idCommande
	left join  PizzaPersonnalisee pp on pp.idCommande = c.idCommande
   	 union  SELECT c.idCommande, idProduit, idPizzaPersonnalisee, quantiteProduit, quantitePizza From Commande c
   	 inner join Panier p on p.idCommande = c.idCommande
	right join PizzaPersonnalisee pp on pp.idCommande = c.idCommande
    	group by idCommande);


CREATE OR REPLACE VIEW VPizzaPersonnalisee
AS 
	(SELECT pp.idPizzaPersonnalisee, idPizza, idCommande, idIngredient, quantitePizza, quantiteSupplement  from PizzaPersonnalisee pp
	inner join Supplement s on s.idPizzaPersonnalisee = pp.idPizzaPersonnalisee
	group by pp.idPizzaPersonnalisee, idPizza, idCommande, idIngredient, quantitePizza);
