<?php
session_start();
include'include/connexionBdd.php';
$listeCompet = $bdd->query('SELECT * FROM competitions ORDER BY dateDebut DESC');
$matchsCompet = $bdd ->prepare('SELECT * FROM matchs WHERE matchs.id_compet= :id_compet AND matchs.type_match = :type_match');
$reqJE = $bdd->prepare('SELECT J1.id_Joueur AS J1id, J2.id_Joueur AS J2id, equipes.id_Equipe, J1.prenom AS J1p, J2.prenom AS J2p, J1.photo AS J1img ,J2.photo AS J2img FROM equipes JOIN joueurs AS J1 ON equipes.joueur1 = J1.id_Joueur JOIN joueurs AS J2 ON equipes.joueur2 = J2.id_Joueur WHERE equipes.id_Equipe = ?');
$detailCompet = $bdd->prepare('SELECT * FROM competitions WHERE competitions.id_competition = ?');
$detailCompet->execute(array($_GET['modif']));
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
            while($donnees = $detailCompet->fetch()) {
                ?>
                <h1>Modif du championnat : <?php echo($donnees['nomChamp']); ?></h1>
                <p>A commencé le : <?php echo($donnees['dateDebut']); ?></p><?php
            }
            ?>
            <div class="competX">
                <?php
                $matchsCompet->execute(array(
                    'id_compet'=> $_GET['modif'],
                    'type_match'=> "finale"
                ));
                while ($donnees2 = $matchsCompet->fetch()){
                    ?>
                    <div class="iconeMatch finale">
                        <div class="iconeMatch">
                            <div class="iconeEquipe">
                                <p>Equipe 1:</p>

                                <p><?php echo($donnees2['equipe1']);?></p>
                                <p>Equipe 2 :</p>
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
                'id_compet'=> $_GET['modif'],
                'type_match'=> "demi"
                ));
                while ($donnees2 = $matchsCompet->fetch()){

                    ?>
                    <div class="iconeMatch">
                        <form action="include/under_modifChamp.php" method="post">
                            <label for="vainq">Vainqueur :</label>
                            <select>
                                <option name="vainq" value="<?php echo($donnees2['equipe1']);?>">Equipe 1 :</option>
                                <option name="vainq" value="<?php echo($donnees2['equipe2']);?>">Equipe 2 :</option>

                            </select>
                            <label for="butEquipe1">Equipe 1 :</label>
                            <select>
                                <?php
                                for($i=0;$i<=10;$i++){
                                    ?>
                                    <option name="butEquipe1" value="<?php echo($i);?>"><?php echo($i);?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label for="butEquipe2">Equipe 2 :</label>
                            <select>
                                <?php
                                for($i=0;$i<=10;$i++){
                                    ?>
                                    <option name="butEquipe2" value="<?php echo($i);?>"><?php echo($i);?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="submit" value="Valider">
                        </form>

                        <p>score : <span></span></p>
                        <div class="iconeEquipe">
                        <p>Equipe 1:</p>
                        <?php
                        //AFFICHAGE DES JOUEURS EQUIPE 1
                        $reqJE->execute(array($donnees2['equipe1']));
                        while($donnees3 = $reqJE->fetch()){
                            ?>
                        <div class="iconeJoueurs">
                            <div class="iconeJoueur">
                                <img src="<?php echo($donnees3['J1img']);?>" />
                                <p><?php echo($donnees3['J1p']);?></p>
                            </div>
                            <div class="iconeJoueur">
                                <img src="<?php echo($donnees3['J2img']);?>" />
                                <p><?php echo($donnees3['J2p']);?></p>
                            </div>
                        </div>
                            <?php
                        }
                        $reqJE->closeCursor();?>
                        </div>
                        <div class="iconeEquipe">
                            <p>Equipe 2:</p>
                            <?php
                            //AFFICHAGE DES JOUEURS EQUIPE 2
                            $reqJE->execute(array($donnees2['equipe2']));
                            while($donnees3 = $reqJE->fetch()){
                                ?>
                                <div class="iconeJoueurs">
                                    <div class="iconeJoueur">
                                        <img src="<?php echo($donnees3['J1img']);?>" />
                                        <p><?php echo($donnees3['J1p']);?></p>
                                    </div>
                                    <div class="iconeJoueur">
                                        <img src="<?php echo($donnees3['J2img']);?>" />
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

</div>

			</div>
        </div>
        <footer>
			<div class="wrap">
            	<?php include'include/footer.php' ?>
			</div>

        </footer>
    </body>
</html>
