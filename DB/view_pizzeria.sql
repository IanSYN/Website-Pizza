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

CREATE OR REPLACE VIEW VPizzaioloCommande
AS
	(SELECT idCommande, nomProduit, nomTaille, nomIngredient, quantitePizza, quantiteIngredient*quantiteSupplement as qntProduitPizza FROM Pizza
	inner join Produit on Produit.idProduit = Pizza.idProduit
	inner join Taille on Taille.idTaille = Pizza.idTaille
	natural join Base
 	natural join Ingredient
	natural join PizzaPersonnalisee
	natural join Supplement
	GROUP BY idCommande, nomProduit, nomTaille, nomIngredient, quantitePizza, qntProduitPizza);


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
	(SELECT nomCategorie, nomProduit, coverProduit, prixProduit from Produit);
