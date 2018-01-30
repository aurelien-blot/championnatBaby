<?php
include 'connexionBdd.php';
$insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

$insModifScore->execute(array(
    'vainqueur'=> intval($_POST['vainq']),
    'butEquipe1'=> intval($_POST['butEquipe1']),
    'butEquipe2'=> intval($_POST['butEquipe2']),
    'id_Match' => intval($_GET['modifM'])
));
$insModifScore->closeCursor();

$reqIdCompetM = $bdd->prepare('SELECT * FROM matchs WHERE id_Match =?');
$reqIdCompetM->execute(array(intval($_GET['modifM'])));

while($donnees = $reqIdCompetM->fetch()) {
    $idCompet = $donnees['id_compet'];
}
$reqIdCompetM = $bdd->prepare('SELECT * FROM competitions JOIN matchs ON competitions.id_competition = matchs.id_compet WHERE id_compet =? ');
$reqIdCompetM->execute(array($idCompet));

while($donnees2 = $reqIdCompetM->fetch()){
}


echo("ca marche ?");
//header('location::championnat.php?modifM='.$_GET['modifM']);



?>