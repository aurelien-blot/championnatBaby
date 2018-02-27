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
    private $idCompetMatch;





//endregion

    //region Getters/Setters
    /**
     * @return mixed
     */
    public function getIdCompetMatch()
    {
        return $this->idCompetMatch;
    }

    /**
     * @param mixed $idCompetMatch
     */
    public function setIdCompetMatch($idCompetMatch)
    {
        $this->idCompetMatch = $idCompetMatch;
    }

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
        $this->equipesMatch[0] = $equipeMatch1;
        $this->equipesMatch[1] = $equipeMatch2;
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
    public function __construct($idCompetMatchX, $type, $equipe1, $equipe2)
    {
        $this->equipesMatch= array();
        $this->idCompetMatch = intval($idCompetMatchX);
        $this->equipe1=$equipe1;
        $this->equipe2=$equipe2;
        $this->butsEquipe1=0;
        $this->butsEquipe2=0;
        $this->equipesMatch[]=$equipe1;
        $this->equipesMatch[]=$equipe2;
        $this->matchFini =false;
        $this->vainqueurMatch = null;
        $this->typeMatch = $type;// VEFIFIER VRAIE BDD
    }

//endregion

//region Methods
    public function insererMatch($connexion){
        $insertMatch = $connexion->prepare('INSERT INTO matchs(equipe1, equipe2, id_compet, type_match) VALUES(:equipe1, :equipe2, :id_compet, :type_match)');

        $insertMatch->execute(array(
            'equipe1' => ($this->equipe1->getIdEquipe()),
            'equipe2' => $this->equipe2->getIdEquipe(),
            'id_compet' => $this->idCompetMatch,
            'type_match'=>$this->getTypeMatch()
        ));
        $insertMatch->closeCursor();

        $idDernierMatch = $connexion->query('SELECT * FROM matchs ORDER BY id_Match  DESC LIMIT 1');
        while ($donnee = $idDernierMatch->fetch()) {
            $this->idMatch = intval($donnee['id_Match']);

        }
        $idDernierMatch->closeCursor();
    }
    public function insererMatchVide($connexion){
        $insertMatch = $connexion->prepare('INSERT INTO matchs(id_compet, type_match) VALUES(:id_compet, :type_match)');

        $insertMatch->execute(array(
            'id_compet' => $this->idCompetMatch,
            'type_match'=>$this->getTypeMatch()
        ));
        $insertMatch->closeCursor();

        $idDernierMatch = $connexion->query('SELECT * FROM matchs ORDER BY id_Match  DESC LIMIT 1');
        while ($donnee = $idDernierMatch->fetch()) {
            $this->idMatch = intval($donnee['id_Match']);

        }
        $idDernierMatch->closeCursor();
    }


    public static function findMatch($idMatch, $bdd){

        $detailMatch = $bdd->prepare('SELECT * FROM matchs WHERE id_Match =?');
        $detailMatch->execute(array($idMatch));
        $MatchX=null;

        while ($donnees =  $detailMatch->fetch()){
            $MatchX = new Match($donnees['id_compet'], $donnees['type_match'],Equipe::findEquipe(intval($donnees['equipe1']),$bdd),Equipe::findEquipe(intval($donnees['equipe2']),$bdd));
            $MatchX->setIdMatch($idMatch);
            $MatchX->setButsEquipe1($donnees['butEquipe1']);
            $MatchX->setButsEquipe2($donnees['butEquipe2']);
            $MatchX->setVainqueurMatch($donnees['vainqueur']);

        }
        $detailMatch->closeCursor();
        return $MatchX;

    }

    public static function listerMatchFromTournoi($idTournoi, $typeMatch, $bdd){
        $listMatchFromTournoi = array();
        $matchsCompet = $bdd ->prepare('SELECT * FROM matchs WHERE matchs.id_compet= :id_compet AND matchs.type_match = :type_match');
        $matchsCompet->execute(array(
            'id_compet'=> $idTournoi,
            'type_match'=>$typeMatch
            ));

        while ($donnees =  $matchsCompet->fetch()){
            $MatchX = new Match($donnees['id_compet'], $donnees['type_match'],$donnees['equipe1'],$donnees['equipe2']);
            $MatchX->setIdMatch($donnees['id_Match']);
            $MatchX->setButsEquipe1($donnees['butEquipe1']);
            $MatchX->setButsEquipe2($donnees['butEquipe2']);
            $MatchX->setVainqueurMatch($donnees['vainqueur']);
            $listMatchFromTournoi[]=$MatchX;
        }
        $matchsCompet->closeCursor();
        return $listMatchFromTournoi;
    }

    public static function listerMatchByType($typeMatch, $idTournoi, $bdd)
    {

        $listMatchs = $bdd->prepare('SELECT * FROM matchs WHERE id_compet = :id_compet AND type_match= :type_match');
        $listMatchs->execute(array(
            'id_compet' => $idTournoi,
            'type_match' => $typeMatch
        ));
        $listeMatchByType = array();

        while ($donnees = $listMatchs->fetch()) {
            $MatchX = new Match($donnees['id_compet'], $donnees['type_match'], Equipe::findEquipe(intval($donnees['equipe1']), $bdd), Equipe::findEquipe(intval($donnees['equipe2']), $bdd));
            $MatchX->setIdMatch($donnees['id_Match']);
            $MatchX->setButsEquipe1($donnees['butEquipe1']);
            $MatchX->setButsEquipe2($donnees['butEquipe2']);
            $MatchX->setVainqueurMatch($donnees['vainqueur']);
            $listeMatchByType[] = $MatchX;
        }
        $listMatchs->closeCursor();
        return $listeMatchByType;
    }
//endregion

}