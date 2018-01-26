<?php session_start();
include'include/connexionBdd.php';
$listeJoueurs = $bdd->query('SELECT * FROM joueurs ORDER BY nom');

$detailJoueur = $bdd->prepare('SELECT * FROM joueurs WHERE id_Joueur =?');

if(isset($_GET['idJ'])){
    $detailJoueur = $bdd->prepare('SELECT * FROM joueurs WHERE id_Joueur =?');
    $detailJoueur->execute(array($_GET['idJ']));
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
                <div class="liendetailJoueur">
                <a href="joueurs.php?idJ=<?php echo $donnees['id_Joueur']; ?>"><img id="photoJoueur"
                                                                                    src="<?php echo $donnees['photo']; ?>"></a>
                <p id="nomJoueur"><?php echo $donnees['surnom']; ?></p>
                </div>
                <?php
            }
        }
        else{
            while ($donnees =  $detailJoueur->fetch()){
                ?>
                <h2 id="surnomJoueur"><?php echo $donnees['surnom']; ?></h2>
                <img src="<?php echo $donnees['photo']; ?>">
                <h3 id="nomCompletJoueur"><?php echo $donnees['nom']; ?> <?php echo $donnees['prenom']; ?></h3>
                <h3>Championnats remportés : <?php echo $donnees['victoireChamp']; ?></h3>
                <p>Qualité : <?php echo $donnees['qualite']; ?></p>
                <p>Défaut : <?php echo $donnees['defaut']; ?></p>
                <p>Meilleure performance : <?php echo $donnees['meilleureperformance']; ?></p>
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
