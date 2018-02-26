<?php session_start();

include 'utilCompilDir.php';

function afficherIconeEquipe($idEquipe, $bdd){
    $equipeY = Equipe::findEquipe($idEquipe, $bdd);
    ?>
    <div class="iconeEquipe">
        <p>Equipe <?php echo($equipeY->getNomEquipe());?> :</p>
        <div class="iconeJoueurs">
            <?php
            foreach($equipeY->getJoueursEquipe() as $joueurY) {
                ?>
                <div class="iconeJoueur">
                    <a href="joueurs.php?idJ=<?php echo($joueurY->getIdJoueur()); ?>"><img
                                src="<?php echo($joueurY->getPhoto()); ?>"/></a>
                    <p><?php echo($joueurY->getPrenom()); ?></p>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}


function afficherLienListeTournoi($listeTournoi){
    foreach ($listeTournoi as $tournoiX){
        ?>
        <a href="championnat.php?idC=<?php echo $tournoiX->getIdCompet(); ?>"><?php echo$tournoiX->getNomTournoi(); ?></a>
        <p id="dateDebut">commencée le <?php echo $tournoiX->getDateDebut(); ?></p>

        <?php
    }
}

function afficherForm($idMatchX, $bdd){

    $matchX = Match::findMatch(intval($idMatchX), $bdd);
    ?>
        <form action="include/under_modifChamp.php?modifM=<?php echo($matchX->getIdMatch()); ?>" method="post">

            <label for="vainq">Vainqueur :</label>
            <select name="vainq">
                <option value="<?php echo($matchX->getEquipe1()->getIdEquipe()); ?>">
                    <?php echo($matchX->getEquipe1()->getNomEquipe()); ?> :
                </option>
                <option value="<?php echo($matchX->getEquipe1()->getIdEquipe()); ?>">
                    <?php echo($matchX->getEquipe2()->getNomEquipe()); ?> :
                </option>

            </select>

            <label for="butEquipe1">Equipe <?php echo($matchX->getEquipe1()->getNomEquipe()); ?> :</label>
            <select name="butEquipe1">
                <?php
                for ($i = 0; $i <= 15; $i++) {
                    ?>
                    <option value="<?php echo($i); ?>"><?php echo($i); ?></option>
                    <?php
                }
                ?>
            </select>
            <label for="butEquipe2">Equipe <?php echo($matchX->getEquipe2()->getNomEquipe()); ?> :</label>
            <select name="butEquipe2">
                <?php
                for ($i = 0; $i <= 15; $i++) {
                    ?>
                    <option value="<?php echo($i); ?>"><?php echo($i); ?></option>
                    <?php
                }
                ?>
            </select>
            <input type="submit" value="Valider">
        </form>
    <?php
}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modification de Championnat</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<header>

    <div class="wrap">
        <?php include'include/banniere.php' ?>
        <?php include'include/menuPrincipal.php' ?>
    </div>
</header>

<div id="content">
    <div class="wrap">
                <?php

            $tournoi1 =Tournoi::findTournoi($_GET['modif'],$bdd);

            ?>
            <h1><?php echo($tournoi1->getNomTournoi());?></h1>
            <p>A commencé le : <?php echo($tournoi1->getDateDebut());?></p>
            <?php
            //SI LE CHAMPIONNAT EST TERMINE ON INDIQUERA LE VAINQUEUR !

            $listeMatchCompet = Match::listerMatchFromTournoi($_GET['modif'], "finale", $bdd);


            if($tournoi1->getFini()==1) {
                ?>
                <h3>VAINQUEUR : <?php echo(Equipe::findEquipe(($listeMatchCompet[0]->getVainqueurMatch()),$bdd)->getNomEquipe());?></h3>
                <?php
            }
            // ON DEBUTE LE SCHEMA DU CHAMPIONNAT PAR LE DIV competX
            ?>

            <div class="competX">
                <?php

                foreach ($listeMatchCompet as $matchFinale){
                    ?>
                    <div class="iconeMatch finale">
                        <?php

                        if(($matchFinale->getVainqueurMatch())!=null){
                            $equipeVainqF = Equipe::findEquipe(intval($matchFinale->getVainqueurMatch()),$bdd);
                            ?>

                            <p>Vainqueur : <?php echo($equipeVainqF->getNomEquipe()) ?></p>
                            <p>Score :<?php echo $matchFinale->getButsEquipe1() ?> / <?php echo$matchFinale->getButsEquipe2() ?></p>
                            <?php

                        }
                        else{

                            afficherForm(intval($matchFinale->getIdMatch()), $bdd);

                        }
                        afficherIconeEquipe($matchFinale->getEquipe1(), $bdd );
                        afficherIconeEquipe($matchFinale->getEquipe2(), $bdd );

                        ?>
                    </div>
                    <?php
                }
                ?>

                <div class="demi">
                    <?php
                    // ON PREND TOUS LES MATCHS DE LA COMPET ET DE TYPE DEMI FINALE
                    $listeDemiFinaleTournoi= Match::listerMatchFromTournoi($_GET['modif'], 'demi', $bdd);

                    foreach ($listeDemiFinaleTournoi as $demiFinale){
                        ?>
                        <div class="iconeMatch">
                            <?php
                            //afficherForm($demiFinale);
                            if(($demiFinale->getVainqueurMatch()!=null)){
                                $equipeVainq = Equipe::findEquipe(intval($demiFinale->getVainqueurMatch()),$bdd);
                                ?>
                                <p>Vainqueur : <?php echo($equipeVainq->getNomEquipe()) ?></p>
                                <p>Score :<?php echo($demiFinale->getButsEquipe1()) ?> / <?php echo($demiFinale->getButsEquipe2()) ?></p>
                                <?php
                            }
                            else{
                                afficherForm(intval($demiFinale->getIdMatch()), $bdd);
                            }
                            ?>
                            <?php
                            afficherIconeEquipe($demiFinale->getEquipe1(), $bdd );
                            afficherIconeEquipe($demiFinale->getEquipe2(), $bdd );
                            ?>

                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="iconeEquipes">
                    <?php

                    $listeEquipeTournoi = Tournoi::findTournoi(intval($_GET['modif']), $bdd)->listerEquipesFromTournoi($bdd);
                    foreach ($listeEquipeTournoi as $equipeZ){
                        afficherIconeEquipe($equipeZ->getIdEquipe(), $bdd);
                    }
                    ?>
                </div>


            </div>


            <?php
        ?>

    </div>
</div>
<footer>
    <div class="wrap">
        <?php include'include/footer.php' ?>
    </div>
</footer>
</body>
</html>
