<?php
// Exercice
require_once '../inc/init.php';
/*
1- Seul l'administrateur doit avoir accès à cette page. Les autres sont redirigés vers la page de connexion.*/
if (!estAdmin()) {
   header('location:../connexion.php');
   exit();
}
if (isset($_GET['id_membre'])) { 
   $resultat = executeRequete("DELETE FROM membre WHERE id_membre = :id_membre", array(':id_membre' => $_GET['id_membre'])); 

   if ($resultat) {
       $contenu .= '<div class="alert alert-success">Le membre a bien été supprimé</div>';
   } else {
       $contenu .= '<div class="alert alert-danger">Erreur lors de la suppression</div>';
   }
}
// $admin = 1;
// if ($_GET['statut'] == 0) { 
//    $resultat = executeRequete("REPLACE INTO membre VALUES (:statut)", array(
//       ':statut' => 1)); 
// }
/*2- Afficher tous les membres inscrits dans une table HTML, avec toutes les infos du membre SAUF son mot de passe. Vous ajoutez une colonne "action".*/

$resultat = executeRequete("SELECT id_membre, pseudo, nom, prenom, email, civilite, ville, code_postal, adresse, statut FROM membre");


$contenu .= '<table class="table">';
    $contenu .= '<tr>';
    $contenu .= '<th>Id membre</th>';
    $contenu .= '<th>Pseudo</th>';
    $contenu .= '<th>Nom</th>';
    $contenu .= '<th>Prénom</th>';
    $contenu .= '<th>Email</th>';
    $contenu .= '<th>Civilité</th>';
    $contenu .= '<th>Ville</th>';
    $contenu .= '<th>Code Postal</th>';
    $contenu .= '<th>Adresse</th>';
    $contenu .= '<th>Statut</th>';
    $contenu .= '<th>Action</th>';
    $contenu .= '</tr>';

  
    while ($donnee = $resultat->fetch(PDO::FETCH_ASSOC)) {
      $contenu.= '<tr>';
         foreach ($donnee as $article) { 
            
         $contenu.= '<td>' . $article . '</td>'; 

         }
         /*4- Dans la colonne "action", ajoutez un lien "supprimer" pour supprimer un membre inscrit, SAUF vous même qui êtes connecté.*/
         $contenu.= '<td>';  

            if ($donnee['id_membre'] != $_SESSION['membre']['id_membre']){
               $contenu.= '<a href="?id_membre='. $donnee['id_membre'].'" onclick="return confirm(\'Etes-vous certain de vouloir supprimer ce membre ?\')">supprimer </a>'; 
               $contenu.= '<a href="?statut='. $donnee['statut'].'" onclick="return confirm(\'Etes-vous certain de vouloir changer le statut de ce membre ?\')"> modifier</a>';
            }
         /*5- Bonus : dans la colonne "action", ajoutez un lien pour pouvoir modifier le statut des membres pour en faire un admin ou un membre, sauf vous même qui êtes connecté.*/

         $contenu.= '</td>';
      $contenu.= '</tr>';
    }

$contenu .= '</table>';
/*3- Afficher le nombre de membres inscrits.*/
$nombreMembre = '<p>Nombre de membres inscrits : '. $resultat->rowCount() .'</p>';
require_once '../inc/header.php';
?>


<?php
echo $contenu;
echo $nombreMembre;
require_once '../inc/footer.php';

