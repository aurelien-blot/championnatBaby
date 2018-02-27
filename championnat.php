<?php session_start();

include 'utilCompilDir.php';

include 'include/util/functionChampShared.php';
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
                        $tournoi1 = Tournoi::findTournoi($_GET['idC'], $bdd);

                        ?>
                <h1><?php echo($tournoi1->getNomTournoi()); ?></h1>
                <p>A commencé le : <?php echo($tournoi1->getDateDebut()); ?></p>
                <?php
                //SI LE CHAMPIONNAT EST TERMINE ON INDIQUERA LE VAINQUEUR !

                $listeMatchCompet = Match::listerMatchFromTournoi($_GET['idC'], "finale", $bdd);


                if($tournoi1->getFini() == 1) {
                $equipeWin = Equipe::findEquipe(($listeMatchCompet[0]->getVainqueurMatch()), $bdd);
                ?>
                <h3>VAINQUEUR : <?php echo($equipeWin->getNomEquipe()); ?></h3>
                <?php
                afficherIconeEquipe($equipeWin->getIdEquipe(), $bdd);
                }
                // ON DEBUTE LE SCHEMA DU CHAMPIONNAT PAR LE DIV competX
                if ($tournoi1->getNbreJoueurs() == 8) {
                    ?>
                    <div class="competX">
                        <?php

                        foreach ($listeMatchCompet as $matchFinale) {
                            ?>
                            <div class="iconeMatch finale">
                                <?php
                                if (($matchFinale->getVainqueurMatch()) != null) {
                                    ?>
                                    <p>Vainqueur
                                        : <?php echo((Equipe::findEquipe($matchFinale->getVainqueurMatch(), $bdd)->getNomEquipe())); ?></p>
                                    <p>Score :<?php echo($matchFinale->getButsEquipe1()); ?>
                                        / <?php echo $matchFinale->getButsEquipe2(); ?></p>
                                    <?php
                                }
                                afficherIconeEquipe($matchFinale->getEquipe1(), $bdd);
                                afficherIconeEquipe($matchFinale->getEquipe2(), $bdd);

                                ?>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="demi">
                            <?php
                            // ON PREND TOUS LES MATCHS DE LA COMPET ET DE TYPE DEMI FINALE
                            $listeDemiFinaleTournoi = Match::listerMatchFromTournoi($_GET['idC'], 'demi', $bdd);

                            foreach ($listeDemiFinaleTournoi as $demiFinale) {
                                ?>
                                <div class="iconeMatch">
                                    <?php
                                    if (($demiFinale->getVainqueurMatch() != null)) {
                                        $equipeVainq = Equipe::findEquipe(intval($demiFinale->getVainqueurMatch()), $bdd);
                                        ?>
                                        <p>Vainqueur : <?php echo($equipeVainq->getNomEquipe()) ?></p>
                                        <p>Score :<?php echo($demiFinale->getButsEquipe1()) ?>
                                            / <?php echo($demiFinale->getButsEquipe2()) ?></p>
                                        <?php
                                    }

                                    afficherIconeEquipe($demiFinale->getEquipe1(), $bdd);
                                    afficherIconeEquipe($demiFinale->getEquipe2(), $bdd);
                                    ?>

                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="iconeEquipes">
                            <?php

                            $listeEquipeTournoi = Tournoi::findTournoi(intval($_GET['idC']), $bdd)->listerEquipesFromTournoi($bdd);
                            foreach ($listeEquipeTournoi as $equipeZ) {
                                afficherIconeEquipe($equipeZ->getIdEquipe(), $bdd);
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    }

                elseif ($tournoi1->getNbreJoueurs() == 10){
                    ?>
                    <div class="competX">
                        <?php

                        foreach ($listeMatchCompet as $matchFinale) {
                            ?>
                            <div class="iconeMatch finale">
                                <?php
                                if (($matchFinale->getVainqueurMatch()) != null) {
                                    ?>
                                    <p>Vainqueur
                                        : <?php echo((Equipe::findEquipe($matchFinale->getVainqueurMatch(), $bdd)->getNomEquipe())); ?></p>
                                    <p>Score :<?php echo($matchFinale->getButsEquipe1()); ?>
                                        / <?php echo $matchFinale->getButsEquipe2(); ?></p>
                                    <?php
                                }
                                afficherIconeEquipe($matchFinale->getEquipe1(), $bdd);
                                afficherIconeEquipe($matchFinale->getEquipe2(), $bdd);

                                ?>
                            </div>
                            <?php
                        }


                        $listeMatchCompetFFinale = Match::listerMatchFromTournoi($_GET['idC'], "fausseFinale", $bdd);
                        foreach ($listeMatchCompet as $matchFausseFinale) {
                        ?>
                        <div class="iconeMatch fausseFinale">
                            <?php
                            if (($matchFausseFinale->getVainqueurMatch()) != null) {
                                ?>
                                <p>Vainqueur
                                    : <?php echo((Equipe::findEquipe($matchFausseFinale->getVainqueurMatch(), $bdd)->getNomEquipe())); ?></p>
                                <p>Score :<?php echo($matchFausseFinale->getButsEquipe1()); ?>
                                    / <?php echo $matchFausseFinale->getButsEquipe2(); ?></p>
                                <?php
                            }
                            afficherIconeEquipe($matchFausseFinale->getEquipe1(), $bdd);
                            afficherIconeEquipe($matchFausseFinale->getEquipe2(), $bdd);

                            ?>
                        </div>
                        <div class="demi">
                            <?php
                            // ON PREND TOUS LES MATCHS DE LA COMPET ET DE TYPE DEMI FINALE
                            $listeDemiFinaleTournoi = Match::listerMatchFromTournoi($_GET['idC'], 'demi', $bdd);

                            foreach ($listeDemiFinaleTournoi as $demiFinale) {
                                ?>
                                <div class="iconeMatch">
                                    <?php
                                    if (($demiFinale->getVainqueurMatch() != null)) {
                                        $equipeVainq = Equipe::findEquipe(intval($demiFinale->getVainqueurMatch()), $bdd);
                                        ?>
                                        <p>Vainqueur : <?php echo($equipeVainq->getNomEquipe()) ?></p>
                                        <p>Score :<?php echo($demiFinale->getButsEquipe1()) ?>
                                            / <?php echo($demiFinale->getButsEquipe2()) ?></p>
                                        <?php
                                    }

                                    afficherIconeEquipe($demiFinale->getEquipe1(), $bdd);
                                    afficherIconeEquipe($demiFinale->getEquipe2(), $bdd);
                                    ?>

                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="poules">

                            <table id="tableauPoules">
                                <tr>
                                    <th>Equipe A:</th>
                                    <th>Equipe B:</th>
                                    <th>Buts A :</th>
                                    <th>Buts B :</th>
                                    <th>Vainqueur :</th>
                                </tr>

                            <?php

                            $listePoulesTournoi = Match::listerMatchFromTournoi($_GET['idC'], 'poule', $bdd);
                            foreach ($listePoulesTournoi as $pouleX){
                                ?>
                                <tr>
                                    <td><?php echo(Equipe::findEquipe($pouleX->getEquipe1(), $bdd)->getNomEquipe());?></td>
                                    <td><?php echo(Equipe::findEquipe($pouleX->getEquipe2(),$bdd)->getNomEquipe());?></td>
                                    <td><?php echo($pouleX->getButsEquipe1());?></td>
                                    <td><?php echo($pouleX->getButsEquipe2());?></td>
                                    <td><?php if($pouleX->getVainqueurMatch()!=null){echo((Equipe::findEquipe($pouleX->getEquipe1(), $bdd)->getNomEquipe()));}?></td>
                                </tr>
                                <?php
                            }

                            ?>
                            </table>
                        </div>
                        <div class="iconeEquipes">
                            <?php

                            $listeEquipeTournoi = Tournoi::findTournoi(intval($_GET['idC']), $bdd)->listerEquipesFromTournoi($bdd);
                            foreach ($listeEquipeTournoi as $equipeZ) {
                                afficherIconeEquipe($equipeZ->getIdEquipe(), $bdd);
                            }
                            ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                if($tournoi1->getFini()==false) {
                    ?>
                    <a href="modifChampionnat.php?modif=<?php echo($_GET['idC']); ?>">
                        <button id="boutonModif">Modifier</button>
                    </a>
                    <?php
                }
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
