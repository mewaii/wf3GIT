
<style>
    h2 {
        border-top: 1px solid navy;
        border-bottom: 1px solid navy;
        color: navy;
    }
    table {
        border: 1px solid red;
        margin: 0 auto;
        width: 80%;
    }
    table td{
        border: 1px solid black;
    }
</style>

<?php

//---------------------------------
echo  '<h2> Les balises PHP </h2>';
//---------------------------------

?>

<p>Ici je suis en HTML</p>

<?php 
// pour ouvrir un passage en PHP on utilise la balise précedente
// pour fermer un passage en PHP on utilise la balise suivante :
?>

<p>Ici je suis en HTML</p>
<!-- en dehors des balises d'ouverutre et fermeture nous sommes en HTML lorque le fichier est en .php -->

<?php 
// Vous n'étes pas obligé de fermé un passage PHP en FIN de script

// pour faire 1 ligne de commentaires
# pour faire 1 ligne de commentaires
/* pour faire plusieurs lignes de commentaires */



//---------------------------------
echo  '<h2> Affichage </h2>';
//---------------------------------

echo 'chaine de caractères <br>'; // echo permet d'effectuer un affichage dans le navigateur. On peut t'y mettre des balises HTML sous forme de string. Toutes les intructions se termine par un ";"

print 'Affichage navigateur <br>'; // autre instruction affichage dans le navigateur

// Autres instructions d'affichage que nous verrons plus loin : 
print_r('code');
echo '<br>';
var_dump('code');


//---------------------------------
echo  '<h2> Variable </h2>';
//---------------------------------
// Une variable est un espace mémoire qui porte un nom et qui permet de conserver une valeur
// En PHP on représente une variable avec le sign $

$a = 127; // On déclare la variable a et lui affecte la valeur 127.
echo gettype($a); // gettype est une fonction prédéfinie qui permet de voir le type d'une variable ici il s'agit d'un INTEGER (entier)
echo '<br>';

$a = 1.5;
echo gettype($a); // ici nous avons un double = float (nombre à virgule) 
echo '<br>';

$a = 'une chaine de caractère';
echo gettype($a); // ici nous avons un STRING
echo '<br>';

$a = '127';  // un nombre écrit dans des quotes ou guillemets est interpréte comme un STRING

$a = true; // ou false
echo gettype($a); // ici nous avons un BOOLEAN
echo '<br>';

// par convention un nom de variable commence par une minuscule, puiis ont met une majuscule à chaque mot (Camel Case). Il peut contenir des chiffres (jamais au début) ou un _ (pas au début ni à la fin). Ex: $maVariable1

//---------------------------------
echo  '<h2> Guillemets et Quotes </h2>';
//---------------------------------
$message = "aujourd'hui"; // ou bien :
$message = 'aujourd\'hui'; // on échappe l'appostrophe dans les quotes simples


$prenom = 'John';
echo "Bonjour $prenom <br>"; // quand on écrit une variable dans des guillemets elle est évaluée : c'est son contenu qui est affiché. Ici "John".
echo 'Bonjour $prenom <br>'; // dans des quotes simples, tout est du texte brut : c'est le nom de la variable qui est affiché

//---------------------------------
echo  '<h2> Concaténation </h2>';
//---------------------------------
// En PHP on concatène les éléments avec le point

$x = 'Bonjour ';
$y = 'tout le monde';
echo $x . $y . '<br>'; // Concaténation de variables et d'un string. On peut traduire le point de concaténation pas "suivi de..."

//-----
// Concaténation lors de l'affectation avec l'opérateur .=
$message = '<p>Erreur sur le champ email</p>';
$message .= '<p>Erreur sur le champ téléphone</p>'; // avec l'opérateur combiné .= on ajoute la nouvelle valeur SANS remplacer la valeur précédente dans la variable $message
echo $message; // on affiche donc les 2 messages    



