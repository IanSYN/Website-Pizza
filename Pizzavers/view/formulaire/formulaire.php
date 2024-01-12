<div class="Formulaire">
    <br>
    <h1>Inscription</h1>
    <form action="index.php?objet=connexion&action=inscription" method="POST">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="tel">Téléphone :</label>
        <input type="tel" id="tel" name="tel" required><br><br>

        <br>
        <input type="submit" name="boutonSinscrire" value="S'inscrire" style="cursor: pointer;" /> 
    </form>
    <br>
</div>