<?php

// echo '<pre>';
// print_r($_GET);
// echo '</pre>';
	$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 
	'root', 
	'',    
	array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
	)
);

$infomembre = '';
$resultat = $pdo->prepare("SELECT * FROM contact WHERE id_contact = :id_contact");
$resultat->bindParam(':id_contact', $_GET['id_contact']);
$resultat->execute();

$_GET['id_contact'] = htmlspecialchars($_GET['id_contact'], ENT_QUOTES);
$membre = $resultat->fetch(PDO::FETCH_ASSOC);

			// echo '<pre>';
			// print_r($membre);
			// echo '</pre>';
/*
   1- Vous affichez le détail complet du contact demandé, y compris la photo. Si le contact n'existe pas, vous laissez un message. 

*/
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<title>Liste contact</title>
	</head>

	<style>
		* {
			text-align: center;
		}
      h1 {
         margin-bottom: 50px;
      }
	</style>
	<header>
		
		<nav class="navbar navbar-expand-lg navbar-light bg-light">

			<a class="navbar-brand" href="<?php echo 'ajout_contact.php'; ?>">Répertoire</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<?php
					echo '<li><a href="ajout_contact.php" class="nav-link">Ajout contact</a></li>';

					echo '<li><a href="liste_contact.php" class="nav-link">Liste contact</a></li>';

					?>

				</ul>
			</div>
		</nav>
		<h1 class="mx-auto">Détail du contact</h1>
	</header>
	<main class="container">
		<div class="card mx-auto" style="width: 18rem;">
			<div class="card-body">
			<?php
			if(empty($membre))
			{
				echo '<h2>Le contact n\'existe pas</h2>';
			} else {
				$infomembre .= '<div class="card-text">'. $membre['nom'] .'</div>';
				$infomembre .= '<div class="card-text">'. $membre['prenom'] .'</div>';
				$infomembre .= '<div class="card-text">'. $membre['telephone'] .'</div>';
				$infomembre .= '<div class="card-text">'. $membre['email'] .'</div>';
				$infomembre .= '<div class="card-text">'. $membre['type_contact'] .'</div>';
				$infomembre .= '<img class="card-img-bottom" src="../' . $membre['photo'] . '" alt="photo">';
				echo $infomembre;
			}
			?>
         	</div>
        </div>
	</main>