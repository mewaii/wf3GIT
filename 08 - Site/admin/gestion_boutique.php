<?php
require_once '../inc/init.php';
//----------------------------- TRAITEMENT PHP -----------------------------//
// 1- restriction d'accès au admin
if(!estAdmin()){ // si membre non admin ou non connecté, on le renvoie vers connexion.php
    header('location:../connexion.php');
    exit();
}

// 7- Suppression du produit
// On se positionne avant l'affichage du tableau <table> pour que celui-ci soit à jour sans le produit supprimé.
if (isset($_GET['id_produit'])) { // si existe "id_produit" dans l'URL c'est qu'on a demandé sa suppression
    $resultat = executeRequete("DELETE FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit'])); // l'identifiant vient de l'URL

    if ($resultat) { // si le DELETE retourne 1 objet PDOStatement évalué à true c'est que la requete a marché
        $contenu .= '<div class="alert alert-success">Le produit a bien été supprimé</div>';
    } else {    // dans le cas contraire on a reçu false
        $contenu .= '<div class="alert alert-danger">Erreur lors de la suppression</div>';
    }
}


// 6- Affichage des produits en back-office:

$resultat = executeRequete("SELECT * FROM produit");

$contenu .= '<p>Nombre de produits dans la boutique : '. $resultat->rowCount() .'</p>';

$contenu .= '<table class="table">';
    $contenu .= '<tr>';
    $contenu .= '<th>ID</th>';
    $contenu .= '<th>Référence</th>';
    $contenu .= '<th>Catégorie</th>';
    $contenu .= '<th>Titre</th>';
    $contenu .= '<th>Description</th>';
    $contenu .= '<th>Couleur</th>';
    $contenu .= '<th>Taille</th>';
    $contenu .= '<th>Public</th>';
    $contenu .= '<th>Photo</th>';
    $contenu .= '<th>Prix</th>';
    $contenu .= '<th>Stock</th>';
    $contenu .= '<th>Action</th>'; // Colonne pour les liens modifier et supprimer
    $contenu .= '</tr>';

    // Les lignes du tableau :
    while ($donnee = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $contenu.= '<tr>';
            foreach ($donnee as $indice => $article) { // cette boucle parcourt les informations du tableau $produit
                if($indice == 'photo') { // si je suis sur la colonne "photo" alors je mets une balise <img>
                    $contenu.= '<td><img src="../' . $article . '" alt="photo"></td>';
                } else {
                    $contenu.= '<td>' . $article . '</td>'; 
                }
            }
            
        $contenu.= '<td>
                        <a href="formulaire_produit.php?id_produit='. $donnee['id_produit'].'">modifier</a>
                        <a href="?id_produit='. $donnee['id_produit'].'" onclick="return confirm(\'Etes-vous certain de vouloir supprimer ce produit ?\')">supprimer</a>
                    </td>'; // nous ajoutons les liens modifier et supprimer sur chaque ligne de produit (nous sommes à l'intérieur du <tr>). Nous passons dans l'URL l'identifiant du produit contenu dans la variable $produit['id_produit]

        $contenu.= '</tr>';
    }

$contenu .= '</table>';
//----------------------------- AFFICHAGE -----------------------------//
require_once '../inc/header.php';
// 2- liens de navigation
?>
<style>
    img {
        height: 90px;
        width: 90px;
    }
</style>
<h1 class="mt-4">Gestion boutique</h1>

<ul class="nav nav-tabs">
    <li><a href="gestion_boutique.php" class="nav-link active">Affichage des produits</a></li>
    <li><a href="formulaire_produit.php" class="nav-link">Formulaire produit</a></li>
</ul>


<?php
echo $contenu;
require_once '../inc/footer.php';
