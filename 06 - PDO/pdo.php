<?php
//------------------------
//          PDO
//------------------------
//L'extension PDO pour PHP Data Objects, définit une interface pour accéder à une base de données depuis PHP, et permet d'y exécuter des requetes SQL

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

//-----------------------
// Connexion à la BDD
//-----------------------

//---------------------------------
echo  '<h2> Connexion à la BDD </h2>';
//---------------------------------

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', // driver mysql, serveur de la BDD (host), nom de la BDD(dbname) à changer
               'root', // pseudo de la BDD
               '',     // mdp de la BDD
               array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // option1 : on affiche les erreurs SQL
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // option2 : on définit le jeu de caractères des échanges avec la BDD
               )
);
// $pdo est un objet qui provient de la classe prédéfinie PDO et qui représente la connexion à la BDD

//---------------------------------
echo  '<h2> Requetes avec exec() </h2>';
//---------------------------------
// Nous insérons un employé :

$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES ('test', 'test', 'm', 'test', '2020-08-26', 1500)");

/*
    exec() est utilisé pour la formulation de requetes ne retournant pas de résultat : INSERT, UPDATE, DELETE.

    Valeur de retour :
        Succés : renvoie le nombre de lignes affectées
        Echec :  false
*/
echo "Nombre d'enregistrements affectés par l'INSERT : $resultat <br>";
echo "Dernier ID généré en BDD : " . $pdo->lastInsertId();

//--------
$resultat = $pdo->exec("DELETE FROM employes WHERE prenom = 'test'");
echo "<br>Nombre d'enregistrements affectés par le DELETE : $resultat <br>";

//---------------------------------
echo  '<h2> Requetes avec query() et fetch() pour 1 seul résultat</h2>';
//---------------------------------

$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
/*
    Au contraire de exec(), query() est utilisé pour la formulation de requetes qui retourne un ou plusieurs résultats : SELECT.

    Valeur de retour : 
        Succès : query() retourne un objet qui provient de la classe PDOStatement
        Echec : false
*/
debug($resultat); // $resultat est le resulat de la requete de selection sous forme inexploitable directemtn. On ne voit pas les informations de daniel. Pour accèder à celles-ci il faut utiliser la methode fetch() :

$employe = $resultat->fetch(PDO::FETCH_ASSOC); // la methode fetch() avec la methode PDO::FETCH_ASSOC retourne un tableau associatif exploitable dont les indices correspondent aux noms des champs de la requete. Ce tableau contient les données de daniel
debug($employe);
echo 'Je suis ' . $employe['prenom'] . ' '  . $employe['nom'] . ' du service ' . $employe['service'] . '<br>';

// On peut aussi utiliser les methodes suivantes :
// 1
$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $resultat->fetch(PDO::FETCH_NUM); // pour obtenir un tableau indexé numériquement
debug($employe);
echo 'Je suis ' . $employe[1] . ' '  . $employe[2] . ' du service ' . $employe[4] . '<br>';

// 2
$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $resultat->fetch();  // pour obtenir un mélange de tableau associatif et numérique
debug($employe);
echo 'Je suis ' . $employe[1] . ' '  . $employe[2] . ' du service ' . $employe[4] . '<br>';

// 3 
$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $resultat->fetch(PDO::FETCH_OBJ);  // retourne un objet avec le nom des champs comme proriété public
debug($employe);
echo 'Je suis ' . $employe->prenom . ' '  . $employe->nom . ' du service ' . $employe->service . '<br>';

// Note impossible de faire plusieurs fetch() sur le meme resultat, ce pourquoi nous répétons ici la requete



$resultat = $pdo->query("SELECT prenom, nom, service FROM employes WHERE id_employes = 417");
$employe = $resultat->fetch(PDO::FETCH_ASSOC);
echo 'Je suis ' . $employe['prenom'] . ' '  . $employe['nom'] . ' du service ' . $employe['service'] . '<br>';
debug($employe);


//--------------------------------------------------------------------------
echo  '<h2> Requetes avec query() et fetch() pour plusieurs résultats</h2>';
//--------------------------------------------------------------------------
$resultat = $pdo->query("SELECT * FROM employes");
echo "Nombre d'employes : " . $resultat->rowCount() . '<br>'; // compte le nombre de lignes dans l'objet $resultat (contexte : nombre de produits dans une boutique).

debug($resultat);

//Comme nous avons plusieurs lignes dans $resultat, nous devons faire une boucle pour les parcourir : 
while($employe = $resultat->fetch(PDO::FETCH_ASSOC)) {  // fetch() va chercher la ligne "suivante" du jeu de resultat qu'il retourne en tableau associatif. La boucle while permet de faire avancer le curseur dans la table et s'arrete quand le curseur est a la fin des resultats (quand fetch() retourne false).
    debug($employe); // $employe est un tableau associatif qui conttient les données de 1 employé par tour de boucle

    echo '<div>';
        echo '<div>' .$employe['prenom'] . '</div>';
        echo '<div>' .$employe['nom'] . '</div>';
        echo '<div>' .$employe['service'] . '</div>';
        echo '<div>' .$employe['salaire'] . '€</div>';
    echo '</div><hr>';
}

//--------------------------------------
echo  '<h2> La methode fetchAll() </h2>';
//--------------------------------------

$resultat = $pdo->query("SELECT * FROM employes");

$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC); // fetchAll() retourne toutes les lignes de $resultat dans un tableau multidemnsionnel : on a 1 tableau associatif par employé rangé à chaque indice numérique. Pour info, on peut aussi faire FETCH_NUM pour un sous tableau numérique, ou un fetchAll() sans parametre pour un sous tableau numérique et associatif

