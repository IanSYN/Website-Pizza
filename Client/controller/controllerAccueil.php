<?php
require_once('controllerDefaut.php');
require_once('model/Pizza.php');
class controllerAccueil extends controlleurDefaut{
    protected static $classe = 'Pizza';
    protected static $identifiant = 'idPizza';
}
?>