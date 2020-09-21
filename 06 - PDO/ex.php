<h1>Les commerciaux et leurs salaire</h1>

<?php
// Exercice :

// 1- affichez dans une liste <ul><li> le prénom, le nom et le salaire des commerciaux (1 commercial par <li>). Pour cela, vous faites une requête préparée.

$service = 'commercial';
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 
               'root', 
               '',    
               array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
               )
);
$liste = $pdo->prepare("SELECT prenom, nom, salaire FROM employes WHERE service = :commercial");
$liste->bindParam(':commercial', $service);
$liste->execute();

$commerciaux = $liste->fetchAll(PDO::FETCH_ASSOC);
echo '<ul>';
    foreach($commerciaux as $employe) {
        echo '<li>' .$employe['prenom'] . ' ' .$employe['nom'] . ' ' .$employe['salaire'].'€</li>';
    }
echo '</ul>';


// 2- Affichez le nombre de commerciaux.

echo "Nombre d'employes du service commercial : " . $liste->rowCount() . '<br>';