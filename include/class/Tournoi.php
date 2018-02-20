<?php
/**
 * Created by PhpStorm.
 * User: Aurélien Blot
 * Date: 18/02/2018
 * Time: 14:39
 */

class Tournoi
{
    private $fini;
    private $nbreJoueurs;
    private $listeEquipes;
    private $listeJoueurs;
    private $nbreEquipes;
    private $dateDebut;
    private $nomTournoi;
    private $listeMatchs;

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




    public function __construct($nbreJ, $nomCompet)
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
            'dateDebut'=>$this->dateDebut
        ));
        $insertCompet->closeCursor();
    }

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
    public function detaillerMatchs($type){
        echo($this->nomTournoi.' : <br/>');

        foreach($this->listeMatchs as $match){
            $equipe1Match=$match->getEquipesMatch()[0];
            $equipe2Match=$match->getEquipesMatch()[1];
            $typeMatchTest =$match->getTypeMatch();
            if($typeMatchTest==$type){

                echo('Demi-finale : ('.$equipe1Match->getNomEquipe().') vs ('.$equipe2Match->getNomEquipe().')<br />');
            }
        }
    }

}