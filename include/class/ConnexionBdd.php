<?php
/**
 * Created by PhpStorm.
 * User: Aurélien Blot
 * Date: 24/02/2018
 * Time: 19:31
 */

class ConnexionBdd
{
    private $bdd;

    /**
     * ConnexionBdd constructor.
     */
    public function __construct()
    {

        try
        {
            $connexion = new PDO('mysql:host=localhost;dbname=championnatbaby;charset=utf8', 'root', '');
            //$connexion = new PDO('mysql:host=db725411148.db.1and1.com:3306;dbname=db725411148;charset=utf8', 'dbo725411148', '');

        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        $this->bdd = $connexion;

    }

    /**
     * @return PDO
     */
    public function getBdd()
    {
        return $this->bdd;
    }

    /**
     * @param PDO $bdd
     */
    public function setBdd($bdd)
    {
        $this->bdd = $bdd;
    }


}