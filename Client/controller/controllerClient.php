<?php
require_once('controllerDefaut.php');
require_once('model/Client.php');
require_once('model/session.php');

class controllerClient extends controllerDefaut {
    protected static $classe = 'Client';
    protected static $identifiant = 'idClient';

    public static function estUnCompte(string $email, string $mdp) {

        // On récupère le compte Gestionnaire associé à cette adresse mail
        $compte = Client::getOne($email);

        // Cas où le compte n'a pas été trouvé dans la base de données
        if ($compte == null)
            return false;

        // Cas où le compte a été trouvé
        else {
            if ($compte->get('mdpClient') == $mdp) 
                return true; // mot de passe correct
            else 
                return false; // mot de passe incorrect
        }
    }
}