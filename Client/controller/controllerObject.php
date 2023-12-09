<?php
require_once('../model/pizza.php');
class controllerObject {
    public static function displayAll(){
        $title = "Les " . static::$classe;
        $identifiant = static::$identifiant;
        $classe = static::$classe;
        require_once('../index.html');
        require_once('../view/menu.html');
        $tableau = $classe::getAll();
        require_once('../view/enAvant.php');
        //require_once('../view/list.php');
        //require_once('../view/fin.php');
    }

    public static function displayOne(){
        $title = "un(e) " . static::$classe;
        $id = $_GET[static::$identifiant];
        $classe = static::$classe;
        require_once('../view/debut.php');
        require_once('../view/menu.html');
        $tableau = $classe::getOne($id);
        require_once('../view/detail.php');
        require_once('../view/fin.php');
    }

    public static function delete(){
        $id = $_GET[static::$identifiant];
        $classe = static::$classe;
        $classe::delete($id);
        self::displayAll();
    }
}
?>