//---------------------------------
echo  '<h2> Constante </h2>';
//---------------------------------
// Une constante permet de conserver une valeur sauf que celle-ci ne peut pas changer. C'est-a-dire qu'on ne pourra pas la modifier durant l'exécution du script. Utile pour conserver pas exemple les paramètres de connexion à la BDD

define('CAPITALE_FRANCE', 'Paris'); // définit la constante appelée CAPITALE_FRANCE à laquelle on donne la valeur Paris. par convention le nom des constantes est toujours en majuscules
echo CAPITALE_FRANCE . '<br>'; // affiche Paris

// Autre façon :
const TAUX_CONVERSION = 6.55957; // définit la constante TAUX_CONVERSION
echo TAUX_CONVERSION . '<br>'; // affiche 6.55957

// Quelques constantes magiques : 
echo __DIR__ . '<br>'; // contient le chemin complet vers notre dossier
echo __FILE__ . '<br>'; // contient le chemin complet vers notre fichier

//--------
// Exercice : afficher Bleu-Blan-Rouge en mettant le texte de chaque couleur dans une variable.

$couleur = 'Bleu';
$couleur .= '-Blanc-';
$couleur .= 'Rouge';


// echo '<br>';

// echo $couleur . '-' .$couleur2 .'-' .$couleur3 . '<br>';

echo "$couleur-$couleur2-$couleur3 .<br>";


//---------------------------------
echo  '<h2> opérateurs arithmétiques </h2>';
//---------------------------------

$a = 10;
$b = 2;

echo $a + $b . '<br>'; // affiche 12
echo $a - $b . '<br>'; // affiche 8
echo $a * $b . '<br>'; // affiche 20
echo $a / $b . '<br>'; // affiche 5
echo $a % $b . '<br>'; // affiche 0 modulo = reste de la division

//-----
// Les opérateurs arithmétiques combinés : 
$a += $b; // équivaut à $a = $a + $b;
echo $a . '<br>';

$a -= $b; // équivaut à $a = $a - $b;
$a *= $b; // équivaut à $a = $a * $b;
$a /= $b; // équivaut à $a = $a / $b;
$a %= $b; // équivaut à $a = $a % $b;

// on utilisera le += et le -= dans les paniers d'achats

//-----
// Incrémenter et décrementer : 
$i = 0;

$i++; // incrémentation de $i par ajout de 1 : $i vaut donc à la fin 1
$i--; // décrémentation de $i par soustraction de 1 : $i vaut donc à la fin 0


//---------------------------------
echo  '<h2> Structure conditionnelles </h2>';
//---------------------------------
$a = 10;
$b = 5;
$c = 2;

// if ... else : 
if ($a > $b) { // si la condition est vraie, càd que $a > $b alors on entre dans les accolades qui suivent
    echo '$a est superieur à $b <br>';
} else { // sinon, on exécute le else
    echo 'Non, c\'est $b qui est supérieur ou égal à $a <br>';
}


// L'opérateur AND qui s'écrit && :
 if($a > $b && $b > $c) {    // il faut que les 2 valeurs soient vraient pour qu'on rentre dans la condition
    echo 'Vrai pour les 2 conditions <br>';
}
//  TRUE && TRUE => TRUE
//  FALSE && FALSE => FALSE
//  TRUE && FALSE => FALSE

// L'opérateur OR qui s'écrit || :
if($a == 9 || $b > $c) {    // il faut que au moins 1 valeur soit vraie pour qu'on rentre dans la condition
    echo 'Vrai pour au moins une des deux conditions <br>';
} else {
    echo 'Les deux conditions sont fausses <br>';
}

//  TRUE || TRUE => TRUE
//  FALSE || FALSE => FALSE
//  TRUE || FALSE =>  TRUE

//---------
// if ...elseif ... else :

if($a == 9) {   
    echo '$a est égal à 8 <br>';
} elseif ($a != 10) { // sinon si $a est différent de 10
    echo '$a est différent de 10 <br>';
} else {
    echo '$a est égal à 10 <br>';
}


