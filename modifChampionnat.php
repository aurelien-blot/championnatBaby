<?php session_start();

include 'utilCompilDir.php';

include 'include/util/functionChampShared.php';

function afficherForm($idMatchX, $bdd){

    $matchX = Match::findMatch(intval($idMatchX), $bdd);
    if($matchX->getEquipe1()!=null AND $matchX->getEquipe2()!=null) {
        ?>
        <form action="include/under_modifChamp.php?modifM=<?php echo($matchX->getIdMatch()); ?>" method="post">

            <label for="vainq">Vainqueur :</label>
            <select name="vainq" required>
                <option value="<?php echo($matchX->getEquipe1()->getIdEquipe()); ?>">
                    <?php echo($matchX->getEquipe1()->getNomEquipe()); ?> :
                </option>
                <option value="<?php echo($matchX->getEquipe2()->getIdEquipe()); ?>">
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
            if ($tournoi1->getNbreJoueurs() == 8){
                ?>

                <div class="competX">
                <?php

                foreach ($listeMatchCompet as $matchFinale) {
                    ?>
                    <div class="iconeMatch finale">
                        <?php

                        if (($matchFinale->getVainqueurMatch()) != null) {
                            $equipeVainqF = Equipe::findEquipe(intval($matchFinale->getVainqueurMatch()), $bdd);
                            ?>

                            <p>Vainqueur : <?php echo($equipeVainqF->getNomEquipe()) ?></p>
                            <p>Score :<?php echo $matchFinale->getButsEquipe1() ?>
                                / <?php echo $matchFinale->getButsEquipe2() ?></p>
                            <?php

                        } else {

                            afficherForm(intval($matchFinale->getIdMatch()), $bdd);

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
                    $listeDemiFinaleTournoi = Match::listerMatchFromTournoi($_GET['modif'], 'demi', $bdd);

                    foreach ($listeDemiFinaleTournoi as $demiFinale) {
                        ?>
                        <div class="iconeMatch">
                            <?php
                            //afficherForm($demiFinale);
                            if (($demiFinale->getVainqueurMatch() != null)) {
                                $equipeVainq = Equipe::findEquipe(intval($demiFinale->getVainqueurMatch()), $bdd);
                                ?>
                                <p>Vainqueur : <?php echo($equipeVainq->getNomEquipe()) ?></p>
                                <p>Score :<?php echo($demiFinale->getButsEquipe1()) ?>
                                    / <?php echo($demiFinale->getButsEquipe2()) ?></p>
                                <?php
                            } else {
                                afficherForm(intval($demiFinale->getIdMatch()), $bdd);
                            }
                            ?>
                            <?php
                            afficherIconeEquipe($demiFinale->getEquipe1(), $bdd);
                            afficherIconeEquipe($demiFinale->getEquipe2(), $bdd);
                            ?>

                        </div>
                        <?php
                    }
                    ?>
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
                                else{
                                    afficherForm(intval($matchFinale->getIdMatch()), $bdd);
                                }
                                afficherIconeEquipe($matchFinale->getEquipe1(), $bdd);
                                afficherIconeEquipe($matchFinale->getEquipe2(), $bdd);

                                ?>
                            </div>
                            <?php
                        }


                        $listeMatchCompetFFinale = Match::listerMatchFromTournoi($_GET['modif'], "fausseFinale", $bdd);
                        foreach ($listeMatchCompetFFinale as $matchFausseFinale) {
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
                                else{
                                    afficherForm(intval($matchFausseFinale->getIdMatch()), $bdd);
                                }
                                afficherIconeEquipe($matchFausseFinale->getEquipe1(), $bdd);
                                afficherIconeEquipe($matchFausseFinale->getEquipe2(), $bdd);

                                ?>
                            </div>
                            <div class="demi">
                                <?php
                                // ON PREND TOUS LES MATCHS DE LA COMPET ET DE TYPE DEMI FINALE
                                $listeDemiFinaleTournoi = Match::listerMatchFromTournoi($_GET['modif'], 'demi', $bdd);

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
                                        else{
                                            afficherForm(intval($demiFinale->getIdMatch()), $bdd);
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
                                        <th>Vainqueur</th>
                                    </tr>

                                    <?php

                                    $listePoulesTournoi = Match::listerMatchFromTournoi($_GET['modif'], 'poule', $bdd);
                                    foreach ($listePoulesTournoi as $pouleX){

                                        ?>
                                        <tr>
                                            <td><?php echo(Equipe::findEquipe($pouleX->getEquipe1(), $bdd)->getNomEquipe());?></td>
                                            <td><?php echo(Equipe::findEquipe($pouleX->getEquipe2(),$bdd)->getNomEquipe());?></td>
                                            <td><?php echo($pouleX->getButsEquipe1());?></td>
                                            <td><?php echo($pouleX->getButsEquipe2());?></td>
                                            <td><?php
                                            if (($pouleX->getVainqueurMatch()== null)){ afficherForm(intval($pouleX->getIdMatch()), $bdd);
                                            }
                                            else{echo((Equipe::findEquipe($pouleX->getVainqueurMatch    (), $bdd)->getNomEquipe()));}

                                            ?></td>

                                        </tr>
                                        <?php
                                    }

                                    ?>
                                </table>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
            elseif($tournoi1->getNbreJoueurs() == 12){
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
                                else{
                                    afficherForm(intval($matchFinale->getIdMatch()), $bdd);
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
                            $listeDemiFinaleTournoi = Match::listerMatchFromTournoi($_GET['modif'], 'demi', $bdd);

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
                                    else{
                                        afficherForm(intval($demiFinale->getIdMatch()), $bdd);
                                    }

                                    afficherIconeEquipe($demiFinale->getEquipe1(), $bdd);
                                    afficherIconeEquipe($demiFinale->getEquipe2(), $bdd);
                                    ?>

                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="divPoules">
                            <div class="poules poule1">

                                <table id="tableauPoules">
                                    <tr>
                                        <th>Equipe A:</th>
                                        <th>Equipe B:</th>
                                        <th>Buts A :</th>
                                        <th>Buts B :</th>
                                        <th>Vainqueur :</th>
                                    </tr>

                                    <?php

                                    $listePoulesTournoi = Match::listerMatchFromTournoi($_GET['modif'], 'poule', $bdd);
                                    for($i=0;$i<3;$i++){
                                        $pouleX= $listePoulesTournoi[$i];
                                        ?>
                                        <tr>
                                            <td><?php echo(Equipe::findEquipe($pouleX->getEquipe1(), $bdd)->getNomEquipe());?></td>
                                            <td><?php echo(Equipe::findEquipe($pouleX->getEquipe2(),$bdd)->getNomEquipe());?></td>
                                            <td><?php echo($pouleX->getButsEquipe1());?></td>
                                            <td><?php echo($pouleX->getButsEquipe2());?></td>
                                            <td><?php
                                                if (($pouleX->getVainqueurMatch()== null)){ afficherForm(intval($pouleX->getIdMatch()), $bdd);
                                                }
                                                else{echo((Equipe::findEquipe($pouleX->getVainqueurMatch    (), $bdd)->getNomEquipe()));}

                                                ?></td>
                                        </tr>
                                        <?php
                                    }

                                    ?>
                                </table>
                            </div>
                            <div class="poules poule1">

                                <table id="tableauPoules">
                                    <tr>
                                        <th>Equipe A:</th>
                                        <th>Equipe B:</th>
                                        <th>Buts A :</th>
                                        <th>Buts B :</th>
                                        <th>Vainqueur :</th>
                                    </tr>

                                    <?php

                                    $listePoulesTournoi = Match::listerMatchFromTournoi($_GET['modif'], 'poule', $bdd);
                                    for($i=3;$i<6;$i++){
                                        $pouleX= $listePoulesTournoi[$i];
                                        ?>
                                        <tr>
                                            <td><?php echo(Equipe::findEquipe($pouleX->getEquipe1(), $bdd)->getNomEquipe());?></td>
                                            <td><?php echo(Equipe::findEquipe($pouleX->getEquipe2(),$bdd)->getNomEquipe());?></td>
                                            <td><?php echo($pouleX->getButsEquipe1());?></td>
                                            <td><?php echo($pouleX->getButsEquipe2());?></td>
                                            <td><?php
                                                if (($pouleX->getVainqueurMatch()== null)){ afficherForm(intval($pouleX->getIdMatch()), $bdd);
                                                }
                                                else{echo((Equipe::findEquipe($pouleX->getVainqueurMatch    (), $bdd)->getNomEquipe()));}

                                                ?></td>
                                        </tr>
                                        <?php
                                    }

                                    ?>
                                </table>
                            </div>
                        </div>

                    </div>
                    <?php
                }
                elseif($tournoi1->getNbreJoueurs() == 14){
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
                                }else{
                                    afficherForm(intval($matchFinale->getIdMatch()), $bdd);
                                }
                                afficherIconeEquipe($matchFinale->getEquipe1(), $bdd);
                                afficherIconeEquipe($matchFinale->getEquipe2(), $bdd);

                                ?>
                            </div>

                            <div class="demi">
                                <?php
                                // ON PREND TOUS LES MATCHS DE LA COMPET ET DE TYPE DEMI FINALE
                                $listeDemiFinaleTournoi = Match::listerMatchFromTournoi($_GET['modif'], 'demi', $bdd);

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
                                        else{
                                            afficherForm(intval($demiFinale->getIdMatch()), $bdd);
                                        }
                                        afficherIconeEquipe($demiFinale->getEquipe1(), $bdd);
                                        afficherIconeEquipe($demiFinale->getEquipe2(), $bdd);
                                        ?>

                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="divPoules">
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

                                        $listePoulesTournoi = Match::listerMatchFromTournoi($_GET['modif'], 'poule', $bdd);
                                        foreach ($listePoulesTournoi as $pouleX){
                                            ?>
                                            <tr>
                                                <td><?php echo(Equipe::findEquipe($pouleX->getEquipe1(), $bdd)->getNomEquipe());?></td>
                                                <td><?php echo(Equipe::findEquipe($pouleX->getEquipe2(),$bdd)->getNomEquipe());?></td>
                                                <td><?php echo($pouleX->getButsEquipe1());?></td>
                                                <td><?php echo($pouleX->getButsEquipe2());?></td>
                                                <td><?php if($pouleX->getVainqueurMatch()!=null){
                                                    echo((Equipe::findEquipe($pouleX->getVainqueurMatch(), $bdd)->getNomEquipe()));
                                                }
                                                    else{
                                                        afficherForm(intval($pouleX->getIdMatch()), $bdd);
                                                    }?></td>
                                            </tr>
                                            <?php
                                        }

                                        ?>
                                    </table>
                                </div>
                            </div>

                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }

                ?>
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
