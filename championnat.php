<?php session_start();
include'include/connexionBdd.php';
$listeCompet = $bdd->query('SELECT * FROM competitions ORDER BY nomChamp');
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
        			if(!isset($_GET['idC'])) {
            			while ($donnees = $listeCompet->fetch()) {
                ?>
                <a href="championnat.php?idC=<?php echo $donnees['id_competition']; ?>"><?php echo $donnees['nomChamp']; ?></a>
                <p id="dateDebut"><?php echo $donnees['nbreJoueurs']; ?></p>
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
