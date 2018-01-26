<?php
include 'connexionBdd.php';
$insModifScore = $bdd->prepare('INSERT INTO matchs (vainqueur, butEquipe1, butEquipe2) VALUES(:vainqueur, :butEquipe1, :butEquipe2) WHERE id_Match = ');
$insModifScore->execute(array(
    'vainqueur'=> intval($_POST['vainq']),
    'butEquipe1'=> intval($_POST['butEquipe1']),
    'butEquipe2'=> intval($_POST['butEquipe2'])
));

echo("ca marche ?");

?>