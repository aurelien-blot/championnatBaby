<?php
/**
 * Created by PhpStorm.
 * User: Aurélien Blot
 * Date: 26/02/2018
 * Time: 14:57
 */

class EquipeInconnue
{
//region Attributs
    private $idTournoiEquipe;
    private $joueursEquipe;
    private $nomEquipe;
    private $joueur1;
    private $joueur2;


    //endregion

    //region Getters/Setters
    /**
     * @return mixed
     */
    public function getIdTournoiEquipe()
    {
        return $this->idTournoiEquipe;
    }

    /**
     * @param mixed $idTournoiEquipe
     */
    public function setIdTournoiEquipe($idTournoiEquipe)
    {
        $this->idTournoiEquipe = $idTournoiEquipe;
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
     * @return mixed
     */
    public function getNomEquipe()
    {
        return $this->nomEquipe;
    }

    /**
     * @param mixed $nomEquipe
     */
    public function setNomEquipe($nomEquipe)
    {
        $this->nomEquipe = $nomEquipe;
    }

    /**
     * @return mixed
     */
    public function getJoueur1()
    {
        return $this->joueur1;
    }

    /**
     * @param mixed $joueur1
     */
    public function setJoueur1($joueur1)
    {
        $this->joueur1 = $joueur1;
    }
    //endregion
    //region Constructor
    /**
     * EquipeInconnue constructor.
     * @param $idTournoiEquipe
     */
    public function __construct($idTournoiEquipe)
    {
        $this->idTournoiEquipe = $idTournoiEquipe;
        $this->joueursEquipe = array();
        $this->joueur1 = new JoueurInconnu();
        $this->joueur2 = new JoueurInconnu();
        $this->joueursEquipe[]= $this->joueur1;
        $this->joueursEquipe[]=  $this->joueur2;

        $this->nomEquipe= ('Inconnue');
    }

    //enregion

}