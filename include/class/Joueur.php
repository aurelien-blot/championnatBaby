<?php
/**
 * Created by PhpStorm.
 * User: Aurélien Blot
 * Date: 18/02/2018
 * Time: 15:12
 */

class Joueur
{
    //region Attributs
    private $idJoueur;
    private $nom;

//endregion
    //region Getters/Setters
    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getIdJoueur()
    {
        return $this->idJoueur;
    }

    /**
     * @param mixed $idJoueur
     */
    public function setIdJoueur($idJoueur)
    {
        $this->idJoueur = $idJoueur;
    }

    //endregion
    //region Constructeurs

    /**
     * Joueur constructor.
     * @param $nom
     */
    public function __construct($nom)
    {
        $this->nom = $nom;
    }
    //endregion

//region Methods
//endregion

}