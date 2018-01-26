<?php session_start();
include'include/connexionBdd.php';
$listeCompet = $bdd->query('SELECT * FROM competitions ORDER BY dateDebut DESC');
$detailCompet = $bdd->prepare('SELECT * FROM competitions WHERE competitions.id_competition = ?');
$matchsCompet = $bdd ->prepare('SELECT * FROM matchs WHERE matchs.id_compet= :id_compet AND matchs.type_match = :type_match');
$reqJE = $bdd->prepare('SELECT J1.id_Joueur AS J1id, J2.id_Joueur AS J2id, equipes.id_Equipe, J1.prenom AS J1p, J2.prenom AS J2p, J1.photo AS J1img ,J2.photo AS J2img FROM equipes JOIN joueurs AS J1 ON equipes.joueur1 = J1.id_Joueur JOIN joueurs AS J2 ON equipes.joueur2 = J2.id_Joueur WHERE equipes.id_Equipe = ?');
$reqCencours = $bdd->query('SELECT * FROM competitions WHERE terminee = 0 ORDER BY dateDebut DESC ');
$reqEquipes = $bdd->prepare('SELECT id_Equipe, J1.id_Joueur AS J1id, J2.id_Joueur AS J2id, equipes.id_Equipe, J1.prenom AS J1p, J2.prenom AS J2p, J1.photo AS J1img ,J2.photo AS J2img FROM equipes JOIN joueurs AS J1 ON equipes.joueur1 = J1.id_Joueur JOIN joueurs AS J2 ON equipes.joueur2 = J2.id_Joueur WHERE equipes.id_compet = ?');
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
                        while ($donnees = $reqCencours->fetch()) {
                            ?>
                            <a href="championnat.php?idC=<?php echo $donnees['id_competition']; ?>"><?php echo($donnees['nomChamp']); ?></a>
                            <p id="dateDebut">commencée le <?php echo $donnees['dateDebut']; ?></p>
                            <?php
                        }
                    }
                    // SI PAGE HISTORIQUE
                    else if(isset($_GET['histo'])){
                        ?>
                        <h1>HISTORIQUE DES CHAMPIONNATS</h1>
                        <?php
                        while ($donnees = $listeCompet->fetch()) {
                            ?>
                            <a href="championnat.php?idC=<?php echo $donnees['id_competition']; ?>"><?php echo($donnees['nomChamp']); ?></a>
                            <p id="dateDebut">commencée le <?php echo $donnees['dateDebut']; ?></p>
                            <?php

                        }
                    }


                    $listeCompet->closeCursor();
                }


                // SI ON VEUT VOIR UN CHAMPIONNAT EN PARTICULIER
                else if(isset($_GET['idC'])){
                    $detailCompet->execute(array($_GET['idC']));

                    while($donnees = $detailCompet->fetch()){
                    ?>
                    <h1><?php echo($donnees['nomChamp']);?></h1>
                        <p>A commencé le : <?php echo($donnees['dateDebut']);?></p>
                    <?php
                        //SI LE CHAMPIONNAT EST TERMINE ON INDIQUERA LE VAINQUEUR !
                    if($donnees['terminee']==1){

                    }

                    // ON DEBUTE LE SCHEMA DU CHAMPIONNAT PAR LE DIV competX
                    ?>

                    <div class="competX">
                        <?php
                        $matchsCompet->execute(array(
                            'id_compet'=> $_GET['idC'],
                            'type_match'=> "finale"
                        ));
                        while ($donnees2 = $matchsCompet->fetch()){
                            ?>
                            <div class="iconeMatch finale">
                                <div class="iconeMatch">
                                    <div class="iconeEquipe">
                                        <p>Equipe <?php echo($donnees2['equipe1']);?> :</p>

                                        <p><?php echo($donnees2['equipe1']);?></p>
                                        <p>Equipe <?php echo($donnees2['equipe2']);?> :</p>
                                        <p><?php echo($donnees2['equipe2']);?></p>
                                    </div>

                                </div>


                            </div>
                            <?php
                        }

                        ?>
                        <div class="demi">
                        <?php
                        // ON PREND TOUS LES MATCHS DE LA COMPET ET DE TYPE DEMI FINALE
                        $matchsCompet->execute(array(
                        'id_compet'=> $_GET['idC'],
                        'type_match'=> "demi"
                        ));
                        while ($donnees2 = $matchsCompet->fetch()){

                            ?>
                            <div class="iconeMatch">
                                <p>score : <span></span></p>
                                <div class="iconeEquipe">
                                <p>Equipe <?php echo($donnees2['equipe1']);?> :</p>
                                <?php
                                //AFFICHAGE DES JOUEURS EQUIPE 1
                                $reqJE->execute(array($donnees2['equipe1']));
                                while($donnees3 = $reqJE->fetch()){
                                    ?>
                                <div class="iconeJoueurs">
                                    <div class="iconeJoueur">
                                    <a href="joueurs.php?idJ=<?php echo($donnees3['J1id']);?>"><img src="<?php echo($donnees3['J1img']);?>" /></a>
                                    <p><?php echo($donnees3['J1p']);?></p>
                                    </div>
                                    <div class="iconeJoueur">
                                        <a href="joueurs.php?idJ=<?php echo($donnees3['J2id']);?>"><img src="<?php echo($donnees3['J2img']);?>" /></a>
                                    <p><?php echo($donnees3['J2p']);?></p>
                                    </div>
                                </div>
                                    <?php
                                }
                                $reqJE->closeCursor();?>
                                </div>
                                <div class="iconeEquipe">
                                    <p>Equipe <?php echo($donnees2['equipe2']);?> :</p>
                                    <?php
                                    //AFFICHAGE DES JOUEURS EQUIPE 2
                                    $reqJE->execute(array($donnees2['equipe2']));
                                    while($donnees3 = $reqJE->fetch()){
                                        ?>
                                        <div class="iconeJoueurs">
                                            <div class="iconeJoueur">
                                                <a href="joueurs.php?idJ=<?php echo($donnees3['J1id']);?>"><img src="<?php echo($donnees3['J1img']);?>" /></a>
                                                <p><?php echo($donnees3['J1p']);?></p>
                                            </div>
                                            <div class="iconeJoueur">
                                                <a href="joueurs.php?idJ=<?php echo($donnees3['J2id']);?>"><img src="<?php echo($donnees3['J2img']);?>" /></a>
                                                <p><?php echo($donnees3['J2p']);?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    $reqJE->closeCursor();?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                        <div class="iconeEquipes">
                            <?php
                            $reqEquipes->execute(array($_GET['idC']));
                            while($donnees4 = $reqEquipes->fetch()){
                                ?>
                                <div class="iconeEquipe">
                                    <p>Equipe <?php echo($donnees4['id_Equipe']);?></p>
                                    <div class="iconeJoueurs">
                                        <div class="iconeJoueur">
                                            <a href="joueurs.php?idJ=<?php echo($donnees4['J1id']);?>"><img src="<?php echo($donnees4['J1img']);?>" /></a>
                                            <p><?php echo($donnees4['J1p']);?></p>
                                        </div>
                                        <div class="iconeJoueur">
                                            <a href="joueurs.php?idJ=<?php echo($donnees4['J2id']);?>"><img src="<?php echo($donnees4['J2img']);?>" /></a>
                                            <p><?php echo($donnees4['J2p']);?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>


                    </div>
                    <a href="modifChampionnat.php?modif=<?php echo($_GET['idC']);?>"><button id="boutonModif">Modifier</button></a>


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
