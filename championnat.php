<?php session_start();

include 'utilCompilDir.php';

function afficherIconeEquipe($idEquipe, $bdd){
    $equipeY = Equipe::findEquipe($idEquipe, $bdd);
    if($equipeY !==null) {
        ?>
        <div class="iconeEquipe">
            <p>Equipe <?php echo($equipeY->getNomEquipe()); ?> :</p>
            <div class="iconeJoueurs">
                <?php
                foreach ($equipeY->getJoueursEquipe() as $joueurY) {
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
    else{
        ?>
        <div class="iconeEquipe">
            <p>Equipe Inconnue:</p>
            <div class="iconeJoueurs">
                <div class="iconeJoueur">
                    <img src="img/photo_default.png"/></a>
                    <p> ? </p>
                </div>
                <div class="iconeJoueur">
                    <img src="img/photo_default.png"/></a>
                    <p> ? </p>
                </div>
                <?php
                ?>
            </div>
        </div>
        <?php
    }
}


function afficherLienListeTournoi($listeTournoi){
    foreach ($listeTournoi as $tournoiX){
        ?>
        <a href="championnat.php?idC=<?php echo $tournoiX->getIdCompet(); ?>"><?php echo$tournoiX->getNomTournoi(); ?></a>
        <p id="dateDebut">commencée le <?php echo $tournoiX->getDateDebut(); ?></p>

        <?php
    }
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Championnat de babyfoot</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <header>

			<div class="wrap">
            	<?php include'include/banniere.php' ?>
				<nav>
					<?php include'include/navChamp.php'?>
				</nav>
			</div>
        </header>

        <div id="content">
			<div class="wrap">

                <?php
                // SI PAGE DE BASE :
                if(!isset($_GET['idC']) && !isset($_GET['comp'])){
                    // SI PAGE CHAMPIONNAT (EN COURS)
                    if(!isset($_GET['histo'])){
                        ?>
                        <h1>CHAMPIONNATS EN COURS</h1>
                        <?php

                        $tournoiEnCours = Tournoi::listerTournoiEnCours($bdd);
                        afficherLienListeTournoi($tournoiEnCours);
                    }
                    // SI PAGE HISTORIQUE
                    else if(isset($_GET['histo'])){
                        ?>
                        <h1>HISTORIQUE DES CHAMPIONNATS</h1>
                        <?php

                        $tournoiAll = Tournoi::listerTournoiAll($bdd);
                        afficherLienListeTournoi($tournoiAll);
                    }
                }


                // SI ON VEUT VOIR UN CHAMPIONNAT EN PARTICULIER
                else if(isset($_GET['idC'])){
                    $tournoi1 =Tournoi::findTournoi($_GET['idC'],$bdd);

                    ?>
                    <h1><?php echo($tournoi1->getNomTournoi());?></h1>
                        <p>A commencé le : <?php echo($tournoi1->getDateDebut());?></p>
                    <?php
                        //SI LE CHAMPIONNAT EST TERMINE ON INDIQUERA LE VAINQUEUR !

                    $listeMatchCompet = Match::listerMatchFromTournoi($_GET['idC'], "finale", $bdd);


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
                                    ?>
                                    <p>Vainqueur : <?php echo($matchFinale->getVainqueurMatch()) ?></p>
                                    <p>Score :<?php echo $matchFinale->getButEquipe1() ?> / <?php echo$matchFinale->getButEquipe2() ?></p>
                                    <?php
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
                       $listeDemiFinaleTournoi= Match::listerMatchFromTournoi($_GET['idC'], 'demi', $bdd);

                       foreach ($listeDemiFinaleTournoi as $demiFinale){
                            ?>
                            <div class="iconeMatch">
                                <?php
                                if(($demiFinale->getVainqueurMatch()!=null)){
                                    $equipeVainq = Equipe::findEquipe(intval($demiFinale->getVainqueurMatch()),$bdd);
                                    ?>
                                    <p>Vainqueur : <?php echo($equipeVainq->getNomEquipe()) ?></p>
                                    <p>Score :<?php echo($demiFinale->getButsEquipe1()) ?> / <?php echo($demiFinale->getButsEquipe2()) ?></p>
                                    <?php
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

                            $listeEquipeTournoi = Tournoi::findTournoi(intval($_GET['idC']), $bdd)->listerEquipesFromTournoi($bdd);
                            foreach ($listeEquipeTournoi as $equipeZ){
                                afficherIconeEquipe($equipeZ->getIdEquipe(), $bdd);
                            }
                            ?>
                        </div>


                    </div>
                    <a href="modifChampionnat.php?modif=<?php echo($_GET['idC']);?>"><button id="boutonModif">Modifier</button></a>


                    <?php

            }
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
