<?php

session_start();// Création/ouverture de la session avent tout traitement php

// connexion a la BDD 
$pdo = new PDO('mysql:host=localhost;dbname=boutique','root','root',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));


// definition d'une constante :
define('URL', "http://localhost:8888/PHP/boutique/");

// definition de variables :
$content = ''; //variable prévue pour recevoir du contenu 
$error = '';// variable prévue pour recevoir les messages d'erreurs

// ------------------------------
// Inclusion des fonctions :
require_once "fonction.inc.php";

?>