debug($donnees); // il s'agit d'un tableau multidimensionnel
echo '<hr>';
//
foreach($donnees as $indice => $employe) { // $employe est lui meme un tableau. On accède donc à ses valeurs par les indices entre [].
    // debug($employe);
    echo '<div>';
        echo '<div>' .$employe['prenom'] . '</div>';
        echo '<div>' .$employe['nom'] . '</div>';
        echo '<div>' .$employe['service'] . '</div>';
        echo '<div>' .$employe['salaire'] . '€</div>';
    echo '</div><hr>';
}


//---- EX
// Version en foreach
$resultat = $pdo->query("SELECT DISTINCT service FROM employes");
$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);

echo '<ul>';
foreach($donnees as $employe) {
        echo '<li>' .$employe['service'] . '</li>';
    }
echo '</ul><hr>';

// Version en while // ne pas oublier de refaire la requete avant un nouveau fetch, sinon on est déjà hors du jeu de résultat et donc il n'y a plus rien à récupérer
$resultat = $pdo->query("SELECT DISTINCT service FROM employes");


echo '<ul>';
while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {  
        echo '<li>' .$donnees['service'] . '</li>';
    }
echo '</ul><hr>';

//--------------------------------------
echo  '<h2> Table HTML </h2>';
//--------------------------------------
// On veut afficher dynamiquement le jeu de résultat sous forme de table HTML

$resultat = $pdo->query("SELECT * FROM employes");
?>
<style>
    table, th, tr, td {
        border: 1px solid;
    }
    table {
        border-collapse: collapse;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

</style>
<?php
echo '<table>';
// affichage de la ligne d'entête :
    echo '<tr>';
        echo '<th>Id</th>';
        echo '<th>Prenom</th>';
        echo '<th>Nom</th>';
        echo '<th>Sexe</th>';
        echo '<th>Service</th>';
        echo '<th>date embauche</th>';
        echo '<th>Salaire</th>';
    echo '</tr>';
    // Affichage des lignes :
    while ($employe = $resultat->fetch(PDO::FETCH_ASSOC)) { // à chaque tour de boucle de while, fetch() va chercher la ligne suivante qui correspond à 1 employé et retourne ses informations sous forme de tableau associatif. Comme il s'agit d'un tableau, nous faisons ensuite une boucle foreach pour le parcourir : 
        echo '<tr>';
            foreach ($employe as $donnee) { // foreach parcourt les données de l'employé, et les affiche en colonne (dans les <td>).
                echo '<td>' .$donnee . '</td>';
            }
        echo '</tr>';
    }
echo '</table>';

//--------------------------------------
echo  '<h2> Requetes préparées </h2>';
//--------------------------------------
// Les requetes préparées sont préconisées si vous exécutez plusieurs fois la meme requete et ainsi éviter de répéter le cycle complet analyse / intrépretation / exécution réalisé par le SGBD (gain de performance)
// Les requetes préparées sont utilisées pour assainir les données (se prémunir des injections SQL) => chapitre ultérieur

$nom = 'Sennard';

//Une requete préparée se réalise en 3 étapes :
// 1- On prépare la requete : 
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom "); // prepare() permet de préparer la requete mais ne l'exécute pas. :nom est un marqueur nominatifqui est vide et attend une valeur

// 2- On lie le marqueur à sa valeur :
$resultat->bindParam(':nom', $nom); // bindParam() lie le marqueur :nom à la variable $nom. Remarque : cette méthode reçoit exclussivement une variable en second argument. On peut pas y mettre une valeur directement

// Ou alors:
$resultat->bindValue(':nom', 'Sennard'); // bindValue() lie le marqueur :nom à la valeur 'Sennard'. Contrairement à bindParam(), bindValue() reçoit au choix une valeur ou une variable

// 3- On exécute la requete : 
$resultat->execute(); // permet d'exécuter une requete préparée avec prepare()

debug($resultat);

$employe = $resultat->fetch(PDO::FETCH_ASSOC);

echo $employe['prenom'] . ' ' .$employe['nom'] . ' du service ' .$employe['service'] . '<br>';

/*
    Valeurs de retour : 
    prepare() retourne toujours un objet PDOStatement.
    execute() :
        Succès : true
        Echec : false
*/


//--------------------------------------
echo  '<h2> Requetes préparées : points complémentaires </h2>';
//--------------------------------------

echo '<h3>Le marqueur sous forme de "?"</h3>';
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = ? AND prenom = ?"); // on prepare la requete avec les parties variables représentées avec des marqueurs sous forme de "?"
$resultat->bindValue(1, 'Durand'); // 1 représente le premier "?"
$resultat->bindValue(2, 'Damien'); // 2 représente le deuxieme "?"
$resultat->execute();

// OU encore directement dans le execute():
$resultat->execute(array('Durand', 'Damien')); // dans l'ordre, "Durand" remplace le 1er "?" et "Damien" le second

/*
    la fleche -> caractèrise les objets : $objet->methode();
    les crochets [] caractérisant les tableaux : $tableau['indice'];
*/
debug($resultat);
$employe = $resultat->fetch(PDO::FETCH_ASSOC);
debug($employe);
echo 'Le service de ' .$employe['prenom']. ' est '.$employe['service'] . '<br>';

//--------
echo '<h3>Lier les marqueurs nominatifs à leur valeur directement dans execute()</h3>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom");

$resultat->execute(array(':nom' => 'Chevel', ':prenom' => 'Daniel')); // on associe chaque marqueur à sa valeur directement dans un tableau. Note : nous ne sommes pas obligés de remettre les ":" devant les marqueurs dans ce tableau
$employe = $resultat->fetch(PDO::FETCH_ASSOC);
echo 'Le service de ' .$employe['prenom']. ' est '.$employe['service'] . '<br>';