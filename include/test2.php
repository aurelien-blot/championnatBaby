<?php

include 'utilCompil.php';

$idTournoi = 320093;
$premiereEquipe=Tournoi::listerJoueursPoulesParPosition($idTournoi,0, $bdd);


$tournoi= Tournoi::findTournoi($idTournoi,$bdd);
$listeEq=$tournoi->listerEquipesFromTournoi($bdd);

foreach ($listeEq as $esq){
    echo($esq->getNomEquipe().'  : '.$esq->totalButsPoule($bdd));
}
echo('efjseiojfoiezsjfoiesjidfkzpoesdkfpozek');
$liste2 =Tournoi::classementGoalAverage($listeEq, $bdd);
foreach ($liste2 as $esq){
    echo($esq->getNomEquipe().'  : '.$esq->totalButsPoule($bdd));
}

?>