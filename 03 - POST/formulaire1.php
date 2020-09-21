<?php
//-------------------------
// La superglobale $_POST
//-------------------------
// $_POST est une superglobale qui permet de récupérer les données saisises dans un formulaire

// $_POST étant une superglobale, est donc un array et est disponible dans tout les contextes du script y comprit au sein des fonction sans y faire "global $_POST"

// Les données saisies dans le form sont réceptionnée dans $_POST de la manière : $_POST = array('name1' => 'valeur input1', 'nameN' => 'valeur inputN');


echo '<pre>';
print_r($_POST); // pour verifier que le form envoie bien des données
echo '</pre>';

if(!empty($_POST)) { // si il n'est pas vide $_POST c'est que l'on a reçu des données du formulaire. On peut donc en afficher le contenu

    echo '<p>Prenom : ' .$_POST['prenom'] . '</p>';
    echo '<p>Description : ' .$_POST['descritpion'] . '</p>';
}

// Remarque : 
// Cliçquer dans l'url et faire entrer permet de reintitialiser le form comme si nous venions pour la première fois
// Faire F5 ou CTRL + r permet de rafraichir la page et de renvoyer les derniièers données saisies dans le form

?>

<h1>formulaire</h1>

<form method="post" action=""> <!-- un formulaire doit toujours etre dans une balise form. L'attribut method définit comment les données vont circuler entre le navigateur et le serveur. L'attribut action définit l'url de destination des données saisies-->

    <div><label for="prenom">Prénom</label></div>
    <div><input type="text" name="prenom" id="prenom"></div><!-- il ne faut pas oublier les "name" dans les form ils constituent les indices du tableau $_POST qui receptionne les données-->
    <div><label for="descritpion"></label>Descritpion</div> <!-- for n'es tpas indispensable mais permet de relier le label input qui porte un id de meme valeur Ainsi quand on clique sur l'etiquette le curseur se positionne dans l'input-->
    <div><textarea name="descritpion" id="descritpion" cols="30" rows="10"></textarea></div>

    <div><input type="submit" value="envoyer"></div>
</form>