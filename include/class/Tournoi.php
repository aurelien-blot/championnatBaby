<?php
/**
 * Created by PhpStorm.
 * User: Aurélien Blot
 * Date: 18/02/2018
 * Time: 14:39
 */


class Tournoi
{
    //region Attributs
    private $idCompet;
    private $fini;
    private $nbreJoueurs;
    private $listeEquipes;
    private $listeJoueurs;
    private $nbreEquipes;
    private $dateDebut;
    private $nomTournoi;
    private $listeMatchs;
//endregion

//region Getters/Setters
    /**
     * @return mixed
     */
    public function getIdCompet()
    {
        return $this->idCompet;
    }

    /**
     * @param mixed $idCompet
     */
    public function setIdCompet($idCompet)
    {
        $this->idCompet = $idCompet;
    }
    /**
     * @return mixed
     */
    public function getListeMatchs()
    {
        return $this->listeMatchs;
    }

    /**
     * @param mixed $listeMatchs
     */
    public function setListeMatchs($listeMatchs)
    {
        $this->listeMatchs = $listeMatchs;
    }

    /**
     * @return mixed
     */
    public function getNomTournoi()
    {
        return $this->nomTournoi;
    }

    /**
     * @param mixed $nomTournoi
     */
    public function setNomTournoi($nomTournoi)
    {
        $this->nomTournoi = $nomTournoi;
    }

    /**
     * @return float|int
     */
    public function getNbreEquipes()
    {
        return $this->nbreEquipes;
    }

    /**
     * @param float|int $nbreEquipes
     */
    public function setNbreEquipes($nbreEquipes)
    {
        $this->nbreEquipes = $nbreEquipes;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getListeJoueurs()
    {
        return $this->listeJoueurs;
    }

    /**
     * @param mixed $listeJoueurs
     */
    public function setListeJoueurs($listeJoueurs)
    {
        $this->listeJoueurs = $listeJoueurs;
    }

    /**
     * @return mixed
     */
    public function getFini()
    {
        return $this->fini;
    }

    /**
     * @param mixed $fini
     */
    public function setFini($fini)
    {
        $this->fini = $fini;
    }

    /**
     * @return mixed
     */
    public function getNbreJoueurs()
    {
        return $this->nbreJoueurs;
    }

    /**
     * @param mixed $nbreJoueurs
     */
    public function setNbreJoueurs($nbreJoueurs)
    {
        $this->nbreJoueurs = $nbreJoueurs;
    }

    /**
     * @return mixed
     */
    public function getListeEquipes()
    {
        return $this->listeEquipes;
    }

    /**
     * @param mixed $listeEquipes
     */
    public function setListeEquipes($listeEquipes)
    {
        $this->listeEquipes = $listeEquipes;
    }

//endregion

//region Constructeur

    public function __construct($nbreJ, $nomCompet, $date, $bdd)
    {
        $this->fini=false;
        $this->nbreJoueurs=(intval($nbreJ));
        $this->nbreEquipes=($this->nbreJoueurs/2);
        $this->nomTournoi = $nomCompet;
        $this->listeEquipes = array();
        $this->listeJoueurs =array();
        $this->listeMatchs= array();
        $this->dateDebut=null;

        $insertCompet = $bdd->prepare('INSERT INTO competitions(nomChamp, nbreJoueurs, dateDebut) VALUES(:nomChamp, :nbreJoueurs, :dateDebut)');
        $insertCompet->execute(array(
            'nomChamp' => $this->nomTournoi,
            'nbreJoueurs' => $this->nbreJoueurs,
            'dateDebut'=>$date
        ));


    }
//endregion

//region Methods
    public function ajouterJoueur(Joueur $joueur)
    {
        $this->listeJoueurs[]=$joueur;
    }

    public function creerEquipes(){

        $nbreJoueursRestantATrier = $this->listeJoueurs;
        shuffle($nbreJoueursRestantATrier);
        for($i=0;$i<(count($nbreJoueursRestantATrier));$i){
            $rand=$i;

            while($rand == $i){
                $rand = rand(0,(count($nbreJoueursRestantATrier)-1));
            }

            $joueur = $nbreJoueursRestantATrier[$i];

            $joueur2 = $nbreJoueursRestantATrier[$rand];

            $equipe= new Equipe($joueur, $joueur2);
            $this->listeEquipes[]=$equipe;
            unset($nbreJoueursRestantATrier[$i]);
            unset($nbreJoueursRestantATrier[$rand]);
            $nbreJoueursRestantATrier = array_values($nbreJoueursRestantATrier);
        }
    }

    public function insertEquipes(){
        $reqPushEC= $bdd->prepare('INSERT INTO equipes(joueur1, joueur2, id_compet) VALUES(:joueur1, :joueur2, :id_compet)');

        for($i=0; $i<count($this->listeEquipes);) {
            $reqPushEC->execute(array(
                'joueur1' =>(($this->listeEquipes[$i])->setJoueursEquipe()[0]->getNom()),
                'joueur2' => (($this->listeEquipes[$i])->setJoueursEquipe()[1]->getNom()),
                'id_compet' => $this->idCompet
            ));
        }

    }

    public function organiserMatchs(){
        $equipesTournoi = $this->listeEquipes;
        if(count($equipesTournoi) ==4){
            $match1=  new Match('demiFinale');
            $match2=  new Match('demiFinale');
            $match3=  new Match('finale');
            $this->listeMatchs[]=$match1;
            $this->listeMatchs[]=$match2;
            $this->listeMatchs[]=$match3;
            $match1->setEquipesMatch($equipesTournoi[0],$equipesTournoi[1]);
            $match2->setEquipesMatch($equipesTournoi[2],$equipesTournoi[3]);

        }
        else if(count($equipesTournoi)==6){

        }
    }

    public  function afficherNomEquipe($equipeMatch){
        if($equipeMatch ==null){
            return 'inconnue';
        }
        return ($equipeMatch->getNomEquipe());

    }
    public function detaillerMatchs($type){
        echo($this->nomTournoi.' : <br/>');

        foreach($this->listeMatchs as $match){

            $nomEquipe1= $this->afficherNomEquipe($match->getEquipesMatch()[0]);
            $nomEquipe2= $this->afficherNomEquipe($match->getEquipesMatch()[1]);

            $typeMatchTest =$match->getTypeMatch();
            if($typeMatchTest==$type){
                if($typeMatchTest == 'demiFinale'){
                    $labelType='Demi-finale';
                }
                else if($typeMatchTest == 'finale'){
                    $labelType='Finale';
                }
                else if($typeMatchTest == 'poule'){
                    $labelType='Poule';
                }
                echo($labelType.' : ('.$nomEquipe1.') vs ('.$nomEquipe2.')<br />');
            }
        }
    }

    public static function findTournoi($idTournoi){

        $reqIdC = $bdd->prepare('SELECT * FROM competitions WHERE id_compet = ?');
        $reqIdC->execute(array($idTournoi));
        $repReqIdC = $reqIdC->fetch(PDO::FETCH_ASSOC);
        return $repReqIdC;
    }

    //endregion
}