<?php
$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 
'root', 
'',    
array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
)
);

$contenu = '';

$contenu .= '<table class="table">';
$contenu .= '<tr>';
$contenu .= '<th>ID</th>';
$contenu .= '<th>Nom</th>';
$contenu .= '<th>Prénom</th>';
$contenu .= '<th>Téléphone</th>';
$contenu .= '<th>Email</th>';
$contenu .= '<th>Type_contact</th>';
$contenu .= '<th>Photo</th>';
$contenu .= '<th>Voir</th>';
$contenu .= '</tr>';
	
	
	$resultat = $pdo->query("SELECT * FROM contact");

	while ($membre = $resultat->fetch(PDO::FETCH_ASSOC)) {
		$contenu.= '<tr>';
			foreach ($membre as $indice => $valeur) { 
				if($indice == 'photo') { 
					$contenu.= '<td><img src="../' . $valeur . '" alt="photo"></td>';
				} else {
					$contenu.= '<td>' . $valeur . '</td>'; 
				}
			}
			
			$contenu.= '<td>
							<a href="detail_contact.php?id_contact='. $membre['id_contact'].'">Voir</a>
						</td>';
		$contenu.= '</tr>';
	}

$contenu .= '</table>';
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
		img {
			height: 80px;
			width: 80px;
		}
		h1 {
			text-align: center;
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

					echo '<li><a href="detail_contact.php" class="nav-link">Détail contact</a></li>';

					?>
				</ul>
			</div>
		</nav>
		<h1 class="mx-auto">Liste des contacts</h1>
	</header>
	<main class="container">
		<div class="row">
			<div class="col-12">
<?php

echo $contenu;

?>
			</div>
		</div>
	</main>
</html>