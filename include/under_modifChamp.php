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

//insertion des equipes dans les matchs au dessus
$matchZ = Match::findMatch($_GET['modifM'],$bdd);
$idCompet = $matchZ->getIdCompetMatch();
$typeMatch= $matchZ->getTypeMatch();
$tournoiX=Tournoi::findTournoi($idCompet,$bdd);

if($typeMatch=='demi'){
    if($tournoiX->getNbreJoueurs()==8 OR $tournoiX->getNbreJoueurs()==12){
        Tournoi::misAJourMatchFinale($idCompet, intval($_POST['vainq']),$bdd);
    }
    elseif ($tournoiX->getNbreJoueurs()==10){
        Tournoi::misAJourMatchFausseFinale($idCompet, intval($_POST['vainq']),$bdd);
    }

}
elseif ($typeMatch == 'poule'){
    if($tournoiX->getNbreJoueurs()==12){
        Tournoi::misAJourMatchPoule12($idCompet, intval($_POST['vainq']),$bdd);
    }
    elseif ($tournoiX->getNbreJoueurs()==10) {
        Tournoi::misAJourMatchPoule($idCompet, intval($_POST['vainq']), $bdd);
    }
}
elseif ($typeMatch == 'fausseFinale'){
    Tournoi::misAJourMatchFinale($idCompet, intval($_POST['vainq']),$bdd);
}



$reqFinaleTerminee=$bdd->prepare('SELECT * FROM competitions JOIN matchs ON competitions.id_competition = matchs.id_compet WHERE id_compet =? ');
$reqFinaleTerminee->execute(array($idCompet));

while($donnees3=$reqFinaleTerminee->fetch()) {
    if ($donnees3['type_match'] == "finale") {
        if ($donnees3['vainqueur'] != null) {
            $reqCompetFinie = $bdd->prepare('UPDATE competitions SET terminee= :terminee WHERE id_competition = :id_competition');
            $reqCompetFinie->execute(array(
                'id_competition' => $idCompet,
                'terminee' => 1
            ));
        }
    }
}
$reqFinaleTerminee->closeCursor();
header('location:../championnat.php?idC='.$idCompet);



?>