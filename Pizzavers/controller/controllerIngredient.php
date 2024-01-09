<?php
require_once('controllerDefaut.php');
require_once('model/Ingredient.php');
require_once('model/unProd.php'); 
require_once('model/VIngrPersonnalisee');

class controllerIngredient extends controllerDefaut {
    protected static string $classe = "Ingredient";
    protected static string $identifiant = "idIngredient";
    
}