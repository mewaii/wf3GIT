<?php
require_once 'inc/init.php';
//----------------------------- TRAITEMENT PHP -----------------------------//
// debug($_POST);

if(!empty($_POST)) { // si le formulaire d'ajout au panier a été envoyé

    // on sélectionne en BDD le prix, la référence et le titre du produit ajouté
    $resultat = executeRequete("SELECT prix, reference, titre FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_POST['id_produit'])); // l'identifiant vient du formulaire

    $produit = $resultat->fetch(PDO::FETCH_ASSOC);
    //debug($produit);
    
    //  On rempli la session avec les infos du produit ajouté au panier (on les mets dans la SESSION pour que le panier soit accessible sur toutes les pages du site)
    $_SESSION['panier']['id_produit'][] = $_POST['id_produit']; // "id_produit" vient du form donc de $_POST. Les [] permettent d'ajouter un élément à la fin du tableau avec un indice numérique
    $_SESSION['panier']['reference'][] = $produit['reference']; // la reference vient de la BDD
    $_SESSION['panier']['titre'][] = $produit['titre']; // le titre vient de la BDD
    $_SESSION['panier']['quantite'][] = $_POST['quantite']; // la quantité vient du form
    $_SESSION['panier']['prix'][] = $produit['prix']; // le prix vient de la BDD
    debug($_SESSION);

    // 3- redirection vers la fiche produit une fois l'article ajouté au panier
    header('location:fiche_produit.php?id_produit=' . $_POST['id_produit']); // je passe l'identifiant produit dans l'URL pour réafficher la fiche de ce produit
    exit();
}
// 4- Vider le panier
if(isset($_GET['action']) && $_GET['action'] == 'vider') { // si j'ai cliqué sur "vider le panier"
    unset($_SESSION['panier']); // on supprime le panier de la session sans supprimer cette dernière totalement pour ne pas déconnecter le membre
}


//----------------------------- AFFICHAGE ----------------------------------//
require_once 'inc/header.php';
// 2 - Affichage du panier
echo '<h1 class="mt-4">Votre panier</h1>';

if(empty($_SESSION['panier']['id_produit'])) {  // s'il n'y a pas d'id produit c'est que le panier est vide
    echo '<p>Votre panier est vide</p>';
} else {
   echo '<table class="table table-striped">'; 
    echo '<tr class="info">
         
            <th>Référence</th> 
            <th>Titre</th> 
            <th>Quantité</th> 
            <th>Prix unitaire</th> 
    
         </tr>';
    // lignes de chaque produits
    // on fait une boucle for pour parcourir les indices numériques
    for ($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++ ) {    // on fait autant de tour que d'"id_produit" dans le panier
        echo '<tr>';
            echo '<td>' . $_SESSION['panier']['reference'][$i] . '</td>';
            echo '<td>' . $_SESSION['panier']['titre'][$i] . '</td>';
            echo '<td>' . $_SESSION['panier']['quantite'][$i] . '</td>';
            echo '<td>' .number_format($_SESSION['panier']['prix'][$i], 2, ',', '') . ' €</td>';
        echo '</tr>';
    }

    // Ligne du total
    echo '<tr>
            <th colspan="2"></th>
            <th colspan="1">Total</th>
            <th colspan="1">'. montantTotal() .'€ TTC</th>
          </tr>';


    // Ligne "vider" le panier
    echo '<tr class="text-center">
            <td colspan="4">
                <a href="?action=vider">vider le panier<a/>
            </td>
          </tr>';
    echo '<table>'; 
}
require_once 'inc/footer.php';