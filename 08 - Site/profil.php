<?php
require_once 'inc/init.php';
/* Exercice :
   1- si le visiteur accède à cette page et qu'il n'est pas connecté, vous le redirigez vers la page de connexion.*/

if (!estConnecte()) {
   header('location:connexion.php'); // on envoie dans le header du texte HTTP qui transite entre serveur et client le "message" 'location:connexion.php'. Celui-ci spécifie au navigateur qu'il doit demander la page connexion.php
   exit();
}

/*2- Dans cette page, vous affichez toutes les informations de son profil. Par ailleurs vous ajoutez un message de bienvenue juste après le <h1> : "Bonjour [prenom] [nom] !".  */

//debug($_SESSION['membre']); dés lors que l'on fait un session_start() (il est dans init.php), les données stockées dans cette session dans le serveur sont disponibles partout sur le site

/*3- Ajoutez un lien "supprimer mon compte". Quand on clique, vous supprimez le membre en BDD après avoir demandé confirmation de la suppression en JavaScript. Une fois le profil supprimé, vous détruisez la session et redirigez le membre vers la page inscription.php.*/

if (isset($_GET['action']) && $_GET['action'] == 'supprimer') { // le isset() est nécessaire car si "action" n'existe pas dans l'URL, donc dans $_GET, la condition s'arrête immmédiatement sans regarder si "action" contient "supprimer". Dans le cas contraire (si on ne met pas isset), nous aurions une erreur "undefined index".

   $id_membre = $_SESSION['membre']['id_membre']; // trouve id_membre dans la session car on est connecté
   $supprimer = executeRequete("DELETE FROM membre WHERE id_membre = $id_membre");
   session_destroy(); // on déconnecte le membre en détruisant la session
   header('location:inscription.php');
   exit();
}

require_once 'inc/header.php';
?>
<h1 class="mt-4">Profil</h1>
<?php

echo '<h2>Bonjour ' . $_SESSION['membre']['prenom'] . ' ' . $_SESSION['membre']['nom'] . '</h2>';

if (estAdmin()) {
   echo '<p>Vous êtes ADMINISTRATEUR</p>';
}
?>
<hr>
<h3>Vos coordonées</h3>
<ul>
   <li>Email : <?php echo $_SESSION['membre']['email']; ?></li>
   <li>Adresse : <?php echo $_SESSION['membre']['adresse']; ?></li>
   <li>Code Postal : <?php echo $_SESSION['membre']['code_postal']; ?></li>
   <li>Ville : <?php echo $_SESSION['membre']['ville']; ?></li>
</ul>

<hr>

<p><a href="profil.php?action=supprimer" class="nav-link" id="supprim">Supprimer mon compte</a></p>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
   $('#supprim').on('click', function() {
      alert('Etes vous sur de supprimer le compte');
   });
</script>




<?php
require_once 'inc/footer.php';