// -------
// L'opérateur XOR pour OU exclusif :
$question1 = 'mineur';
$question2 = 'je vote'; // ex d'un questionnaire

// Les réponses de l'internaute n'étant pas cohérentes, on lui met un message : 
if ($question1 == 'mineur' XOR $question2 == 'je vote') { // XOR = OU exclusif 1 valeur SEULEMENT doit etre TRUE pour rentrer dans la condition
    echo 'Vos réponses sont cohérente <br>';
} else {
    echo 'Vos réponses ne sont pas cohérente <br>';
}

//------
// Forme ternaire de la condition (autre syntaxe du if) :
$a = 10;

echo ($a == 10) ? '$a égal à 10 <br>' : '$a différent de 10 <br>'; // Le ? remplace IF , le : ELSE 

//-----
// Comparaison == ou === : 
$varA = 1; // integer
$varB = '1'; // string

if($varA == $varB) { // == compare la valeur
    echo '$varA est égal à $varB <br>';
}

if($varA === $varB) { // == compare le type et la valeur
    echo '$varA nest pas égal à $varB en valeur <br>';
} else {
    echo 'Les deux variables sont différentes en valeur OU en type';
}

// --------
// isset() et empty() :
// empty() : vérifie si la variable est vide càd 0, '', NULL, false, non définie
// isset() : vérifie si la variable existe et a une valeur non NULL

$var1 = 0;
$var2 = '';

if (empty($var1)) echo '$var1 contient 0, string vide, NULL, false ou n\'est pas définie <br>'; // VRAI car la variable contient 0

if (isset($var2)) echo 'La variable existe et est non NULL <br>'; // VRAIE car la variable existe bien et ne contient pas NULL

// Contexte : empty pour vérifier les champs de formulaire, isset pour vérifier l'existence d'un indice dans un tableau avant d'y accéder.



//------
// L'opérateur NOT qui s'écrit "!" :
$var3 = 'quelque chose';
if (!empty($var3)) { // le ! correspond à une négation : il intervertit le sens du booléen : !true devient false et !false devient true Ici cela signifie "$var3 n'est pas vide"
    echo 'La variable n\'est pas vide <br>';
}

//---------
// L'opérateur ?? appelé NULL coalescent :

echo $variable_inconnue ?? 'valeur par défaut <br>';

//---------------------------------
echo  '<h2> switch </h2>';
//--------------------------------- 
// la condition switch est une autre syntaxe pour écrire un if else if else quand on veut comparer une variable à une multitude de valeurs.

$langue = 'chinois';

switch ($langue) {
    case 'français' : // on compare $langue à la valeur des case et exécute le code qui suit si elle correspond :
        echo 'Bonjour !';
    break; // obligatoire pour quitter le switch une fois case exécuté
    case 'italien' :
        echo 'Ciao !';
    break;
    case 'espagnol' :
        echo 'Hola !';
    break;
    default : // cas par défaut qui est exécuté si on n'entre pas dans l'un des case
        echo 'Hello';
    break;
}
echo '<br>';
// Exercice : réecrire le switch sous conditions if

if ($langue == 'français') {
    echo 'Bonjour !';
} elseif ($langue == 'français') {
    echo 'Ciao !';
} elseif ($langue == 'français') {
    echo 'Hola !';
} else {
    echo 'Hello';
}


//---------------------------------
echo  '<h2> Fonctions utilisateur </h2>';
//---------------------------------
// Une fonction est un morceau de code encapsulé dans des accolades et qui porte un nom. On appelle cette fonction au besoin pour exécuter le code qui s'y trouve.Le fait de définir des fonctions pour ne pas se répéter s'appelle "factoriser" son code

// on définit puis on éxécute une fonction :
function separation () { // déclaration d'une fonction prévue pour ne pas recevoir d'arguments
    echo '<hr>';
}

separation(); // on appelle notre fonction par son nom suivi d'une paire de ()

