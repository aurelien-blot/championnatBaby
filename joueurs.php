<?php session_start();
include'include/connexionBdd.php';
$listeJoueurs = $bdd->query('SELECT * FROM joueurs ORDER BY nom');
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
    	<?php include'include/banniere.php'; ?>
	</div>
</header>

<div id="content">
	<div class="wrap">
		<nav>
			<?php include'include/navJoueurs.php'; ?>
		</nav>
        <?php
        if(!isset($_GET['idJ'])) {
            while ($donnees = $listeJoueurs->fetch()) {
                ?>
                <a href="joueurs.php?idJ=<?php echo $donnees['id_Joueur']; ?>"><img id="photoJoueur"
                                                                                    src="<?php echo $donnees['photo']; ?>"></a>
                <p id="nomJoueur"><?php echo $donnees['surnom']; ?></p>
                <?php
            }
        }
        ?>
	</div>
</div>
<footer>
	<div class="wrap">
    	<?php include'include/footer.php'; ?>
	</div>

</footer>
</body>
</html>
