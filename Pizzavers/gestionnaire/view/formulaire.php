<div class="Formulaire">
<form action="index.php?objet=produit&action=creerPizza" method="POST" enctype="multipart/form-data">
    <label for="nomProduit">Nom du produit:</label>
    <input type="text" name="nomProduit" id="nomProduit" required>

    <label for="prixProduit">Prix du produit:</label>
    <input type="number" name="prixProduit" id="prixProduit" required>

    <label for="coverProduit">Image du produit:</label>
    <input type="file" name="coverProduit" id="coverProduit" required>

    <input type="submit" name="boutonCreer" value="Ajouter le produit" style="cursor: pointer;" /> 
</form>
</div>
</body>