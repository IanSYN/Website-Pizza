<?php
class session {
    public static function clientConnected() {
        return (isset($_SESSION["email"]) && isset($_SESSION["compte"]) && ($_SESSION["compte"] == "client"));
    }

    public static function gestionnaireConnected() {
        return (isset($_SESSION["email"]) && isset($_SESSION["compte"]) && ($_SESSION["compte"] == "gestionnaire"));
    }

    public static function connecting() {
        return (isset($_GET["action"]) && ($_GET["action"] == "connect"));
    }

    
}
?>