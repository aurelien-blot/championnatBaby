<?php session_start() ?>
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

        <div id="content">
			<div class="wrap">
				<?php include'include/menuPrincipal.php' ?>
				<a id="lienChampionnat" href="championnat.php">Championnats</a>
            	<a id="lienJoueurs" href="joueurs.php">Joueurs</a>
			</div>
        </div>
        <footer>
			<div class="wrap">
            	<?php include'include/footer.php' ?>
			</div>

        </footer>
    </body>
</html>
