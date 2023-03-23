<?php require_once "inc/header.inc.php"; ?>

<?php
// Restriction d'acces à la page si on est CONNECTE : 
if (userConnect()) {
    // redirection vers la page profil.php
    header('location:profil.php');
    exit;
}


// -------------------------------------
// INSCRIPTION & INSERTION

if ($_POST) {
    // debug($_POST);

    // Contrôles des saisies (il faudrait faire des controles pour tous les champs du formulaire)

    // controle de la taile du pseudo (3 à 15 caracteres) : 
    if (strlen($_POST['pseudo'])<=3 || strlen($_POST['pseudo'])>15) {
        $error .="<div> class'alert alert-danger'>Erreur taille pseudo (doit être compris entre 3 et 15)</div>";
    }

    // Tester si le pseudo est disponible : (On ne peut pas avoir 2 fois le même pseudo car nous avons une clé UNIQUE lors de la création de la BDD) : 

    $r = execute_requete("SELECT pseudo FROM membre WHERE pseudo = '$_POST[pseudo]' ");
    // selectionne moi le pseudo dans la table membre à condition que dans la colonne 'pseudo' ce soit égale à la saisie
        // debug($r->rowCount());

    if ($r->rowCount()>=1) {// compte le nombre de ligne, or il ne peut pas y avoir plusieurs ligne car pseudo unique
        $error .= "<div class='alert alert-danger'>Pseudo indisponible </div>";
    }

    // ---------------------------------------
    // Boucle sur toutes les saisies afin de les passer dans les fonctions htmlentities() et addslashes() : 
    foreach ($_POST as $indice => $valeur) {
        $_POST[$indice] = htmlentities( addslashes($valeur));
    }

    // ---------------------------------------
    // Cryptage du mdr : 
    $_POST['mdp'] = password_hash($_POST['mdp'],PASSWORD_DEFAULT);
        // password_hash() : permet de créer une clé de hachage
    
    // --------------------------------------
    // INSERTION
    if (empty($error)) {// Si la variable $error est vide (c'est que le formulaire à été correctement rempli)
        execute_requete(" INSERT INTO membre( pseudo, mdp, nom, prenom, email, sexe, adresse, ville, cp ) 
                                    VALUES( 
                                            '$_POST[pseudo]', 
                                            '$_POST[mdp]', 
                                            '$_POST[nom]', 
                                            '$_POST[prenom]', 
                                            '$_POST[email]', 
                                            '$_POST[sexe]', 
                                            '$_POST[adresse]', 
                                            '$_POST[ville]', 
                                            '$_POST[cp]' 
                                        ) 
                        ");

        $content .= "<div class='alert alert-success'> Inscription validée
                        <a href=' ".URL."connexion.php'> Cliquez ici pour vous connecter </a>
                    </div>";
    }
}

// --------------------------------------
?>

    <h1>Inscription</h1>

    <?php echo $error; ?>
    <?= $content; ?>

    <form method="post">
        <label>Pseudo</label><br>
        <input type="text" name="pseudo"><br>
        <label>Mot de Passe</label><br>
        <input type="text" name="mdp"><br>
        <label>Nom</label><br>
        <input type="text" name="nom"><br>
        <label>Prénom</label><br>
        <input type="text" name="prenom"><br>
        <label>Email</label><br>
        <input type="text" name="email"><br>
        <label>Civilité</label><br>
        <input type="radio" name="sexe" value="f" checked>Femme<br>
        <input type="radio" name="sexe" value="m">Homme<br><br>
        <label>Adresse</label><br>
        <input type="text" name="adresse"><br>
        <label>Ville</label><br>
        <input type="text" name="ville"><br>
        <label>Code Postal</label><br>
        <input type="text" name="cp"><br><br>
        <input type="submit" class="btn btn-secondary" value="S'inscrire">
    </form>



<?php require_once "inc/footer.inc.php"; ?>