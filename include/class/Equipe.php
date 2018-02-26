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
    private $idTournoiEquipe;
    private $joueursEquipe;
    private $nomEquipe;
    private $joueur1;



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
    private $joueur2;

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

    /**
     * @return mixed
     */
    public function getJoueur2()
    {
        return $this->joueur2;
    }

    /**
     * @param mixed $joueur2
     */
    public function setJoueur2($joueur2)
    {
        $this->joueur2 = $joueur2;
    }
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
    public function __construct($idTournoiEquipe,Joueur $joueur1, Joueur $joueur2)
    {
        $this->idTournoiEquipe=$idTournoiEquipe;
        $this->joueursEquipe = array();
        $this->joueursEquipe[]= $joueur1;
        $this->joueursEquipe[]= $joueur2;
        $this->joueur1 = $joueur1;
        $this->joueur2 = $joueur2;
        $this->nomEquipe= ($joueur1->getPrenom().' - '.$joueur2->getPrenom());


    }
    //endregion

    //region Methods

    public function insertEquipes($bdd){


        $reqPushE= $bdd->prepare('INSERT INTO equipes(joueur1, joueur2, id_compet) VALUES(:joueur1, :joueur2, :id_compet)');
        $reqPushE->execute(array(
            'joueur1' =>($this->joueur1->getIdJoueur()),
            'joueur2' => ($this->joueur2->getIdJoueur()),
            'id_compet' => ($this->idTournoiEquipe)
        ));
        $reqPushE->closeCursor();

        $idDerniereEquipe = $bdd->query('SELECT * FROM equipes ORDER BY id_Equipe DESC LIMIT 1');
        while ($donnee = $idDerniereEquipe->fetch()) {
            $this->idEquipe = intval($donnee['id_Equipe']);
        }
        $idDerniereEquipe->closeCursor();

    }

    public static function findEquipe($idEquipe, $bdd){

        $detailEquipe = $bdd->prepare('SELECT * FROM equipes WHERE id_Equipe =?');
        $detailEquipe->execute(array($idEquipe));
        $equipeX=null;

        while ($donnees =  $detailEquipe->fetch()){
            $equipeX = new Equipe($donnees['joueur1'],$donnees['joueur2']);
            $equipeX->setIdEquipe($idEquipe);
        }
        return $equipeX;

    }

    //endregion
}