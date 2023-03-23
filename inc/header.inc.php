<?php require_once "init.inc.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon site</title>

    <!-- CDN CSS BOOTSTRAP -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CDN FONT AWESOME-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- CSS PERSO -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo URL ?>index1.php">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?php echo URL ?>index1.php">Accueil</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="<?= URL ?>panier.php">Panier</a>
                </li>

                <?php if (!userConnect()) : // si l'utilisateur n'est pas connecte alors affiche les liens suivant ?>


                <li class="nav-item">
                <a class="nav-link" href="<?php echo URL ?>inscription.php">Inscription</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?= URL ?>connexion.php">Connexion</a>
                </li>

                <?php else : // sinon c'est que l'utilisateur est connecté, affiche les liens suivant ?>

                <li class="nav-item">
                <a class="nav-link" href="<?= URL ?>profil.php">Profil</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?= URL ?>connexion.php?action=deconnexion">Deconnexion</a>
                <!-- la deconexion se fera sur le fichier connexion.php -->
                </li>

                <?php endif; // fermeture du else ?>
                <?php if (adminConnect()) : // si admin connecté ?>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Backoffice
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/gestion_produit.php">gestion produit</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/gestion_membre.php">gestion membre</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/gestion_commande.php">gestion commande</a></li>
                </ul>
                </li>

                <?php endif; ?>

                

            </ul>
            </div>
        </div>
    </nav>

    <div class="container">