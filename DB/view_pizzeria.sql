-- Cette vue permet d'afficher les produits du catalogue, avec leurs prix et leurs catégories
CREATE VIEW vCatalogue AS
    SELECT C.idCategorie, C.nomCategorie, P.nomProduit, P.prixProduit, P.coverProduit
    FROM `Categorie` C
    INNER JOIN `Produit` P ON C.idCategorie = P.idCategorie;
