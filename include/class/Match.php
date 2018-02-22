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
    private $equipe1;
    private $equipe2;
    private $butsEquipe1;
    private $butsEquipe2;



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

    /**
     * @return mixed
     */
    public function getEquipe1()
    {
        return $this->equipe1;
    }

    /**
     * @param mixed $equipe1
     */
    public function setEquipe1($equipe1)
    {
        $this->equipe1 = $equipe1;
    }

    /**
     * @return mixed
     */
    public function getEquipe2()
    {
        return $this->equipe2;
    }

    /**
     * @param mixed $equipe2
     */
    public function setEquipe2($equipe2)
    {
        $this->equipe2 = $equipe2;
    }

    /**
     * @return int
     */
    public function getButsEquipe1()
    {
        return $this->butsEquipe1;
    }

    /**
     * @param int $butsEquipe1
     */
    public function setButsEquipe1($butsEquipe1)
    {
        $this->butsEquipe1 = $butsEquipe1;
    }

    /**
     * @return int
     */
    public function getButsEquipe2()
    {
        return $this->butsEquipe2;
    }

    /**
     * @param int $butsEquipe2
     */
    public function setButsEquipe2($butsEquipe2)
    {
        $this->butsEquipe2 = $butsEquipe2;
    }

//endregion

    //region Constructeur
    /**
     * Match constructor.
     */
    public function __construct($type, $equipe1, $equipe2)
    {
        $this->equipesMatch= array();
        $this->equipe1=$equipe1;
        $this->equipe2=$equipe2;
        $this->butsEquipe1=0;
        $this->butsEquipe2=0;
        $this->equipesMatch[0]=$this->equipe1;
        $this->equipesMatch[1]=$this->equipe2;
        $this->matchFini =false;
        $this->vainqueurMatch = null;
        $this->typeMatch = $type;// VEFIFIER VRAIE BDD
    }

//endregion

//region Methods
    public static function findMatch($idMatch, $bdd){

        $detailMatch = $bdd->prepare('SELECT * FROM matchs WHERE id_Match =?');
        $detailMatch->execute(array($idMatch));
        $MatchX=null;

        while ($donnees =  $detailMatch->fetch()){
            $MatchX = new Match($donnees['type_match'],$donnees['equipe1'],$donnees['equipe2']);
            $MatchX->setIdMatch($idMatch);
            $MatchX->setButsEquipe1($donnees['butEquipe1']);
            $MatchX->setButsEquipe2($donnees['butEquipe2']);
            $MatchX->setVainqueurMatch($donnees['vainqueur']);

        }
        return $MatchX;

    }
//endregion

}