//------------
// fonction avec parametre et return : 
function bonjour ($prenom, $nom) { // $prenom et $nom sont des paramètres de la fonction. ils permettent de recevoir une valeur
    return 'Bonjour ' .$prenom .' ' .$nom . ' ! <br>'; // return renvoie la chaine de caractère

    echo 'ne s\'affiche pas'; // car après un return on quitte la fonction
}
echo bonjour ('John', 'Doe'); // si la fonction attend des valeurs il faut les lui envoyer dans le meme ordre quez les paramètres de recption. Quand il n'ya pas de echo dans la fonction, il faut le faire en mme temps que l'appel de la fonction


//---
$prenom = 'Pierre';
$nom = 'Quiroule';
echo bonjour($prenom, $nom); // on peut mettre des variables à la place des valeurs dans l'appel d'une fonction


// Exercice :
// - Ecrivez la fonction factureEssence() qui calcule le coût total de votre facture en fonction du nombre de litres d'essence que vous indiquez lors de l'appel de la fonction. Cette fonction retourne la phrase "Votre facture est de X euros pour Y litres d'essence." où X et Y sont des variables. Pour cela, on vous donne une fonction prixLitre() qui vous retourne le prix du litre d'essence. Vous l'utilisez donc pour calculer le total de la facture.


function factureEssence($nombreLitre) {
    return 'Votre facture est de ' .$nombreLitre  *prixLitre().' euros pour ' .$nombreLitre . ' litres ! <br>'; 
}
function prixLitre() {
    return rand(100,200)/100;
}

echo factureEssence(80);

//-------
// En PHP7 on peut préciser le type des valeurs entrantes dans une fonction:

function identite(string $nom, int $age) { // array, bool, float, int, string
    echo gettype($nom) . '<br>'; // string
    echo gettype($age) . '<br>'; // integer
    echo $nom . ' a ' . $age . ' ans <br>';
}

identite('Astérix', 60); // le type attendu dans la fonction est respecté, il n'y a pas d'erreur.
identite('Astérix', '60'); // ici il n'y a pas d'erreur cependant le string '60' a été casté en integer. Si nous étions en mode strict il y aurait une erreur
//identite('Astérix', 'soixante'); // fatal error car on passe un string qui ne peut etre transformé en integer

// En PHP7 on peut aussi préciser la valeur de retour que doit sortir la fonction:
function adulte(int $age) : bool {  // array, bool, float, int, string

    if($age >= 18) {
        return true;
    } else {
        return false;
    }
}

var_dump(adulte(7)); // ici la fonction nous retourne bien un booléen, il n'a donc pas d'erreur. Nous faisons un var_dump car il permet d'afficher le false que retourne la fonction, "echo false" n'affichant rien

echo '<br>';
//----
// Variable locale et variable globale :

// De l'espace local vers l'espace global
function jourSemaine() {
    $jour = 'vendredi'; // var locale
    return $jour;
}
// echo $jour; // ne fonctionne pas car cette variable n'est connue qu'a l'interieur de la fonction
echo jourSemaine() . '<br>'; // on affiche ce que nous retourne la fonction grace à son return


// de l'espace global vers local : 
$pays = 'France'; // variable globale
function affichePays(){
    global $pays; // global permet de recuperer une variable globale au sein de l'espace local de la function
    echo $pays;
}
affichePays();


//---------------------------------
echo  '<h2> Structures itératives (boucles) </h2>';
//---------------------------------
// Les boucles sont destinées à répéter des lignes de codes de façon automatique

// Boucle while :
$i = 0; // on initialise une variable à 0 une variable qui sert de compteur

while ($i < 3) { // tant que i est inférieur à 3 nous entrons dans la boucle
    echo $i . '<br>';
    $i++; // incrémente i à chaque tour pour eviter la boucle infinie
}

// Exercice : à l'aide d'une boucle while, afficher un sélecteur avec les années depuis 1920 jusqu'à 2020.
// rappel :

