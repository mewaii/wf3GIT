<?php


echo '<pre>';
print_r($_POST); 
echo '</pre>';

if(!empty($_POST)) {

    echo '<p>ville : ' .$_POST['ville'] . '</p>';
    echo '<p>cp : ' .$_POST['cp'] . '</p>';
    echo '<p>adresse : ' .$_POST['adresse'] . '</p>';

    //---------------
    // ecrire dans un fichier txt
    //---------------
    // On va écrire les adresses des internautes dans un fichier texte créé dynamiquement sur le serveur. (en l'absence de BDD).

    $file = fopen('adresses.txt', 'a'); // fopen() en mode "a" créer le fichier s'il n'existe pas encore sinon l'ouvre.

    $adresse = $_POST['adresse'] . ' - ' .$_POST['cp'] . ' - ' . $_POST['ville'] . "\n"; // on concatène l'adresse de l'internaute avec un saut de ligne à la fin ("\n")

    fwrite($file, $adresse); // fwrite() écrit le contenu de la variable $adresse dans le fichier représenté par $file.

    fclose($file); // puis on ferme le fichier pour libérer de la ressource
}