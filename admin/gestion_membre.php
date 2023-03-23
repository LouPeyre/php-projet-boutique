<?php require_once "../inc/header.inc.php"; ?>
<?php
/*
EXERCICE : création de la page gestion_membre.php

Objectifs : 

	- L'accès à la page doit être accéssible uniquement si l'on est administtrateur

	- Afficher les membres (sans le mot de passe)
		-> Avoir la possibilité de supprimer un membre
		-> Avoir la possibilité de modififer un membre
			( comme pour pouvoir changer le statut d'un membre)
*/
//restriction d'accès à la page :
if( !adminConnect() ){ //SI l'admin N'EST PAS connecté, je le redirige vers la page de connexion

	header('location:../connexion.php');
	exit;
}

//-----------------------------------------
//SUPPRESSION :
if( isset( $_GET['action'] ) && $_GET['action'] == 'suppression' ){

	execute_requete(" DELETE FROM membre WHERE id_membre = $_GET[id_membre] ");
} 

//-----------------------------------------
//Affichage des membres :
//debug( $_GET );

if( isset( $_GET['action'] ) && $_GET['action'] == 'affichage' ){

	//Récupération des infos en base :
	$r = execute_requete(" SELECT * FROM membre ");

	$content .= "<table border='2' cellpadding='5'>";
		$content .= "<tr>";

			for( $i = 0; $i < $r->columnCount(); $i++ ){

				$entete = $r->getColumnMeta( $i );
					//debug( $entete );

				if( $entete['name'] != 'mdp' ){ //SI le nom de la colonne est différent de 'mdp', alors on affiche sa valeur

					$content .= "<th> $entete[name] </th>";
				}
			}
			$content .= "<th> Suppression </th>";
			$content .= "<th> Modification </th>";
		$content .= "</tr>";

		while( $membre = $r->fetch( PDO::FETCH_ASSOC ) ){

			$content .= "<tr>";
				//debug( $membre );

				foreach( $membre as $index => $value ){

					if( $index != 'mdp' ){ //SI l'indice est différen de 'mdp' alors on affiche la valeur 

						$content .= "<td> $value </td>";
					}
				}

				$content .= "<td>
								<a href='?action=suppression&id_membre=$membre[id_membre]' onclick='return( confirm( \" Voulez vous supprimer ce membre : $membre[pseudo] \" ) )'>
									<i class='fas fa-trash-alt'></i>
								</a>
							</td>";

				$content .= '<td>
								<a href="?action=modification&id_membre='. $membre['id_membre'] .'">
									<i class="far fa-edit"></i>
								</a>
							</td>';
			$content .= "</tr>";
		}
	$content .= "</table>";
}

//-------------------------------------------------------------------------------------------------------------
?>
<h1> GESTION MEMBRES</h1>

<a href="?action=affichage">Affichage des membres</a><hr>

<?= $content; //affichage du contenu ?>

<?php if( isset( $_GET['action'] ) && $_GET['action'] == 'modification' ) :
	//SI il y a une 'action' ET QUE cette 'action' est égale à 'modification', on affiche un formulaire pré-rempli pour effectuer les modifs'

	$r = execute_requete(" SELECT * FROM membre WHERE id_membre = $_GET[id_membre] ");

	$membre_a_modifier = $r->fetch( PDO::FETCH_ASSOC );
		debug( $membre_a_modifier );

	$pseudo = $membre_a_modifier['pseudo'];
	$email = $membre_a_modifier['email'];
	$nom = $membre_a_modifier['nom'];
	$prenom = $membre_a_modifier['prenom'];
	$sexe = $membre_a_modifier['sexe'];
	$adresse = $membre_a_modifier['adresse'];
	$ville = $membre_a_modifier['ville'];
	$cp = $membre_a_modifier['cp'];
	$statut = $membre_a_modifier['statut'];

	//------------------------------------------------------
	//MODIFICATION :
	if( $_POST ){ //SI on valide le formulaire

		//debug( $_POST );

		execute_requete(" UPDATE membre SET  	pseudo = '$_POST[pseudo]',
												nom = '$_POST[nom]',
												prenom = '$_POST[prenom]',
												email = '$_POST[email]',
												sexe = '$_POST[sexe]',
												adresse = '$_POST[adresse]',
												ville = '$_POST[ville]',
												cp = '$_POST[cp]',
												statut = '$_POST[statut]'

							WHERE id_membre = $_GET[id_membre]
						");

		//redirection vers l'affichage pour voir les modifications
		header('location:?action=affichage');
	}

?>

<form method="post">
	
	<label>Pseudo</label><br>
	<input type="text" name="pseudo" value="<?= $pseudo ?>" ><br><br>
	
	<label>nom</label><br>
	<input type="text" name="nom" value="<?= $nom ?>" ><br><br>

	<label>prenom</label><br>
	<input type="text" name="prenom" value="<?= $prenom ?>" ><br><br>

	<label>email</label><br>
	<input type="text" name="email" value="<?= $email ?>" ><br><br>

	<label>Sexe</label><br>
	<input type="radio" name="sexe" value="m" <?php echo ( $sexe == 'm') ? 'checked' : ''; ?>  > Homme <br>
	<input type="radio" name="sexe" value="f" <?php echo ( $sexe == 'f') ? 'checked' : ''; ?>  > Femme <br><br>

	<label>adresse</label><br>
	<input type="text" name="adresse" value="<?= $adresse ?>" ><br><br>

	<label>ville</label><br>
	<input type="text" name="ville" value="<?= $ville ?>" ><br><br>

	<label>cp</label><br>
	<input type="text" name="cp" value="<?= $cp ?>" ><br><br>

	<label>Statut</label><br>
	<select name="statut">
		<option value="0" <?php if( $statut == 0 ) echo 'selected'; ?>  > Membre </option>
		<option value="1" <?php if( $statut == 1 ) echo 'selected'; ?>  > Admin </option>
	</select><br><br>

	<input type="submit" value="Modifier" class='btn btn-secondary'>

</form>

<?php endif; ?>

<?php require_once "../inc/footer.inc.php"; ?>