$année = 1920;
echo '<select>';
while($année <= 2020) { // date('Y') retourne l'année en cours (2020)
    echo '<option>' .$année . '</option>';
    $année++;
}
echo '</select> <br>';


//----
// La boucle do while : 
// La boucle do while a la particularité de s'exécuter au moins une fois puis rant que la condition de fin est vraie
$j = 0;

do {
    echo 'je fais 1 tour <br>';
    $j++;
} while ($j > 10); // la condtion est false et pourtant la boucle a tourné 1 fois
echo '<br>';

//-----
// La boucle for
// La boucle for est une autre syntaxe de la boucle while

for ($i = 0; $i < 3; $i++) {    // nous trouvons dans les () de for : la valeur de départ; la condition d'entrée; la variation de $i
    echo $i . '<br>';
}



echo '<select>';
for ($i = 1; $i < 13; $i++) {    
   echo '<option>' .$i . '</option>';
}
echo '</select>';

//------
// Il existe aussi la boucle foreach que nous verrons, elle sert à parcourir les tableaux ou les objets


//-----
// ex
echo '<br>';

echo '<table>';
    echo '<tr>';
    for($a = 0; $a < 10; $a++) {
        echo '<td>' .$a . '</td>';
    }
    echo '</tr>';
echo '</table>';

echo '<br>';

//----
// Ex :


// principe de la boucle imbriquée
echo '<table>';

for($a = 0; $a < 11; $a++) {
    echo '<tr>';
    for($i = 0; $i < 10; $i++) {
        echo '<td>' .$i . '</td>';
    }
    echo '</tr>';
}

echo '</table>';

//---------------------------------
echo  '<h2> Quelques fonctions prédéfinies </h2>';
//---------------------------------
// Une fonction prédéfinie permet de réaliser un traitemeent spécifique prédéterminé dans le langage PHP

// strlen
$phrase = 'une phrase';
echo strlen($phrase) .'<br>'; // a&ffiche le nombre d'octets occupés par ce string, 1 caractère accentué comptant pour 2, les autres pour 1


// substr
$texte = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis soluta totam, iste ut earum facere asperiores, sint veniam ratione quaerat eligendi id consequuntur, illo vitae neque exercitationem nostrum molestias illum.';
echo substr($texte, 0, 20) . '...<a href="">lire la suite</a>'; // coupe le texte de la position 0 et sur 20 caractères

echo '<br>';

// strlower, strtoupper, trim :
$message = '        Hello World !       ';
echo strtolower($message). '<br>' ; // affiche tout en minusucules
echo strtoupper($message). '<br>' ; // affiche tout en majusucules

echo strlen($message). '<br>' ; // compte la longueur y comprit les espaces
echo strlen(trim($message)). '<br>' ; // trim() supprime les espaces au début et à la fin de la chaine ici on compte le résultat sans les espâces

// La documentation PHP en ligne : 
// https://www.php.net/


//---------------------------------
echo  '<h2> Tableaux (arrays) </h2>';
//---------------------------------
//  Un tableau (array)  est déclaré comme une variable ameliorée dans laquelle on stocke une multitude de valeur Ces valeurs peuvent etre de n'importe quel type et possèdent un indice par défaut dont la numérotation commence à 0

// utilisation : souvent quand on récupère des info de la BDD, on les retrouve sous forme de array

// Déclarer un tableau (méthode 1)
$liste = array('Grégoire', 'Nathalie', 'Emilie', 'François', 'Georges');

echo gettype($liste) . '<br>';  // type array

echo $liste; // erreur de type "Array to string conversion" car on ne peut pas afficher directement un tableau

echo 'var_dump et print_r :';
echo '<pre>';
    var_dump($liste);  // affiche le contenu du tableau avec le type des valeurs
echo '</pre>';

echo '<pre>';
    print_r($liste);  // affiche le contenu du tableau sans le type des valeurs
echo '</pre>';  // la balise <pre> permet de formater l'affichage du print_r ou du var_dump


