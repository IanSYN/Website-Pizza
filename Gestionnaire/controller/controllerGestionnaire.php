<?php
require_once('controllerDefaut.php');
require_once('model/Gestionnaire.php');

class controllerGestionnaire extends controllerDefaut {
    protected static $classe = 'Gestionnaire';
    protected static $identifiant = 'idGestionnaire';

    public static function estUnCompte(string $email, string $mdp) {

        // On récupère le compte Gestionnaire associé à cette adresse mail
        $compte = Gestionnaire::getOne($email);

        // Cas où le compte n'a pas été trouvé dans la base de données
        if ($compte === null)
            return false;

        // Cas où le compte a été trouvé
        else {
            if ($compte->get('mdpGestionnaire') == $mdp) 
                return true; // mot de passe correct
            else 
                return false; // mot de passe incorrect
        }
    }
}