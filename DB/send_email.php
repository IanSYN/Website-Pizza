<?php
    $destinataire = $argv[1];
    $expediteur = $argv[2];
    $objet = $argv[3];
    $texte = $argv[4];

    mail($destinataire, $objet, $texte ,$expediteur);
?>