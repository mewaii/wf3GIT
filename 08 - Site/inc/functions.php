<?php
// Fonction du site

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

//-------------------
// Fonction qui indique si l'inernaute est connecté
function estConnecte(){
    if(isset($_SESSION['membre'])) { // si "membre" existe dans la session, c'est que l'internaute est passé par la page de connexion avec les bons pseudo / mdp
        return true; // il est connecté
    } else {
        return false; // il n'est pas connecté
    }
}

// fonction qui indique si le membre connecté est administrateur
function estAdmin(){
    if(estConnecte() && $_SESSION['membre']['statut'] == 1) { // si le membre est connecté alors on regarde son statut dans la session. S'il vaut 1 alors il est admin
        return true; // le membre est admin connecté
    } else {
        return false; // il ne l'est pas
    }
}

//------
// Fonction qui exécute les requete

function executeRequete($requete, $param = array()) { // le parametre $requete reçoit une requete SQL. Le parametre $param reçoit un array avec les marqueurs associés à leur valeur. Dans le cas ou ce array n'est pas fourni, $param prend un array() vide par défaut

    // Echappement des données avec htmlspecialchars() :
    foreach($param as $indice => $valeur) {
        $param[$indice] = htmlspecialchars($valeur); // on prend la valeru de $paramque l'on passe dans htmlspecialchars() pour transformer des chevrons en entités HTML qui neutralsient les balises style et script eventuellement injectées dans le form. Evite les risques XSS et CSS. Puis on range cette valeur "échappée" dans son emplacement d'origine qui est $param[$indice] 
    }

    global $pdo; // permet d'accéder à la variable $pdo qui est déclarée dans init.php autrement dit dans l'espace global (espace local ici)
    $resultat = $pdo->prepare($requete); // on prépare la requete reçue dans $requete
    $succes = $resultat->execute($param); // puis on l'exécute en lui donnant un tableau qui associe les marqueurs à leur valeur
    
    // var_dump($succes); // exectue() renvoie toujpours un booléen : true quand la requete a marché, sinon false.

    if ($succes) { // si $succes contient true (la requete à marché), je retourne alors $resultat qui contient le jeu de resultat du SELECT(objet PDOStatement).
        return $resultat;
    } else {
        return false; // sinon, si erreur sur la requete on retourne false
    }
}

//-------
// Fonction qui calcule le TOTAL du panier

function montantTotal() {
    $total = 0;

    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) {
        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i]; // on multiplie la quantité par le prix à chaque tour de boucle que l'on ajoute dans $total avec l'opérateur += pour ne pls remplacer la dernière valeur
    }
    
    return $total; // pour sortir la valeur de $total de la fonction et la retourner à l'endroit ou on appelle cette fonction (dans le panier).
}