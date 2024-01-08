<?php
require_once('controller/controllerDefaut.php');
require_once('gestionnaire/model/Alerte.php');

class controllerAlerte extends controllerDefaut {
    protected static $classe = 'Alerte';
    
    public static function AfficherMesAlertes() {

        // On importe toutes les alertes du gestionnaire
        $tabAlertes = Alerte::getMesAlertes($_SESSION['idGestionnaire']);

        // On affiche
        include('gestionnaire/view/debGestionnaire.html');
        include('gestionnaire/view/menuGestionnaire.html');
        include('gestionnaire/view/Alerte/viewAlerte.php');
    }
}
?>