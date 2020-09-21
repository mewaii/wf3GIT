<?php
require_once 'inc/init.php';
$affiche_formulaire = true; // pour afficher le formulaire tant que le membre n'est pas inscrit

//---- TRAITEMENT PHP----
debug($_POST);

if(!empty($_POST)) { // si $_POST n'est pas vide c'est que le forma été envoyé
    // Validation du form :
    if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20){ // si le pseudo n'existe pas dans $_POST c'est que le form est altéré, ou si sa valeur est inférieure à 4 ou si sa valeur est supérieure à 20 (pour la BDD), on met un message erreur à l'internaute 
        $contenu .= '<div class="alert alert-danger">Le pseudo doit contenir entre 4 et 20 caractères.</div>';
    }
    if (!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20){ 
        $contenu .= '<div class="alert alert-danger">Le mot de passe doit contenir entre 4 et 20 caractères.</div>';
    }
    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 1 || strlen($_POST['nom']) > 20){ 
        $contenu .= '<div class="alert alert-danger">Le nom doit contenir entre 1 et 20 caractères.</div>';
    }
    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 1 || strlen($_POST['prenom']) > 20){ 
        $contenu .= '<div class="alert alert-danger">Le prénom doit contenir entre 1 et 20 caractères.</div>';
    }
    if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || strlen($_POST['email']) > 50){ // la fonction predéfinie filter_var() avec l'argument FILTER_VALIDATE_EMAIL vérifie que le string fourni est un email
        $contenu .= '<div class="alert alert-danger">L\'email n\'est pas valide.</div>';
    }
    if (!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville']) > 20){ 
        $contenu .= '<div class="alert alert-danger">La ville doit contenir entre 1 et 20 caractères.</div>';
    }
    if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse']) > 50){ 
        $contenu .= '<div class="alert alert-danger">L\'adresse doit contenir entre 1 et 50 caractères.</div>';
    }
    if (!isset($_POST['civilite']) || ($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f')) { 
        $contenu .= '<div class="alert alert-danger">La civilité n\'est pas valide.</div>';
    }
    if (!isset($_POST['cp']) || !preg_match('#^[0-9]{5}$#', $_POST['cp'])){ 
        $contenu .= '<div class="alert alert-danger">Le code postal n\'est pas valide.</div>';
    }

    //------
    // Si il n'y a plus d'erreur sur le form on vérifie si le pseudo existe ou pas avant d'inscrire l'internaute en BDD :
    if(empty($contenu)) { // si la variable est vide c'est qu'il n'y a pas de message d'erreur
        // On vérifie le pseudo en BDD :
        $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));

        if($resultat->rowCount() > 0){ // si la requete retourne une ou plusieurs lignes c'est que le pseudo est déjà en BDD
            $contenu .= '<div class="alert alert-danger">Pseudo indisponible veuillez en choisir un autre.</div>';
        } else {
            // sinon fait l'inscritpion en BDD
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // nous hachons le mot de passe avec l'algorithme bcrypt par défaut qui nous retourne une clé de hachage. Nous allons k'insérer en BDD.
            // debug($mdp);
            $succes = executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :cp, :adresse, :statut)", array(':pseudo' => $_POST['pseudo'],
                                                                        ':mdp' => $mdp, // on prend le mdp haché                                                                       
                                                                        ':nom' => $_POST['nom'],
                                                                        ':prenom' => $_POST['prenom'],
                                                                        ':email' => $_POST['email'],
                                                                        ':civilite' => $_POST['civilite'],
                                                                        ':ville' => $_POST['ville'],
                                                                        ':cp' => $_POST['cp'],
                                                                        ':adresse' => $_POST['adresse'],
                                                                        ':statut' => 0 // 0 pour un membre non admin
        
        ));
        
        $contenu .= '<div class="alert alert-success">Vous êtes inscrit. <a href="connexion.php">Cliquez ici pour vous connecter.</a></div>';
        $affiche_formulaire = false; // pour ne plus afficher le form d'inscription ci-dessous
        }
    }
}

require_once 'inc/header.php';
?>
<h1 class="mt-4">Inscription</h1>
<?php
echo $contenu; // pour les messages à l'internaute
if ($affiche_formulaire) : // syntaxe en if (): ... endif; ou le ":" correspond à l'accolade ouvrante et le endif à la fermante. Si le membre n'est pas inscrit, on lui affiche le form
?>

    <form action="" method="post">
        <div><label for="pseudo">Pseudo</label></div>
        <div><input type="text" id="pseudo" name="pseudo" value="<?php echo $_POST['pseudo'] ?? ''; ?>"></div>

        <div><label for="mdp">Mot de passe</label></div>
        <div><input type="password" id="mdp" name="mdp" value="<?php echo $_POST['mdp'] ?? ''; ?>"></div>

        <div><label for="nom">Nom</label></div>
        <div><input type="text" id="nom" name="nom" value="<?php echo $_POST['nom'] ?? ''; ?>"></div>

        <div><label for="prenom">Prénom</label></div>
        <div><input type="text" id="prenom" name="prenom" value="<?php echo $_POST['prenom'] ?? ''; ?>"></div>

        <div><label for="email">Email</label></div>
        <div><input type="text" id="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>"></div>

        <div><label>Civilité</label></div>
        <div>
            <input type="radio" name="civilite" value="m" checked>Masculin
            <input type="radio" name="civilite" value="f" <?php if(isset($_POST['civilite']) && $_POST['civilite'] == 'f') echo 'checked'; ?>>Féminin
        </div>

        <div><label for="ville">Ville</label></div>
        <div><input type="text" id="ville" name="ville" value="<?php echo $_POST['ville'] ?? ''; ?>"></div>

        <div><label for="cp">Code postal</label></div>
        <div><input type="text" id="cp" name="cp" value="<?php echo $_POST['cp'] ?? ''; ?>"></div>

        <div><label for="adresse">Adresse</label></div>
        <div><textarea name="adresse" id="adresse" cols="30" rows="10"><?php echo $_POST['adresse'] ?? ''; ?>"</textarea></div>

        <div><input type="submit" value="S'inscrire" class="btn btn-info"></div>
    </form>

<?php
endif;
require_once 'inc/footer.php';
