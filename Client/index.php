<?php

$objet = "pizza";

$controller = "controller".ucfirst($objet);
require_once ("controller/$controller.php");

require_once ("view/deb.html");
require_once ("view/menu.html");

require_once ("config/connexion.php");
connexion::connect();
$controller::displayAll();

?>