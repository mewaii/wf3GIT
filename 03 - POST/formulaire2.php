<?php
// Exercice :
// - Créer un formulaire avec les champs "ville", "code postal" et une zone de texte "adresse" dans cette page formulaire2.php.
// - Afficher les données saisies par l'internaute dans la page formulaire2-traitement.php.
// echo '<a href="formulaire2-traitement.php?action=formulaire2-traitement.php">resultat</a>';
?>
<form method="post" action="formulaire2-traitement.php">

    <div><label for="ville">ville</label></div>
    <div><input type="text" name="ville" id="ville"></div>

    <div><label for="cp">cp</label></div>
    <div><input type="text" name="cp" id="cp"></div>

    <div><label for="adresse"></label>adresse</div>
    <div><textarea name="adresse" id="adresse" cols="30" rows="10"></textarea></div>

    <div><input type="submit" value="envoyer"></div>
</form>