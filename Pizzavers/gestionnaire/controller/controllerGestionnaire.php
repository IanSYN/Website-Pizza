<?php
require_once('controller/controllerDefaut.php');
require_once('model/Gestionnaire.php');
require_once('model/session.php');
require_once('model/VstatistiqueGlobal.php');
require_once('model/VstatistiqueMensuel.php');
require_once('model/VstatistiqueHebdomadaire.php');
require_once('model/VstatistiqueJournalier.php');

class controllerGestionnaire extends controllerDefaut {
    protected static $classe = 'Gestionnaire';
    protected static $identifiant = 'idGestionnaire';

    public static function estUnCompte(string $email, string $mdp) {

        // On récupère le compte Gestionnaire associé à cette adresse mail
        $compte = Gestionnaire::getOne($email);

        // Cas où le compte n'a pas été trouvé dans la base de données
        if ($compte == null)
            return false;

        // Cas où le compte a été trouvé
        else {
            if ($compte->get('mdpGestionnaire') == $mdp) 
                return true; // mot de passe correct
            else 
                return false; // mot de passe incorrect
        }
    }

    public static function AfficherAccueilGestionnaire() {
        $StatGlobal = VstatistiqueGlobal::getStat();
        $StatMensuel = VstatistiqueMensuel::getStat();
        $Stathebdo = VstatistiqueHebdomadaire::getStat();
        $Statjour = VstatistiqueJournalier::getStat();
        include('gestionnaire/view/debGestionnaire.html');
        include('gestionnaire/view/menuGestionnaire.html');
        include('gestionnaire/view/accueilGestionnaire.php');
    }

    public static function AfficherMonCompte() {
        // On récupère le compte du gestionnaire à partir 
        // de l'adresse mail spécifiée dans $_SESSION
        $email = $_SESSION['email'];
        $gest = Gestionnaire::getOne($email); 

        include('gestionnaire/view/debGestionnaire.html');
        include('gestionnaire/view/menuGestionnaire.html');
        include('gestionnaire/view/viewMonCompte.php');
    }
}

?>