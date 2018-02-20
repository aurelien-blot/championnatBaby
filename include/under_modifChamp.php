<?php
include 'utilCompil.php';
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

while($donnees2 = $reqIdCompetM->fetch()) {

    if ($donnees2['type_match'] == "finale") {

        $idFinale = $donnees2['id_Match'];

        if ($donnees2['equipe1'] == null) {
            $insEquipe1F = $bdd->prepare('UPDATE matchs SET equipe1 = :equipe1 WHERE id_Match = :id_Match');
            $insEquipe1F->execute(array(
                'equipe1' => intval($_POST['vainq']),
                'id_Match' => $idFinale
            ));
            $insEquipe1F->closeCursor();
        } elseif (($donnees2['equipe2'] == null) AND ($donnees2['equipe1'] != intval($_POST['vainq']))) {
            $insEquipe2F = $bdd->prepare('UPDATE matchs SET equipe2 = :equipe2 WHERE id_Match = :id_Match');
            $insEquipe2F->execute(array(
                'equipe2' => intval($_POST['vainq']),
                'id_Match' => $idFinale
            ));
            $insEquipe2F->closeCursor();
        } else {
            echo("Il y a déjà des finalistes");
        }

    }
}

$reqIdCompetM->closeCursor();


//echo("ca marche ?");
header('location:../championnat.php?idC='.$idCompet);



?>