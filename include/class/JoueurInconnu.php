<?php
/**
 * Created by PhpStorm.
 * User: Aurélien Blot
 * Date: 26/02/2018
 * Time: 14:57
 */

class JoueurInconnu
{
    //region Attributs
    private $nom;
    private $prenom;
    private $surnom;
    private $photo;

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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getSurnom()
    {
        return $this->surnom;
    }

    /**
     * @param mixed $surnom
     */
    public function setSurnom($surnom)
    {
        $this->surnom = $surnom;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
    //endregion
    //region Constructeurs

    /**
     * Joueur constructor.
     * @param $nom
     */
    public function __construct()
    {
        $this->nom = 'Inconnu';
        $this->prenom ='Inconnu';
        $this->surnom = 'Inconnu';
        $this->photo = '...';
    }
    //endregion

//region Methods

//endregion
}