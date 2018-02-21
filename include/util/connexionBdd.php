<?php

try
{

    //$bdd = new PDO('mysql:host=localhost;dbname=championnatbaby;charset=utf8', 'root', '');
    $bdd = new PDO('mysql:host=db725411148.db.1and1.com;dbname=db725411148;charset=utf8', 'dbo725411148', 'testtesttest');

}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}



