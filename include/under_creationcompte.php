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

////PHOTO////

$_FILES['photo']['name']     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
$_FILES['photo']['type']     //Le type du fichier. Par exemple, cela peut être « image/png ».
$_FILES['photo']['size']   	//La taille du fichier en octets.
$_FILES['photo']['tmp_name'] //L'adresse vers le fichier uploadé dans le répertoire temporaire.
$_FILES['photo']['error']    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.

if ($_FILES['photo']['error'] > 0) $erreur = "Erreur lors du transfert";
if ($_FILES['photo']['size'] > $maxsize) $erreur = "Le fichier est trop gros";

$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
//1. strrchr renvoie l'extension avec le point (« . »).
//2. substr(chaine,1) ignore le premier caractère de chaine.
//3. strtolower met l'extension en minuscules.
$extension_upload = strtolower(  substr(  strrchr($_FILES['photo']['name'], '.')  ,1)  );
if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";

$image_sizes = getimagesize($_FILES['photo']['tmp_name']);
if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) $erreur = "Image trop grande";

//déplacer le fichier image

mkdir('fichier/1/', 0777, true);
//Créer un identifiant difficile à deviner
$nom = md5(uniqid(rand(), true));

$nom = "avatars/{$id_membre}.{$extension_upload}";
$resultat = move_uploaded_file($_FILES['photo']['tmp_name'],$nom);
if ($resultat) echo "Transfert réussi";

?>



//https://openclassrooms.com/courses/upload-de-fichiers-par-formulaire#_=_

















