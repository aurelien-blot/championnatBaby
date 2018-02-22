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
    private $prenom;
    private $surnom;
    private $meilleureperformance;
    private $defaut;
    private $qualite;
    private $photo;
    private $victoireChamp;



//endregion
    //region Getters/Setters

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
    public function getMeilleureperformance()
    {
        return $this->meilleureperformance;
    }

    /**
     * @param mixed $meilleureperformance
     */
    public function setMeilleureperformance($meilleureperformance)
    {
        $this->meilleureperformance = $meilleureperformance;
    }

    /**
     * @return mixed
     */
    public function getDefaut()
    {
        return $this->defaut;
    }

    /**
     * @param mixed $defaut
     */
    public function setDefaut($defaut)
    {
        $this->defaut = $defaut;
    }

    /**
     * @return mixed
     */
    public function getQualite()
    {
        return $this->qualite;
    }

    /**
     * @param mixed $qualite
     */
    public function setQualite($qualite)
    {
        $this->qualite = $qualite;
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

    /**
     * @return mixed
     */
    public function getVictoireChamp()
    {
        return $this->victoireChamp;
    }

    /**
     * @param mixed $victoireChamp
     */
    public function setVictoireChamp($victoireChamp)
    {
        $this->victoireChamp = $victoireChamp;
    }

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
    public function __construct($nom, $prenom, $surnom, $meilleureperformance, $defaut, $qualite, $photo, $victoireChamp)
    {
        $this->nom = $nom;
        $this->prenom =$prenom;
        $this->surnom = $surnom;
        $this->meilleureperformance = $meilleureperformance;
        $this->defaut = $defaut;
        $this->qualite = $qualite;
        $this->photo = $photo;
        $this->victoireChamp = $victoireChamp;
    }
    //endregion

//region Methods


public static function findJoueur($idJoueur, $bdd){

    $detailJoueur = $bdd->prepare('SELECT * FROM joueurs WHERE id_Joueur =?');
    $detailJoueur->execute(array($idJoueur));
    $joueurX=null;

    while ($donnees =  $detailJoueur->fetch()){
        $joueurX = new Joueur($donnees['nom'],$donnees['prenom'],$donnees['surnom'],$donnees['meilleureperformance'],$donnees['defaut'],$donnees['qualite'], $donnees['photo'], $donnees['victoireChamp']);
        $joueurX->setIdJoueur($idJoueur);
    }
    return $joueurX;

}
//endregion

}