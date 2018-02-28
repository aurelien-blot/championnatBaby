<?php session_start();

include 'utilCompilDir.php';
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

           if(!isset($_GET['nbreJoueurs'])) {
               ?>
               <form method="get" action="nouveauTournoi.php">
               <label for="nbreJoueurs">Nombre de participants au tournoi :</label>
               <select name="nbreJoueurs">
                   <option value="8" selected>8 joueurs</option>
                   <option value="10">10 joueurs</option>
                   <option value="12">12 joueurs</option>
                   <option value="14">14 joueurs</option>
               </select>
               <input type="submit" value="Valider"/>
               </form>
               <?php
           }

           else if(isset($_GET['nbreJoueurs']) AND ($_GET['nbreJoueurs'] ==8 OR $_GET['nbreJoueurs']==10 OR $_GET['nbreJoueurs']==12 OR $_GET['nbreJoueurs']==14)){
               $nbre = $_GET['nbreJoueurs'];


               ?>
                <form method="post" action="include/under_nouveauTournoi.php?nbreJoueurs=<?php echo($_GET['nbreJoueurs'])?>">
                    <label for="nomChamp">Nom du tournoi : </label>
                    <input name="nomChamp" type="text" required>
                    <label for="dateDebut">Date de début du tournoi :</label>
                    <input type="date" name="dateDebut" required>
                    <p>Joueurs participant au tournoi :</p>
               <?php
                $listeJoueur=Joueur::findAllJoueurByNom($bdd);

               for($i =1; $i <= $_GET['nbreJoueurs']; $i++){
                    ?>
                   <label for="joueur<?php echo($i);?>">Joueur <?php echo($i);?> :</label>
                   <select name="joueur<?php echo($i);?>">
                    <?php
                    foreach ($listeJoueur as $joueur) {
                        ?>
                        <option value="<?php echo($joueur->getIdJoueur());?>"><?php echo($joueur->getPrenom()); ?></option>
                        <?php
                    }
                    ?>
                   </select>
                   <?php
               }
               ?>
               <input type="submit" value="Valider">
                </form>
               <?php
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
