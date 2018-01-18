<?php
//$_SESSION['nom'] = "";
session_destroy();
$sessionouverte = false;
header('location:../index.php')
?>