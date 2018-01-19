<?php session_start();
include'include/connexionBdd.php';
$createChampionnat = $bdd->prepare('INSERT INTO competitions(nomChamp, nbreJoueurs, dateDebut) VALUES(:nomChamp, :nbreJoueurs, :dateDebut)');

$nbreJoueurs = 12;
$dateDebut = 12-12-1912;


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
			</div>
        </header>
		<nav>
			<div class="wrap">
				<?php include'include/navChamp.php'?>
			</div>
		</nav>

        <div id="content">
			<div class="wrap">
				<input id="libelle" valeur="concombre">
				<?php $nomChamp = document.getElementById("libelle"); ?>
				<?php $createChampionnat -> execute(array(
					'nomChamp' => $nomChamp,
					'nbreJoueurs' => $nbreJoueurs,
					'dateDebut' => $dateDebut
				)); ?>

			</div>
        </div>
        <footer>
			<div class="wrap">
            	<?php include'include/footer.php' ?>
          </div>
        </footer>
    </body>
</html>
