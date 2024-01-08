<?php
require_once('controllerDefaut.php');
require_once('controllerGestionnaire.php');
require_once('controllerClient.php');

class controllerConnexion extends controllerDefaut {

    // Fonction affichant la page de connexion
    // Prend en paramètre un booléen qui indique
    // s'il faut afficher le message d'erreur
    public static function AfficherConnexion($erreur = false){

        // Affichage avec erreur
        if($erreur) {
            require_once('view/connexion/debutConnexion.html');
            require_once('view/menu.php');
            require_once('view/connexion/frmConnexion_erreur.html');
            require_once('view/fin.html');            
        }
        
        // Affichage sans erreur
        else {
            require_once('view/connexion/debutConnexion.html');
            require_once('view/menu.php');
            require_once('view/connexion/frmConnexion.html');
            require_once('view/fin.html');
        }

    }

    public static function AfficherInscription($erreur = false){
        require_once('view/formulaire/debFormulaire.php');
        require_once('view/menu.php');
        require_once('view/formulaire/formulaire.php');
        require_once('view/fin.html');

    }

    // Fonction qui initialise une connexion
    // si le login et mdp sont corrects,
    // que ce soit pour un client ou un gestionnaire
    public static function Connect() {
        
        // Si l'adresse e-mail et le mot de passe sont spécifiés
        if (isset($_POST['email']) && isset($_POST['mdp'])) {

            $email = $_POST['email'];
            $mdp = $_POST['mdp'];

            // Vérification de l'authenticité des données
            if (controllerGestionnaire::estUnCompte($email, $mdp)) {

                // Récupération du gestionnaire en question
                $gestionnaire = Gestionnaire::getOne($email);

                // Paramétrage de $_SESSION
                $_SESSION["email"] = $email;
                $_SESSION["idGestionnaire"] = $gestionnaire->get("idGestionnaire");
                $_SESSION["compte"] = "gestionnaire";
                
                header("Location:index.php"); // On redirige le gestionnaire vers sa page d'accueil
            }
            elseif (controllerClient::estUnCompte($email, $mdp)) {
                
                // Récupération du client en question
                $client = Client::getOne($email);

                // Paramétrage de $_SESSION
                $_SESSION["email"] = $email;
                $_SESSION["idClient"] = $client->get("idClient");
                $_SESSION["prenom"] = $client->get("prenomClient");
                $_SESSION["nom"] = $client->get("nomClient");
                $_SESSION["compte"] = "client";

                header("Location:index.php"); // On redirige la personne vers l'accueil
            }
            else {
                // Affichage de la page de connexion avec erreur
                self::AfficherConnexion(true);
            }
        }
        else {
            self::AfficherConnexion();
        }
    }

    public static function Disconnect() {
        session_unset(); // On vide le tableau $_SESSION
        session_destroy(); // On supprime le fichier de données de la session
                           // stocké dans le serveur
        setcookie(session_name(), '', time()-1); // Demande à la machine cliente de 
                                                 // supprimer le cookie de session

        // On revient à la fonction d'affichage d'accueil
        header("Location:index.php"); // On redirige la personne vers l'accueil
    }

    public static function Inscription() {
        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['tel'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $tel = $_POST['tel'];
            if (Client::creationClient($email, $password, $nom, $prenom, $tel)) {
                self::Connect();
            }
            else {
                self::AfficherInscription(true);
            }
        }
    }
}    
?>