// Déclaration de notre fonction d'affichage :
function debug($var) {
    echo '<pre>';
        print_r($var); 
    echo '</pre>';
} 

debug($liste);

// Déclarer un tableau (méthode 2) :
$tab = ['France', 'Italie', 'Espagne', 'Portugal'];
debug($tab);

echo $tab[1] . '<br>'; // pour afficher "Italie", on écrit le nom du tableau $tab suivi de l'indice de "Italie" écrit entre []

//----
// Ajouter une valeur à la fin de notre $tab :
$tab[] = 'Suisse'; // les [] vides permettent d'ajouter une valeur à la fin du tableau
debug($tab);

//-----
// Tableau associatif :
// Dans un tableau associatif, on peut choisir les indices.
$couleur = array(
    'j' => 'jaune',
    'b' => 'bleu',
    'v' => 'vert'
);

// pour afficher un élément du tableau associatif :
    echo 'La seconde couleur de notre tableau est le ' . $couleur['b'] . '<br>'; // affiche "bleu"

    echo "La seconde couleur de notre tableau est le $couleur[b] <br>"; // un tableau associatif écrit dans des guillemets perd les quotes autour de son indice

//------
// Mesurer le nombre d'éléments dans un tableau :
echo 'Taille du tableau : ' . count($couleur) . '<br>'; // compte le nombre d'éléments dans le tableau
echo 'Taille du tableau : ' . sizeof($couleur) . '<br>'; // compte le nombre d'éléments dans le tableau comme count

//---------------------------------
echo  '<h2> Boucle foreach </h2>';
//---------------------------------
// foreach est un moyen simple de parcourir un tableau de foçon automatique. Cette boucle fonctionne uniquement sur les tableaux et objets, retourne une erreur si elle utilisée sur variable d'un autre type ou non-initialisée

debug($tab);

foreach ($tab as $pays) { // la variable $pays vient parcourir la colonne des valeurs: elle prend chaque valeur successivement à chaque tour de boucle le mot as est obligatoire et fait partit de la syntaxe
    echo $pays . '<br>'; // affiche successivement les valeurs du tablau
}

foreach ($tab as $indice => $pays) { // quand il y a 2 variables, celle qui est à gauche de la => parcourt la colonne des indices, et celle de droite parcourt la colonne des valeurs
    echo $indice . ' correspond à ' .$pays . '<br>'; 
}

// Exercice : 
// - Ecrivez un tableau associatif avec les INDICES prenom, nom, email et telephone, auxquels vous associez des valeurs pour 1 contact.

$form = array(
    'prenom' => 'Mehoué',
    'nom' => 'Traoré',
    'email' => 'fe@gmail.com',
    'telephone' => '0758649574'
);

// - Puis avec une boucle foreach, affichez les valeurs dans des <p>, sauf le prénom qui doit être dans un <h3>.

foreach ($form as $indice => $value) { 

    if($indice == 'prenom') {
        echo '<h3> Bonjour' .$value. '</h3> <br>';
    }
    else {
        echo "<p>" .$value . "</p> <br>"; 
    }
}

//---------------------------------
echo  '<h2> Tableau multidimensionnel </h2>';
//---------------------------------
// Nous parlons de tableaux multidemensionnel quand un tableau est contenu dans un autre tableau chaque tableau représente une dimension

// Déclaration d'un tableau multidimensionnel :
$tab_multi = array(
    array(
        'prenom' => 'Julien',
        'nom' => 'Dupond',
        'telephone' => '20544454'
    ),
    array(
        'prenom' => 'Nicolas',
        'nom' => 'Duran',
        'telephone' => '2048444454'
    ),
    array(
        'prenom' => 'Pierre',
        'nom' => 'Dulac'
    ),
); // il est possible de choisir le nom des indices dans un tableau multidimensionnel
debug($tab_multi);

// afficher la valeur "Julien" :
echo $tab_multi[0]['prenom'] . '<hr>'; // pour afficher "Julien" nous entrons d'abord dans le tableau $tab_multi, puis nous allons à son indice [0], dans lequel nous allons à l'indice ['prenom'] (crochets successifs)

