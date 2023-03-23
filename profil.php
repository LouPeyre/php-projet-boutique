<?php require_once "inc/header.inc.php"; ?>
<?php 
// restriction d'accès à la page : si utilisateur PAS connecte
if (!userConnect()) {
    // redirection vers la page connexion.php
    header('location:connexion.php');
    exit;
}
// ---------------------------------------
// Si l'ADMIN est connecté, on affiche un titre pour le préciser
if (adminConnect()) {
    $content .= "<h2 style='color:tomato;'> ADMINISTRATEUR </h2>";
}

// ---------------------------------------

// debug($_SESSION);

// Ici , on récupere le pseudo de la personne connecté grâce au fichier de session que l'on a remplit lors de la connexion et on l'affiche
$pseudo = $_SESSION['membre']['pseudo'];

$content .= "<h3>Vos infos personnelles</h3>";
$content .= "<p>Votre prénom : ". $_SESSION['membre']['prenom']."</p>";
// ici, utilisation de la concaténation car tableau multidimentionnel
$content .= "<p>Votre nom : ". $_SESSION['membre']['nom']."</p>";

$content .= "<p>Votre email : ". $_SESSION['membre']['email']."</p>";

$content .= "<p>Votre adresse : ". $_SESSION['membre']['adresse']." ".$_SESSION['membre']['cp']." ".$_SESSION['membre']['ville']."</p>";


// ---------------------------------------

?>

    <h1>Profil</h1>

    <h2>Bonjour <?= $pseudo ?></h2>

    <?php echo $content; ?>


<?php require_once "inc/footer.inc.php"; ?>


