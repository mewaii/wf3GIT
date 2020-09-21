<?php
//---------------
// La superglobale $_COOKIE
//---------------
// Un cookie est un petit fichier (4 ko max) déposé par le serveur du site dans le navigateur de l'internaute et qui peut contenir des informations. Les cookies sont automatiquement renvoyés au serveur web par le navigateur quand l'internaute navigue dans les pages concernées par le cookie. PHP permet de récupérer très facilement les donées contenues dans un cookie : ses informations sont stockées dans $_COOKIE

// Précaution à prendre avec les cookies : étant sauvegardé sur le poste de l'internaute, le cookie peut etre volé ou modifié. On n'y met donc pas d'informations sensibles (prix panier, CB, mdp..) 

// Application: stocker la langue sélectionnée par l'internaut dans un cookie

// 2 - On détermine la langue d'affichage pour l'internaute :
if (isset($_GET['langue'])) { // si on a cliqué sur 1 langue, l'indice "langue" est passé dans l'URL donc se trouve dans $GET 
    $langue = $_GET['langue']; // on affecte alors la valeur de la langue à la variable $langue ("fr" ou "es" ou "en" ou "it")
} elseif(isset($COOKIE['langue'])) { // sinon si on a reçu un cookie appelé "langue"
    $langue = $COOKIE['langue']; // on affecte la valeur stockée dans le cookie
} else {
    $langue = 'fr'; // par défaut, si on n'a pas cliqué et qu'aucun cookie n'existe, la langue sera "fr"
}

// 3 - envoie du cookie :

$un_an = time() + 365*24*60*60; // time() retourne le timestamp de l'instant présent auquel on ajoute 1 an exprimé en secondes
setcookie('langue', $langue, $un_an); // on envoie un cookie appelé "langue" avec la valeur de $langue, et la date d'expiration $un_an

// 4- On affiche la langue : 
echo "<h2>Langue du site : $langue </h2>";


// 1 - Le HTML
?>
<h1>langue</h1>
<ul>
    <li><a href="?langue=fr">français</a></li>
    <li><a href="?langue=es">espagnol</a></li>
    <li><a href="?langue=en">anglais</a></li>
    <li><a href="?langue=it">italien</a></li>
</ul>