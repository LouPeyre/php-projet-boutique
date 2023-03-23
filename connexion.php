<?php require_once "inc/header.inc.php"; ?>
<?php

// DECONNEXION : le script de la deconnexion se positionne AVANT la redirection/restriction sinon elle ne sera JAMAIS interprété par l'interpretateur php à cause du exit qui fait quitté le fichier.
// debug($_GET);

if (isset($_GET['action'])&& $_GET['action']=="deconnexion") {
    // si il existe une 'action' et que cette action est égale à "deconnexion" alors : 
    session_destroy();// detruit le fichier session
    // unset($_SESSION['membre']); // supprimera la session/membre (et donc entrainera la deco)
}
// -----------------------------------
// restriction d'acces à la page
if (userConnect()) {
    header('location:profil.php');
    exit;
}


// -----------------------------------

if ($_POST) {
    // debug($_POST);

    // comparaison du pseudo posté et celui de la BDD
    $r = execute_requete("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]' ");// récupération de toutes les infos à condition que dans la colonne Pseudo soit égale à la saisie de l'internaute
    // debug($r);
    if ($r->rowCount() >=1) {// si il y a une ligne de resultat ($r sera égale à 1 ) DONC une correspondance avec la BDD
        
        // si correspondance avec pseudo alors on teste le mdp
        // recupération des données pour les exploiter
        $membre = $r->fetch(PDO::FETCH_ASSOC);
            // debug($membre);
        // Verif du mot de passe
        if (password_verify($_POST['mdp'],$membre['mdp'])) {
            // password_verify(arg1,arg2); retourne true ou false, et permet de comparer une chaine de caractere à une chaine crypté
                // arg1 : le mdp saisin par l'utilisateur
                // arg2 : la chaine cryptée par la fonction password_hash(), ici le mdp en BDD
                
            // inssertion des infos ($membre) de la personne qui se connecte dans le fichier de session
            $_SESSION['membre']= $membre;
                // debug($_SESSION);


            // redirection vers la page profil : 
            header('location:profil.php');
            exit;// exit : permet de quitter A CET ENDROIS PRECIS le script courant et donc de ne pas interpreter le code qui suit cette instruction



            // -------------------------------
            // -------------------------------
            // Autre méthode "manuelle" pour inserer les infos dans le fichier de session: 
                // $_SESSION['membre']['id_membre'] = $membre['id_membre'];
                // $_SESSION['membre']['pseudo'] = $membre['pseudo'];
                // $_SESSION['membre']['mdp'] = $membre['mdp'];
                // $_SESSION['membre']['prenom'] = $membre['prenom'];
                // $_SESSION['membre']['nom'] = $membre['nom'];
                // $_SESSION['membre']['email'] = $membre['email'];
                // $_SESSION['membre']['adresse'] = $membre['adresse'];
                // $_SESSION['membre']['ville'] = $membre['ville'];
                // $_SESSION['membre']['cp'] = $membre['cp'];
                // $_SESSION['membre']['statut'] = $membre['statut'];
                
            // //-----------------------------------------
            // //Boucle foreach pour isnérer les données dans le fichier de session :
            // foreach( $membre as $indice => $valeur ){
                
            //     $_SESSION['membre'][$indice] = $valeur;
            // }
            


        }
        else {
            $error .= "<div class='alert alert-danger'>Mot de passe incorrect</div>";
        }
    }
    else {
        $error .= "<div class='alert alert-danger'>Pseudo incorrect</div>";
    }
}


// ----------------------------------------------
?>

    <h1>Connexion</h1>

    <?php echo $error; ?>

    <form method="post">

        <label>Pseudo</label><br>
        <input type="text" name="pseudo" placeholder="Votre Pseudo"><br><br>

        <label>Mot de passe</label><br>
        <input type="text" name="mdp" placeholder="Votre mot de passe"><br><br>

        <input type="submit" value="Se connecter" class="btn btn-secondary">

    </form>

<?php require_once "inc/footer.inc.php"; ?>



