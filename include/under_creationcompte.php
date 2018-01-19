<?php session_start();
include'connexionBdd.php';
$reponse = $bdd->query('SELECT * FROM joueurs');



while($donnees = $reponse->fetch()){
	if($donnees['nom']==$_POST['nom']){
		echo("Ce joueur existe déjà !");
		header('location:../joueurs.php');
	}
}

$nouveauJoueur = $bdd->prepare('INSERT INTO joueurs(nom, prenom, surnom, password, defaut, qualite) VALUES (:nom, :prenom, :surnom, :password, :defaut, :qualite)');
$nouveauJoueur -> execute(array(
	'nom' => $_POST['nom'],
	'prenom' => $_POST['prenom'],
	'surnom' => $_POST['pseudo'],
	'password' => sha1($_POST['mdp2']),
	'defaut' => $_POST['defaut'],
	'qualite' => $_POST['qualite']
));

header('location:../joueurs.php');

?>
