<?php
/* Le fichier init.php sera inclus dans tous les scripts (hors inclusions) pour initialiser :
    - la connexion à la BDD
    - la création ou l'ouverture de la session
    - la définition du chemin du site sur le serveur
    - l'inclusion du fichier functions.php
*/

// Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=site_commerce', 
               'root', 
               '',    
               array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
               )
);

// Création ou ouverture de session
session_start();

// Chemin du site
define('RACINE_SITE', '/PHP/08 - site/'); // on indique ici les dossiers dans lesquels se situe à partir de "localhost". Cela permet de créer des chemins absoluts à partir de "localhost" (caractérisés par le / au début). Ils sont utilisés notamment dans header.php qui peut etre inclus dans des fichiers appartenant à des dossiers ou des sous-dossiers différents : par conséquent les chemins relatifs vers les sources changeraient, alors que les chemins absoluts sont les memes

// Variable d'affichage
$contenu = '';

//Inclusion des fonctions
require_once 'functions.php'; // fait l'inclusion 1 seule fois du fichier spécifié