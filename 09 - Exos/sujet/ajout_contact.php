<?php?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<title>Répertoire</title>
</head>
<style>
	h1 {
		text-align: center;
	}
</style>
<body>
	<?php 

	$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 
				'root', 
				'',    
				array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
				)
	);
	echo '<pre>';
		print_r($_POST);
	echo '</pre>';
	$contenu = '';
	$photo_bdd = '';
	if(!empty($_POST)) {
		if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 50){ 
			$contenu .= '<div class="alert alert-danger">Le nom doit contenir entre 2 et 50 caractères.</div>';
		}
		if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 50){ 
			$contenu .= '<div class="alert alert-danger">Le prénom doit contenir entre 2 et 50 caractères.</div>';
		}
		if (!isset($_POST['telephone']) ||  !preg_match('#^[0-9]{10}$#', $_POST['telephone'])){
			$contenu .= '<div class="alert alert-danger">Le format du téléphone est incorrect.</div>';
		}
		if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || strlen($_POST['email']) > 255){ 
			$contenu .= '<div class="alert alert-danger">L\'email n\'est pas valide.</div>';
		}
		if (!isset($_POST['type_contact']) || ($_POST['type_contact'] != 'Ami' && $_POST['type_contact'] != 'Famille' && $_POST['type_contact'] != 'Professionnel' && $_POST['type_contact'] != 'Autre' )){ 
			$contenu .= '<div class="alert alert-danger">Le type de contact n\'est pas valide.</div>';
		}

		if(empty($contenu)) { 

			foreach($_POST as $indice => $valeur) {
				$_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES); // transforme les chevrons en entités HTML pour éviter les risques XSS et CSS. ENT_QUOTES pour ajouter les guillemets à transformer en entités HTML
			}					
			$resultat = $pdo->prepare("SELECT * FROM contact WHERE id_contact = :id_contact");
			$inscrit = $resultat->fetch(PDO::FETCH_ASSOC);
			$resultat->bindParam(':id_contact', $inscrit['id_contact']);
			$resultat->execute();

			
			if($resultat->rowCount() > 0){ 
				$contenu .= '<div class="alert alert-danger">Vous êtes déjà enregistré.</div>';
			} else {

			if(!empty($_FILES['photo']['name'])) {
				$fichier_photo = $_FILES['photo']['name'];
				$photo_bdd = 'photo_contact/' . $fichier_photo; 
				copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd); // copie lap hoto qui est emporairement dans $_FILES['photo']['tmp_name'] vers l'emplacement défini par $photo_bdd
			}
			
				$succes = $pdo->prepare("INSERT INTO contact (nom, prenom, telephone, email, type_contact, photo) VALUES (:nom, :prenom, :telephone, :email, :type_contact, :photo)");
				$succes->execute(array(':nom' => $_POST['nom'],
				':prenom' => $_POST['prenom'],
				':email' => $_POST['email'],
				':telephone' => $_POST['telephone'],
				':email' => $_POST['email'],
				':type_contact' => $_POST['type_contact'],
				':photo' => $photo_bdd));	// attention la photo ne provient pas de $_POST mais de $_FILES que l'on traite à part de $_POST ci-dessus

			$contenu .= '<div class="alert alert-success">Vous êtes enregistré.</div>';


		}
	}

?>
	<header>

		<nav class="navbar navbar-expand-lg navbar-light bg-light">

			<a class="navbar-brand" href="<?php echo 'ajout_contact.php'; ?>">Répertoire</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<?php
					echo '<li><a href="detail_contact.php" class="nav-link">Détail contact</a></li>';

					echo '<li><a href="liste_contact.php" class="nav-link">Liste contact</a></li>';

					?>
				</ul>
			</div>
		</nav>
		<h1>Ajouter un contact</h1>
	</header>
	<?php
		echo $contenu;
	?>
	<main class="container">
		<div class="row">
			<div class="col-12">


				<form action="" method="post" enctype="multipart/form-data">

					<div><label for="nom">Nom</label></div>
					<div><input type="text" id="nom" name="nom" value="<?php echo $_POST['nom'] ?? ''; ?>"></div>

					<div><label for="prenom">Prénom</label></div>
					<div><input type="text" id="prenom" name="prenom" value="<?php echo $_POST['prenom'] ?? ''; ?>"></div>

					<div><label for="telephone">Telephone</label></div>
					<input type="tel" id="telephone" name="telephone" value="<?php echo $_POST['telephone'] ?? ''; ?>" required>

					<div><label for="email">Email</label></div>
					<div><input type="text" id="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>"></div>

					<label for="type_contact">Contact</label>

					<select name="type_contact" id="type_contact">
						<option value="">--Veuillez choisir une option--</option>
						<option value="Ami">Ami</option>
						<option value="Famille">Famille</option>
						<option value="Professionnel">Professionnel</option>
						<option value="Autre">Autre</option>
					</select>

					<div><label for="photo">Photo</label></div>

					<input type="file" name="photo" id="photo">

					<div><input type="submit" value="Enregistrer" class="btn btn-info mt-4"></div>
				</form>
			</div>
		</div>
	</main>
</body>

</html>
