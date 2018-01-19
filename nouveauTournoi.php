<?php session_start();
include'include/connexionBdd.php';
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
        <?php
            $nbreJoueurs = $_GET['nbreJoueurs'];
           if(!isset($nbreJoueurs)){
               ?>
               <form method="get" action="nouveauTournoi.php">
                <label for="nbreJoueurs">Nombre de participants au tournoi :</label>
                <select name="nbreJoueurs">
                <option value="8" selected>8 joueurs</option>
                <option value="10">10 joueurs</option>
                </select>
                <input type="submit" value="Valider"/>
                   <?php
           }
           else if(isset($nbreJoueurs AND (($nbreJoueurs ==8)OR ($nbreJoueurs==10))){

               for($i =1; $i <= $nbreJoueurs; $i++){
                    ?>
               }

           }


        ?>
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
