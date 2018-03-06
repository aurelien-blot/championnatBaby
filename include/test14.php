<?php

include 'utilCompil.php';

//TEST DONNNEES
$nbreJoueurs =14;
$tournoiX = new Tournoi('testAlaCon',$nbreJoueurs, '2018-01-01',$bdd);
$tournoiX->insererTournoi($bdd);

// joueurs pour test
$j1 = Joueur::findJoueur(1, $bdd);
$j2 = Joueur::findJoueur(2, $bdd);
$j3 = Joueur::findJoueur(3, $bdd);
$j4 = Joueur::findJoueur(4, $bdd);
$j5 = Joueur::findJoueur(5, $bdd);
$j6 = Joueur::findJoueur(6, $bdd);
$j7 = Joueur::findJoueur(7, $bdd);
$j8 = Joueur::findJoueur(8, $bdd);
$j9 = Joueur::findJoueur(9, $bdd);
$j10 = Joueur::findJoueur(10, $bdd);

/*
$j1 = Joueur::findJoueur($_POST['joueur1'], $bdd);
$j2 = Joueur::findJoueur($_POST['joueur2'], $bdd);
$j3 = Joueur::findJoueur($_POST['joueur3'], $bdd);
$j4 = Joueur::findJoueur($_POST['joueur4'], $bdd);
$j5 = Joueur::findJoueur($_POST['joueur5'], $bdd);
$j6 = Joueur::findJoueur($_POST['joueur6'], $bdd);
$j7 = Joueur::findJoueur($_POST['joueur7'], $bdd);
$j8 = Joueur::findJoueur($_POST['joueur8'], $bdd);
*/
$tournoiX->ajouterJoueur($j1);
$tournoiX->ajouterJoueur($j2);
$tournoiX->ajouterJoueur($j3);
$tournoiX->ajouterJoueur($j4);
$tournoiX->ajouterJoueur($j5);
$tournoiX->ajouterJoueur($j6);
$tournoiX->ajouterJoueur($j7);
$tournoiX->ajouterJoueur($j8);

if($nbreJoueurs>=10){
    //$j9 = Joueur::findJoueur($_POST['joueur9'], $bdd);
    //$j10 = Joueur::findJoueur($_POST['joueur10'], $bdd);
    $j9 = Joueur::findJoueur(9, $bdd);
    $j10 = Joueur::findJoueur(10, $bdd);
    $tournoiX->ajouterJoueur($j9);
    $tournoiX->ajouterJoueur($j10);
}
if($nbreJoueurs>=12){
    //$j11 = Joueur::findJoueur($_POST['joueur11'], $bdd);
    //$j12 = Joueur::findJoueur($_POST['joueur12'], $bdd);
    $j11 = Joueur::findJoueur(11, $bdd);
    $j12 = Joueur::findJoueur(12, $bdd);
    $tournoiX->ajouterJoueur($j11);
    $tournoiX->ajouterJoueur($j12);
}
if($nbreJoueurs>=14){
    //$j13 = Joueur::findJoueur($_POST['joueur13'], $bdd);
    //$j14 = Joueur::findJoueur($_POST['joueur14'], $bdd);
    $j13 = Joueur::findJoueur(13, $bdd);
    $j14 = Joueur::findJoueur(14, $bdd);
    $tournoiX->ajouterJoueur($j13);
    $tournoiX->ajouterJoueur($j14);
}


$tournoiX->creerEquipes($bdd);

