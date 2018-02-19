<?php
session_start();
include'include/connexionBdd.php';
$listeCompet = $bdd->query('SELECT * FROM competitions ORDER BY dateDebut DESC');
$matchsCompet = $bdd ->prepare('SELECT * FROM matchs WHERE matchs.id_compet= :id_compet AND matchs.type_match = :type_match');
$reqJE = $bdd->prepare('SELECT J1.id_Joueur AS J1id, J2.id_Joueur AS J2id, equipes.id_Equipe, J1.prenom AS J1p, J2.prenom AS J2p, J1.photo AS J1img ,J2.photo AS J2img FROM equipes JOIN joueurs AS J1 ON equipes.joueur1 = J1.id_Joueur JOIN joueurs AS J2 ON equipes.joueur2 = J2.id_Joueur WHERE equipes.id_Equipe = ?');
$detailCompet = $bdd->prepare('SELECT * FROM competitions WHERE competitions.id_competition = ?');
$detailCompet->execute(array($_GET['modif']));
$reqEquipes = $bdd->prepare('SELECT id_Equipe, J1.id_Joueur AS J1id, J2.id_Joueur AS J2id, equipes.id_Equipe, J1.prenom AS J1p, J2.prenom AS J2p, J1.photo AS J1img ,J2.photo AS J2img FROM equipes JOIN joueurs AS J1 ON equipes.joueur1 = J1.id_Joueur JOIN joueurs AS J2 ON equipes.joueur2 = J2.id_Joueur WHERE equipes.id_compet = ?');

function afficherIconeEquipe($donnees, $req ){
    ?>
    <div class="iconeEquipe">
        <p>Equipe <?php echo($donnees);?> :</p>
        <?php
        //AFFICHAGE DES JOUEURS EQUIPE 1
        $req->execute(array($donnees));
        while($donnees3 = $req->fetch()){
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
        $req->closeCursor();?>
    </div>
    <?php
}

function afficherForm($donnees){
    ?>
    <form action="include/under_modifChamp.php?modifM=<?php echo($donnees['id_Match']);?>" method="post">
        <label for="vainq">Vainqueur :</label>
        <select name="vainq">
            <option  value="<?php echo($donnees['equipe1']);?>">Equipe <?php echo($donnees['equipe1']);?> :</option>
            <option  value="<?php echo($donnees['equipe2']);?>">Equipe <?php echo($donnees['equipe2']);?> :</option>

        </select>
        <label for="butEquipe1">Equipe <?php echo($donnees['equipe1']);?> :</label>
        <select name="butEquipe1">
            <?php
            for($i=0;$i<=15 ;$i++){
                ?>
                <option  value="<?php echo($i);?>"><?php echo($i);?></option>
                <?php
            }
            ?>
        </select>
        <label for="butEquipe2">Equipe <?php echo($donnees['equipe2']);?> :</label>
        <select name="butEquipe2">
            <?php
            for($i=0;$i<=15;$i++){
                ?>
                <option  value="<?php echo($i);?>"><?php echo($i);?></option>
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
                        <?php

                        if(isset($donnees2['vainqueur'])){
                            ?>
                            <p>Vainqueur : <?php echo($donnees2['vainqueur']) ?></p>
                            <p>Score :<?php echo($donnees2['butEquipe1']) ?> / <?php echo($donnees2['butEquipe2']) ?></p>
                            <?php
                        }
                        ?>
                        <?php
                        if(isset ($donnees2['equipe1']) AND  isset ($donnees2['equipe2'])) {
                            afficherForm($donnees2);
                        }
                        if(isset ($donnees2['equipe1'])) {
                            afficherIconeEquipe($donnees2['equipe1'], $reqJE);
                            if(isset ($donnees2['equipe2'])) {
                                afficherIconeEquipe($donnees2['equipe2'], $reqJE);
                            }
                            else{
                                ?>
                                <div class="iconeEquipe">
                                    <p>Equipe : </p>
                                </div>
                                <?php

                            }
                        }
                        else{
                            ?>
                            <div class="iconeEquipe">
                                <p>Equipe : </p>
                            </div>
                            <div class="iconeEquipe">
                                <p>Equipe : </p>
                            </div>
                            <?php

                        }


                        ?>
                    </div>
                    <?php
                }
                $matchsCompet->closeCursor();
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
                        <?php
                    afficherForm($donnees2);
                    ?>
                        <p>score : <span></span></p>

                            <?php
                            if(isset($donnees2['vainqueur'])){
                                ?>
                                <p>Vainqueur : <?php echo($donnees2['vainqueur']) ?></p>
                                <p>Score :<?php echo($donnees2['butEquipe1']) ?> / <?php echo($donnees2['butEquipe2']) ?></p>
                                <?php
                            }
                            ?>
                            <?php
                            afficherIconeEquipe($donnees2['equipe1'], $reqJE );
                            afficherIconeEquipe($donnees2['equipe2'], $reqJE );
                            ?>

                    </div>
                    <?php
                }
                ?>
    </div>
    <div class="iconeEquipes">
        <?php
        $reqEquipes->execute(array($_GET['modif']));
        while($donnees4 = $reqEquipes->fetch()){
            ?>
            <div class="iconeEquipe">
                <p>Equipe <?php echo($donnees4['id_Equipe']);?></p>
                <div class="iconeJoueurs">
                    <div class="iconeJoueur">
                        <img src="<?php echo($donnees4['J1img']);?>" />
                        <p><?php echo($donnees4['J1p']);?></p>
                    </div>
                    <div class="iconeJoueur">
                        <img src="<?php echo($donnees4['J2img']);?>" />
                        <p><?php echo($donnees4['J2p']);?></p>
                    </div>
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
