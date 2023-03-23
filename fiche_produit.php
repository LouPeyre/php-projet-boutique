<?php require_once "inc/header.inc.php"; ?>
<?php

// debug( $_GET );
//---------------------------------------------
//EXERCICE : 
//Création de la page fiche_produit.php
//restreindre l'accès à la page SI on a cliqué sur un lien de la page d'accueil (et donc fait passer l'id dans l'URL) SINON, on le redirige vers la page d'accueil
if (isset($_GET['id_produit'])) {
    $r = execute_requete("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]' ");
}
else {
    header("location:index1.php");
    exit;
}

//---------------------------------------------
//créer 2 liens : (file d'ariane)
	//l'un pour permettre de retourner à l'accueil
	//l'autre pour retourner à la catégorie précédente

$produit = $r->fetch(PDO::FETCH_ASSOC);
    debug($produit);

$content .= "<a href='index1.php'>Accueil </a> / <a href='index1.php?categorie=$produit[categorie]'>". ucfirst($produit['categorie'])."</a><br>";

//affichez la liste des informations des produits SAUF l'id_produit et le stock
//Pour l'image, on affichera l'image et non pas l'adresse de la bdd
foreach ($produit as $indice => $valeur) {
    if ($indice == 'photo') {
        $content .= "<p><img src ='$produit[photo]' width='200'></p>";
    }
    elseif ($indice != 'id_produit' && $indice != 'stock') {
        $content .= "<p><strong>$indice</strong> : $valeur</p>";
    }
    
}

//---------------------------------------------
//gérer le stock à part !
	//SI il est supérieur à ZERO, on affiche le nombre de produits disponibles dans un <select> avec le nombre d'options correspondant au stock
	//SINON, on affiche rupture de stock

if ($produit['stock']>0) {

    $content .= "<form method='post' action='panier.php'>";
    // l'attibut aiction='' : permet d'etre rediriger lorsque l'on valide le formumaire. les données récupérées par $_POST seront donc traitées sur le fichier 'panier.php'

        $content .= "<label><strong>Quantité</strong> </label>";

        $content .= "<select name='quantite' >";
        for ($i=1; $i <= $produit['stock'] ; $i++) { 
            $content .= "<option value='$i'>$i</option>";
        }
        $content .= "</select><br><br>";

        $content .= "<input type='hidden' name='id_produit' value='$produit[id_produit]'>";
        // Ici, on crée un input caché qui permet d'envoyer l'id_produit que l'on souhaite récupéré qui servira pour récupéré les infos du produit dans 'panier.php'

        $content .= "<input type='submit' name='ajout_panier' value='Ajouter au panier' class='btn btn-secondary'>";

    $content .= "</form>";
    
}
else {
    $content .= "<p> Rupture de stock</p>";
}


// --------------------------------
?>
    <h1>Fiche Produit</h1>
    
    <?= $content ?>

<?php require_once "inc/footer.inc.php"; ?>