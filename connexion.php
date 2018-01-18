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
		<form method="post" action="creationCompte.php">
			<label for="pseudo">Nom : </label>
			<input id="pseudo" type="text">
			<label for="mdp">Mot de passe : </label>
			<input id="mdp" type="password">
			<input type="submit" id="submit" value="Valider">

		</form>
	</div>
</div>
<footer>
	<div class="wrap">
    	<?php include'include/footer.php' ?>
	</div>
</footer>
</body>
</html>
