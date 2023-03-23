<?php require_once "inc/header.inc.php"; ?>
<?php 
// AFFICHAGE des PRODUITS : 

// récupération des différentes catégories de la table produit : 
$r = execute_requete("SELECT DISTINCT categorie FROM produit");

$content .= "<div class='row'>";
    // Affichage des categories
    $content .= "<div class='col-3'>";
		$content .= "<div class='list-group-item'>";

            while ($categorie = $r->fetch(PDO::FETCH_ASSOC)) {
                // debug($categorie);
                $content .= "<a href='?categorie=$categorie[categorie]' class='list-group-item'>
                            $categorie[categorie]
                            </a>";
            }
		$content .= "</div>";
	$content .= "</div>";

    //EXERCICE : Affichez les produits correpondants à la catégorie cliquée
	// debug( $_GET );

	$content .= "<div class='col-8 offset-1'>";
        $content .= "<div class='row'>";
                
            if (isset($_GET['categorie'])) {
                $r = execute_requete("SELECT * FROM produit WHERE categorie = '$_GET[categorie]' ");
                while($produit = $r->fetch(PDO::FETCH_ASSOC)){
                    // debug($produit);
                    $content .= "<div class='col-2'>";
                        $content .= "<div class='thumbnail' style='border:1px solid #eee'>";

                            $content .= "<a href='fiche_produit.php?id_produit=$produit[id_produit]'>";

                                $content .= "<img src='$produit[photo]' width='100'>";
                                $content .= "<p>$produit[titre]</p>";
                                $content .= "<p>$produit[prix] €</p>";

                            $content .= "</a>";

                        $content .= '</div>';
                    $content .= '</div>';
                }
            }
            else {
                $content .= "<h3> On affiche ce que l'on veut</h3>";
            }
        $content .= '</div>';
    $content .= '</div>';
$content .= "</div>";



// ----------------------------------
?>
    <h1>Bienvenue sur mon site</h1>

    <?= $content ?>

<?php require_once "inc/footer.inc.php"; ?>


