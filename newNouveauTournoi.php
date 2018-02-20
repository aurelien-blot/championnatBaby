<?php session_start();
include 'include/connexionBdd.php';
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

               <form method="get" action="include/under_new_newTournoi.php">
               <label for="nbreJoueurs">Nombre de participants au tournoi :</label>
               <select name="nbreJoueurs">
                   <option value="8" selected>8 joueurs</option>
                   <option value="10">10 joueurs</option>
               </select>
                   <label for="nomChamp">Nom du tournoi : </label>
                   <input name="nomChamp" type="text" required>
                   <label for="dateDebut">Date de début du tournoi :</label>
                   <input type="date" name="dateDebut" required>
                   <p>Joueurs participant au tournoi :</p>

                   <?php

                   while($donnees = $listeJoueurs2->fetch()){

                       $detailJoueur['id']= $donnees['id_Joueur'];
                       $detailJoueur['prenom']= $donnees['prenom'];
                       $tableauJoueur[]=$detailJoueur;

                   }
                   for($i =1; $i <= $_GET['nbreJoueurs']; $i++){
                       ?>
                       <label for="joueur<?php echo($i);?>">Joueur <?php echo($i);?> :</label>
                       <select name="joueur<?php echo($i);?>">
                           <?php
                           foreach ($tableauJoueur as $joueur) {
                               ?>
                               <option value="<?php echo($joueur['id']);?>"><?php echo($joueur['prenom']); ?></option>
                               <?php
                           }
                           ?>
                       </select>
                       <?php
                   }
                   ?>
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
