<?php
/**
 * Created by PhpStorm.
 * User: Aurélien Blot
 * Date: 18/02/2018
 * Time: 15:12
 */

class Equipe
{

    //region Attributs
    private $idEquipe;
    private $joueursEquipe;
    private $nomEquipe;
    //endregion
    //region Getters/Setters
    /**
     * @return mixed
     */
    public function getIdEquipe()
    {
        return $this->idEquipe;
    }

    /**
     * @param mixed $idEquipe
     */
    public function setIdEquipe($idEquipe)
    {
        $this->idEquipe = $idEquipe;
    }


    /**
     * @return string
     */
    public function getNomEquipe()
    {
        return $this->nomEquipe;
    }

    /**
     * @param string $nomEquipe
     */
    public function setNomEquipe($nomEquipe)
    {
        $this->nomEquipe = $nomEquipe;
    }



    /**
     * @return mixed
     */
    public function getJoueursEquipe()
    {
        return $this->joueursEquipe;
    }

    /**
     * @param mixed $joueursEquipe
     */
    public function setJoueursEquipe($joueursEquipe)
    {
        $this->joueursEquipe = $joueursEquipe;
    }


    /**
     * Equipe constructor.
     * @param $joueursEquipe
     */
    //endregion
    //region Constructeurs
    public function __construct(Joueur $joueur1, Joueur $joueur2)
    {
        $this->joueursEquipe = array();
        $this->joueursEquipe[]= $joueur1;
        $this->joueursEquipe[]= $joueur2;
        $this->nomEquipe=($joueur1->getNom()).' - '.($joueur2->getNom());


    }
    //endregion

    //region Methods

    //endregion
}