$tournoiX->organiserMatchs($bdd);
//ON MET A JOUR LES MATCHS
function creerEquipesetMajMatch($departIdEquipe, $departIdmatch, $tournoiX, $bdd){
    $iDe1=intval($departIdEquipe);
    $iDe2=$iDe1+1;
    $iDe3=$iDe2+1;
    $iDe4=$iDe3+1;
    $iDe5=$iDe4+1;
    $iDe6=$iDe5+1;
    $iDe7=$iDe6+1;
    $e1=Equipe::findEquipe($iDe1,$bdd);
    $e2=Equipe::findEquipe($iDe2,$bdd);
    $e3=Equipe::findEquipe($iDe3,$bdd);
    $e4=Equipe::findEquipe($iDe4,$bdd);
    $e5=Equipe::findEquipe($iDe5,$bdd);
    $e6=Equipe::findEquipe($iDe6,$bdd);
    $e7=Equipe::findEquipe($iDe7,$bdd);

    //MATCH 1
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe1),
        'butEquipe1'=> intval(0),
        'butEquipe2'=> intval(0),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe1, $bdd);

    //MATCH 2
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe1),
        'butEquipe1'=> intval(0),
        'butEquipe2'=> intval(0),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe1, $bdd);

    //MATCH 3
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe1),
        'butEquipe1'=> intval(0),
        'butEquipe2'=> intval(0),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe1, $bdd);

    //MATCH 4
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe1),
        'butEquipe1'=> intval(0),
        'butEquipe2'=> intval(0),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe1, $bdd);

    //MATCH 5
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe1),
        'butEquipe1'=> intval(0),
        'butEquipe2'=> intval(0),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe1, $bdd);

    //MATCH 6
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe1),
        'butEquipe1'=> intval(0),
        'butEquipe2'=> intval(0),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe1, $bdd);

    //MATCH 7
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe2),
        'butEquipe1'=> intval(4),
        'butEquipe2'=> intval(5),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe2, $bdd);

    //MATCH 8
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe2),
        'butEquipe1'=> intval(6),
        'butEquipe2'=> intval(9),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe2, $bdd);

    //MATCH 9
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe2),
        'butEquipe1'=> intval(3),
        'butEquipe2'=> intval(9),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe2, $bdd);

    //MATCH 10
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe3),
        'butEquipe1'=> intval(4),
        'butEquipe2'=> intval(0),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe3, $bdd);

    //MATCH 11
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe3),
        'butEquipe1'=> intval(1),
        'butEquipe2'=> intval(2),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe3, $bdd);

    //MATCH 12
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe3),
        'butEquipe1'=> intval(9),
        'butEquipe2'=> intval(4),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe3, $bdd);

    //MATCH 13
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe4),
        'butEquipe1'=> intval(2),
        'butEquipe2'=> intval(0),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe4, $bdd);

    //MATCH 14
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe4),
        'butEquipe1'=> intval(3),
        'butEquipe2'=> intval(1),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe4, $bdd);

    //MATCH 15
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe4),
        'butEquipe1'=> intval(4),
        'butEquipe2'=> intval(5),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe4, $bdd);

    //MATCH 16
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe5),
        'butEquipe1'=> intval(0),
        'butEquipe2'=> intval(0),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe5, $bdd);

    //MATCH 17
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe5),
        'butEquipe1'=> intval(1),
        'butEquipe2'=> intval(3),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe5, $bdd);

    //MATCH 18
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe5),
        'butEquipe1'=> intval(4),
        'butEquipe2'=> intval(2),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe5, $bdd);

    //MATCH 19
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe5),
        'butEquipe1'=> intval(10),
        'butEquipe2'=> intval(7),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe5, $bdd);

    //MATCH 20
    $insModifScore = $bdd->prepare('UPDATE matchs SET vainqueur = :vainqueur, butEquipe1 = :butEquipe1, butEquipe2=:butEquipe2 WHERE id_Match = :id_Match');

    $insModifScore->execute(array(
        'vainqueur'=> intval($iDe1),
        'butEquipe1'=> intval(5),
        'butEquipe2'=> intval(3),
        'id_Match' => intval($departIdmatch)
    ));
    $departIdmatch++;
    $insModifScore->closeCursor();
    Tournoi::misAJourMatchPoule14($tournoiX->getIdCompet(), $iDe1, $bdd);

}

$departEquipe =1283;//+7
$idCompet= 320108;//+1
$match0 = 1537;//+24
creerEquipesetMajMatch($departEquipe, $match0,$tournoiX,$bdd);


header('location:../modifChampionnat.php?modif='.$idCompet);
?>
