<?php
session_start();

    $nom1 = $_POST['nom'];
    $_SESSION['nom'] = $_POST['nom'];
    header('location:html/championnat.php');
?>