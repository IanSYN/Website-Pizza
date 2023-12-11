<?php

class controlleurDefaut{

    public static function Afficher(){
        $title = static::$classe;
        $identifiant = static::$identifiant;
        require_once('../view/deb.html');
        require_once('../view/menu.html');
        $tableau = $title::getAll();
        require_once('../view/list.php');
    }
}
?>