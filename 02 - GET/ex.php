<?php
// Exercice :
/*
   1- vous affichez dans ce script : 1 titre "Mon profil", 1 nom et 1 prénom.
   2- Vous y ajoutez un lien en GET "Modifier mon profil". Ce lien passe dans l'URL à la page exercice.php que l'ACTION demandée est modification.
   3- Si vous recevez cette information depuis l'URL vous affichez "Vous avez demandé la modification de votre profil.".
*/

echo '<h1> Mon profil </h1>';

if(isset($_GET['action']) && $_GET['action'] == 'modification') { // si existe "action" dans $_GET dans l'url c'est qu'on a cliqué sur le lien "modifier mon profil" . Puis on vérifie que la valeur de $_GET['action'] est "modification", auquel cas on a bien cliqué sur le lien "modifier"
    echo '<p> Vous avez demandé la modification de votre profil</p>';
}

echo '<p> Nom : DOE </p>';
echo '<p> Prénom : John </p>';

echo '<a href="ex.php?action=modification">Modifier mon profil</a>';
