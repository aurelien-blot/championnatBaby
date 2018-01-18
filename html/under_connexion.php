<?php
session_start();

    $_SESSION['nom'] = $_POST['pseudo'];
    echo ($_POST['pseudo']);
    //header('location:championnat.php');
?>