<?php
require_once('controllerDefaut.php');
class controllerInfo extends controllerDefaut{
    public static function AfficherPage(){
        require_once('view/info/debInfo.html');
        require_once('view/menu.php');
        require_once('view/info/info.html');
        require_once('view/fin.html');
    }
}
?>