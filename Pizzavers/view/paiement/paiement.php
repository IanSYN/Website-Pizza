<div class="Formulaire">
    <br>
    <h1>paiement</h1>
    <form action='index.php?objet=panier&action=payer' method='POST'>
        <label for="NCard">Numero de carte :</label>
        <input type="NCard" id="NCard" name="NCard" required><br><br>

        <label for="Crypto">Cryptogramme :</label>
        <input type="Crypto" id="Crypto" name="Crypto" required><br><br>

        <label for="Date"> Date de péremption (MM/YY):</label>
        <input type="text" id="Date" name="Date" required><br><br>

        <label for="Nom">Nom sur le compte :</label>
        <input type="text" id="Nom" name="Nom" required><br><br>

        <label for="tel">Adresse :</label>
        <input type="tel" id="adresse" name="adresse" required><br><br>
        <br>
        <input type="submit" name="boutonPayer" value="Payer" style="cursor: pointer;" /> 
    </form>
    <br>
</div>
</body>