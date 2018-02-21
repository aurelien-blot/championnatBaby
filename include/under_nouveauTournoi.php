<?php
include 'utilCompil.php';

$nbreJoueurs = intval($_GET['nbreJoueurs']);
$insertCompet = $bdd->prepare('INSERT INTO competitions(nomChamp, nbreJoueurs, dateDebut) VALUES(:nomChamp, :nbreJoueurs, :dateDebut)');
$insertCompet->execute(array(
    'nomChamp' => $_POST['nomChamp'],
    'nbreJoueurs' => $nbreJoueurs,
    'dateDebut' => $_POST['dateDebut']
));

$insertCompet->closeCursor();
$reqIdC = $bdd->prepare('SELECT * FROM competitions WHERE nomChamp = ?');
$nbreParticipants = 8;

$listeEquipes = array();

$listeJoueurs3 = array();
/* TEST
$listeJoueurs3[]=$_POST['joueur1'];
$listeJoueurs3[]=$_POST['joueur2'];
$listeJoueurs3[]=$_POST['joueur3'];
$listeJoueurs3[]=$_POST['joueur4'];
$listeJoueurs3[]=$_POST['joueur5'];
$listeJoueurs3[]=$_POST['joueur6'];
$listeJoueurs3[]=$_POST['joueur7'];
$listeJoueurs3[]=$_POST['joueur8'];
*/
$listeJoueurs3[]=1;
$listeJoueurs3[]=2;
$listeJoueurs3[]=3;
$listeJoueurs3[]=4;
$listeJoueurs3[]=5;
$listeJoueurs3[]=6;
$listeJoueurs3[]=7;
$listeJoueurs3[]=8;
// AFFICHER LISTE ID JOUEURS
/*
?>
<p>Liste des joueurs :</p><br><ul><?php
foreach ($listeJoueurs3 as $jtest){
    ?>
    <li><?php echo($jtest);?></li>
    <?php
}
    ?> </ul><?php*/
// FIN TEST

// CREATION DES EQUIPES !!
$compteurEquipe =1;
$joueurcase = array();
for($i =0; $i<count($listeJoueurs3);$i++){
//for($compteurEquipe =1; $compteurEquipe<=4;$compteurEquipe++){
//while(count($listeJoueurs3)>=2){
    //$i=0;
    $joueur = $listeJoueurs3[$i];
    $equipe=array();
    $equipe['idE']=$compteurEquipe;
    $equipe['joueur1']=$joueur;
    /*
    ?>
    <p>Equipe : <?php echo($equipe['idE'])?></p>
    <p>Joueur 1 : <?php echo($equipe['joueur1'])?></p>
    <?php*/
    unset($listeJoueurs3[$i]);
    $listeJoueurs3 = array_values($listeJoueurs3);
    $rand = $i;
    while($rand == $i){
        $rand = rand(0,(count($listeJoueurs3)-1));
    }
    $equipe['joueur2'] = $listeJoueurs3[$rand];
    /*
    ?>
    <p>RAND : <?php echo($rand);?></p><?php

    ?>
    <p>Joueur 2 : <?php echo($equipe['joueur2']);?></p><?php
    */
    unset($listeJoueurs3[$rand]);
    $listeJoueurs3 = array_values($listeJoueurs3);


/*
    ?>
    <p>Liste des joueurs restants :</p><br><ul><?php
    foreach ($listeJoueurs3 as $jtest){
        ?>
        <li><?php echo($jtest);?></li>
        <?php
    }
    ?> </ul><?php*/
    $listeEquipes[]=$equipe;
    $compteurEquipe++;
}
$equipe["idE"]=$compteurEquipe;
$equipe['joueur1']=$listeJoueurs3[0];
$equipe['joueur2']=$listeJoueurs3[1];
$listeEquipes[]=$equipe;

// FIN DE CREATION DES EQUIPES
/*
foreach ($listeEquipes as $equipe){
    echo ("Equipe : ".$equipe['idE']." Joueur 1 :".$equipe['joueur1']." / Joueur 2 : ".$equipe['joueur2']);
    ?><br><?php
}
*/
//ENTREE DES EQUIPES DANS LA BDD;

$reqIdC->execute(array($_POST['nomChamp'] ));

$compet;

while($donnees = $reqIdC->fetch()){
    $compet = $donnees['id_competition'];
    //echo($donnees['nomChamp']);
}
$reqIdC->closeCursor();

 $reqPushEC= $bdd->prepare('INSERT INTO equipes(joueur1, joueur2, id_compet) VALUES(:joueur1, :joueur2, :id_compet)');

foreach ($listeEquipes as $equipe) {
    $reqPushEC->execute(array(
        'joueur1' => $equipe['joueur1'],
        'joueur2' => $equipe['joueur2'],
        'id_compet' => $compet
    ));
}
$reqPushEC->closeCursor();

// CA MARCHE


$reqEC = $bdd->prepare('SELECT * FROM equipes WHERE id_compet = ?');
$reqEC->execute(array($compet));

$listeEquipes2 = array();

while($donnees = $reqEC->fetch()){
    $listeEquipes2[]=$donnees['id_Equipe'];
}
$reqEC->closeCursor();
$reqMatchsE = $bdd->prepare('INSERT INTO matchs (equipe1, equipe2, id_compet, type_match) VALUES (:equipe1, :equipe2, :id_compet, :type_match)');

for($o=0;$o<=2;$o++){
    $equipe1 = $listeEquipes2[$o];
    $o++;
    $equipe2 = $listeEquipes2[$o];
    $reqMatchsE->execute(array(
        'equipe1' => $equipe1,
        'equipe2' => $equipe2,
        'id_compet' => $compet,
        'type_match'=> "demi"
        ));
}
$reqMatchsE->closeCursor();
$reqSuiteMatchs=$bdd->prepare('INSERT INTO matchs (id_compet, type_match) VALUES (:id_compet, :type_match)');

$reqSuiteMatchs->execute(array(
    'id_compet' => $compet,
    'type_match'=> "finale"
));

header('location:../championnat.php?idC='.$compet);

?>