<?php
require_once 'inc/init.php';
//----------------------------- TRAITEMENT PHP -----------------------------//
$contenu_categories = '';
$contenu_produits = '';

// 1- Affichage des categories : 
$resultat = executeRequete("SELECT DISTINCT categorie FROM produit"); // DISTINCT pour dédoublonnés les catégories

$contenu_categories .= ('<div class="list-group mb-4">');

    $contenu_categories .= '<a href="?categorie=tous" class="list-group-item ">Tous les produits</a>'; // on passe dans l'URL que cette categorie a pour valeur "tous" pour afficher tous les produits

    while ($cat = $resultat->fetch(PDO::FETCH_ASSOC)) {
        //debug($cat);  $cat est un tableau avec l'indice "categorie" qui contient une categorie par tour de boucle
        $contenu_categories .= '<a href="?categorie='. $cat['categorie'] .'" class="list-group-item">'. $cat['categorie'] .'</a>';
    }

$contenu_categories .= '</div>';

// 2- Affichage des produits selon la categorie choisie
if(isset($_GET['categorie']) && $_GET['categorie'] != 'tous'){  // si "categorie" est dans l'URL et que ça valeur est différente de tous alors on sélectionne la categorie demandée
    $resultat = executeRequete("SELECT id_produit, reference, titre, photo, prix, description FROM produit WHERE categorie = :categorie", array(':categorie' => $_GET['categorie']));
} else {
    $resultat = executeRequete("SELECT * FROM produit"); // sinon on sélectionne tous les produits (cas ou on arrive la 1ère fois ou quand on clique sur "tous")
}
// debug($resultat);
while ($produit = $resultat->fetch(PDO::FETCH_ASSOC)) {
    // debug($produit);
    $contenu_produits .= '<div class="col-sm-4 mb-4">';
        $contenu_produits .= '<div class="card">';

            // image cliquable
            $contenu_produits .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'">
                                  <img class="card-img-top" src="'. $produit['photo'] .'" alt="'. $produit['titre'] .'">  
                                  </a>';
            // info du produit
            $contenu_produits .= '<div class="card-body">';
                $contenu_produits .= '<h4>' . $produit['titre']. '</h4>';
                $contenu_produits .= '<h5>' . number_format($produit['prix'], 2, ',', ''). ' €</h5>'; // formate l'affichage des prix avec 2 décimales, une virgule pour séparateur des décimales, et un string vide pour séparateur des milliers
                $contenu_produits .= '<p>' . $produit['description']. '</p>';
            $contenu_produits .= '</div>';
        $contenu_produits .= '</div>';
    $contenu_produits .= '</div>'; // .col-sm-4
}
//----------------------------- AFFICHAGE -----------------------------//
require_once 'inc/header.php';
?>

    <h1 class="mt-4">Boutique</h1>

    <div class="row">
        <div class="col-md-3">
            <?php echo $contenu_categories; // pour afficher les categories ?>
        </div>
        <div class="col-md-9">
            <div class="row">
                <?php  echo $contenu_produits; // pour afficher les produits ?>
            </div>
        </div>
    </div>

<?php
require_once 'inc/footer.php';