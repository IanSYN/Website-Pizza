/*<?php
    $destinataire = $argv[1];
    $expediteur = $argv[2];
    $objet = $argv[3];
    $texte = $argv[4];

    mail($destinataire, $objet, $texte ,$expediteur);
?>*/

<?php
$to = "sarahmy.messaoudi@gmail.com";
$subject = "Test Email";
$message = "This is a test email.";

$headers = "From: sarahmy.messaoudi@gmail.com\r\n";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}
?>
