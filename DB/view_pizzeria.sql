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

CREATE OR REPLACE VIEW VPizzaIngr
AS
	(SELECT nomProduit, nomIngredient, nomTaille, coverIngredient, nomAllergene, prixProduit from Ingredient
	natural join Allergene 
	inner join Base on Base.idIngredient = Ingredient.idIngredient
	inner join Pizza on Pizza.idPizza = Base.idPizza
	inner join Taille on Taille.idTaille = Pizza.idTaille
	inner join Produit on Produit.idProduit = Pizza.idProduit
	GROUP BY nomProduit, nomIngredient, nomTaille, coverIngredient, nomAllergene, prixProduit);


CREATE OR REPLACE VIEW VProduit 
AS
	(SELECT idProduit, nomCategorie, nomProduit, coverProduit, prixProduit 
	FROM `Produit` P
	INNER JOIN `Categorie` C ON P.idCategorie = C.idCategorie);


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

CREATE OR REPLACE VIEW VPanierGlobal
AS 
	(SELECT idProduit, idPizzaPersonnalisee, quantiteProduit, quantitePizza from Panier p
	natural join Commande c 
	inner join PizzaPersonnalisee pp on pp.idCommande = c.idCommande
	group by idProduit, idPizzaPersonnalisee, quantiteProduit, quantitePizza);

CREATE OR REPLACE VIEW VPizzaPersonnalisee
AS 
	(SELECT idPizzaPersonnalisee, idPizza, idCommande, idIngredient, quantitePizza  from PizzaPersonnalisee pp
	inner join supplement s on s.idPizzaPersonnalisee = pp.idPizzaPersonnalisee
	group by idPizzaPersonnalisee, idPizza, idCommande, idIngredient, quantitePizza);
