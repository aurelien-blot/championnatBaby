<?php
/**
 * Created by PhpStorm.
 * User: Aurélien Blot
 * Date: 18/02/2018
 * Time: 15:16
 */

class Match
{
    //region Attributs
    private $idMatch;
    private $equipesMatch;
    private $vainqueurMatch;
    private $matchFini;
    private $typeMatch;



//endregion

    //region Getters/Setters
    /**
     * @return mixed
     */
    public function getIdMatch()
    {
        return $this->idMatch;
    }

    /**
     * @param mixed $idMatch
     */
    public function setIdMatch($idMatch)
    {
        $this->idMatch = $idMatch;
    }

    /**
     * @return mixed
     */
    public function getTypeMatch()
    {
        return $this->typeMatch;
    }

    /**
     * @param mixed $typeMatch
     */
    public function setTypeMatch($typeMatch)
    {
        $this->typeMatch = $typeMatch;
    }

    /**
     * @return mixed
     */
    public function getEquipesMatch()
    {
        return $this->equipesMatch;
    }

    /**
     * @param mixed $equipesMatch
     */
    public function setEquipesMatch($equipeMatch1, $equipeMatch2 )
    {
        $this->equipesMatch[] = $equipeMatch1;
        $this->equipesMatch[] = $equipeMatch2;
    }

    /**
     * @return mixed
     */
    public function getVainqueurMatch()
    {
        return $this->vainqueurMatch;
    }

    /**
     * @param mixed $vainqueurMatch
     */
    public function setVainqueurMatch($vainqueurMatch)
    {
        $this->vainqueurMatch = $vainqueurMatch;
    }

    /**
     * @return mixed
     */
    public function getMatchFini()
    {
        return $this->matchFini;
    }

    /**
     * @param mixed $matchFini
     */
    public function setMatchFini($matchFini)
    {
        $this->matchFini = $matchFini;
    }

//endregion

    //region Constructeur
    /**
     * Match constructor.
     */
    public function __construct($type)
    {
        $this->equipesMatch= array();
        $this->matchFini =false;
        $this->vainqueurMatch = null;
        $this->typeMatch = $type;
    }
//endregion

//region Methods

//endregion

}