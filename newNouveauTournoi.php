<?php session_start();
include 'include/utilCompil.php';
$listeJoueurs2 = $bdd->query('SELECT * FROM joueurs ORDER BY nom');
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
            <?php include'include/navChamp.php'; ?>
        </nav>

               <form method="post" action="include/under_new_newTournoi.php">
               <label for="nbreJoueurs">Nombre de participants au tournoi :</label>
               <select name="nbreJoueurs">
                   <option value="8" selected>8 joueurs</option>
                   <option value="10">10 joueurs</option>
               </select>
                   <label for="nomChamp">Nom du tournoi : </label>
                   <input name="nomChamp" type="text" required>
                   <label for="dateDebut">Date de début du tournoi :</label>
                   <input type="date" name="dateDebut" required>

                   <input type="submit" value="Valider">

               </form>
    </div>
</div>
<footer>
    <div class="wrap">
        <?php include'include/footer.php'; ?>
    </div>

</footer>
</body>
</html>
