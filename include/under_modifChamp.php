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
    if($tournoiX->getNbreJoueurs()==8){
        Tournoi::misAJourMatchFinale($idCompet, intval($_POST['vainq']),$bdd);
    }
    elseif ($tournoiX->getNbreJoueurs()==10){
        Tournoi::misAJourMatchFausseFinale($idCompet, intval($_POST['vainq']),$bdd);
    }

}
elseif ($typeMatch == 'poule'){
    Tournoi::misAJourMatchPoule($idCompet, intval($_POST['vainq']), $bdd);
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
/*
$reqPoule = $bdd->prepare('SELECT * FROM equipes WHERE id_Equipe =?');
$reqPoule->execute(array(intval($_POST['vainq'])));

while($donnees = $reqPoule->fetch()) {
    $pointsPoules = $donnees['pointsPoule']+1;
    $updPointsPoule = $bdd->prepare('UPDATE equipes SET pointsPoule = :pointsPoule WHERE id_Equipe = :id_Equipe');
    $updPointsPoule->execute(array(
        'id_Equipe'=>(intval($_POST['vainq'])),
        'pointsPoule'=>$pointsPoules
    ));
}
$reqPoule->closeCursor();


//ON PREPARE LA FIN DES MATCHS DE POULE
$reqFinPoules = $bdd->prepare('SELECT * FROM matchs WHERE id_compet = :id_compet AND type_match = :type_match');
$reqFinPoules->execute(array(
    'id_compet'=>$idCompet,
    'type_match'=>'poule'
));
$poulesTerminees=true;
while($donnees=$reqFinPoules->fetch()){
    if($donnees['vainqueur']==null){
        $poulesTerminees=false;
    }

}
$reqFinPoules->closeCursor();
//SI POULES TERMINEES
if($poulesTerminees){
    $premiereEquipe= array();
    $reqEquipesPoules=$bdd->prepare('SELECT * FROM equipes WHERE id_compet= :id_compet AND pointsPoule = (SELECT MAX(pointsPoule) FROM equipes WHERE id_compet= :id_compet2)');
    $reqEquipesPoules= $bdd->execute(array(
        'id_compet'=>$idCompet,
        'id_compet2'=>$idCompet
    ));
    while($donnees2=$reqEquipesPoules->fetch()){
        $premiereEquipe[]= Equipe::findEquipe(($donnees2['id_Equipe']),$bdd);
         }$reqEquipesPoules->closeCursor();
    if(count($premiereEquipe)>1){

    }


}

*/
header('location:../championnat.php?idC='.$idCompet);



?>