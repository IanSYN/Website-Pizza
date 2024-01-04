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

    /*
    public static function urlMenu() {
        // cas d'un admin connecté
        if (self::adminConnected()) {
            return "view/menuAdmin.php";
        }
        // cas d'un adhérent connecté
        if (self::adherentConnected()) {
            return "view/menuAdherent.php";
        }

    }

    public static function urlList() {
        // cas d'un admin connecté
        if (self::adminConnected()) {
            return "view/listAdmin.php";
        }
        // cas d'un adhérent connecté
        if (self::adherentConnected()) {
            return "view/listAdherent.php";
        }
    }
    */
}
?>