// Parcourir le tableau multidimensionnel avec une boucle for:
for($i = 0; $i < sizeof($tab_multi); $i++) { // tant que $i est inférieur au nombre d'éléments du tableau $tab_multi on entre dans la boucle
    echo $tab_multi[$i]['prenom'] . '<br>'; // on passe successivement par 0, 1, 2 pour afficher les 3 prénoms
}

echo '<hr>';

// Ex: afficher les 3 prénoms avec une boucle foreach
foreach ($tab_multi as $indice => $value) { 

    echo $tab_multi[$indice]['prenom'] . '<br>';
}

echo '<hr>';

foreach ($tab_multi as $indice => $value) { 
    
}
// Autre version:
foreach($tab_multi as $contact) {
    // debug($contact); // on voit que $contact est un rray qui contient l'indice "prenom". On accède donc aux prénoms en mettant cet indice dans [] : 
    echo $contact['prenom'] . '<br>';
}

//------
// Exercice (option) : vous déclarez un tableau contenant les tailles S, M, L et XL. Puis vous les affichez dans un menu déroulant (select/option) à l'aide d'une boucle foreach.

//---------------------------------
echo  '<h2> Inclusion de fichiers </h2>';
//---------------------------------

echo 'Premiere inclusion : ';
include 'exemple.inc.php'; // le fichier est inclus càd que son code s'exécute ici En cas d'erreur lors de l'inclusion, include génère une erreur de type "warning" et continue l'exécution du script

echo '<br> Seconde inclusion : ';
include_once 'exemple.inc.php'; // le "once" est là pour vérifier si le fichier a déjà été inclus, auquel cas il ne le ré-inclus pas

echo '<br> Troisième inclusion : ';
require 'exemple.inc.php'; // le fichier est "requis", donc obligatoire : en cas d'erreur lors de l'inclusion, require génère une erreur de type "fatal error" qui stoppe l'éxécution du code

echo '<br> Quatrième inclusion : ';
require_once 'exemple.inc.php'; // le "once" est là pour vérifier si le fichier a déjà été inclus, auquel cas il ne le ré-inclus pas

echo '<br><br>' . $inclusion; // comme le fichier exemple.inc.php est inclus, on accède aux éléments qui sont déclarés à l'intérieur de celui-ci, comme les variables, les fonctions

// La fonction "inc" dans le nom du fichier précise aux développeurs qu'il s'agit d'un fichier d'inclusion, et non pas d'une page à part entière

//---------------------------------
echo  '<h2> Introduction aux objets </h2>';
//---------------------------------
//  Un objet ets un autre type de données (object en anglais). Il représente un objet réel (par ex voiture, membre,panier d'achat, produit...) auquel on peut associer des variables, appelées PROPRIETES, et de fonctions appelées METHODES.

// Pour créer des objets, il nous faut un "plan de construction" : c'est le role de la classe. 
// Nous créeons ici une classe pour faire des objets "meubles" :

class Meuble { // avec une majuscule

    public $marque = 'ikea'; //$marque est une propriété. "public" précise qu'elle sera accessible partout.

    public function prix() { // prix() est une methode
        return rand(50, 200) . ' €';
    }
}

//--------------
$table = new Meuble(); // new est un mot clé qui permet d'instancier la classe pour en faire un objet.L'intérêt est que notre $table bénéficie de la propriété "ikea" et de la méthode prix() définis dans la classe
debug($table); // nous observons le type object,le nom de sa classe "Meuble" et sa propriété "marque"
echo 'Marque du meuble : ' . $table->marque . '<br>'; // pour accéder à la propriété d'un objet, on écrit cet objet suivi de la fleche -> puis du nom de la propriété sans le $

echo 'Prix du meuble : ' . $table->prix() . '<br>'; // pour accéder à la méthode d'un objet, on l'écrit après la fleche -> à laquelle on ajoute une paire de ()