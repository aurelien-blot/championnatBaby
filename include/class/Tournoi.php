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

    public function __construct($nomCompet,$nbreJ, $date, $bdd)
    {
        $this->fini=false;
        $this->nbreJoueurs=(intval($nbreJ));
        $this->nbreEquipes=($this->nbreJoueurs/2);
        $this->nomTournoi = $nomCompet;
        $this->listeEquipes = array();
        $this->listeJoueurs =array();
        $this->listeMatchs= array();
        $this->dateDebut=$date;
    }
//endregion

//region Methods
    public function ajouterJoueur(Joueur $joueur)
    {
        $this->listeJoueurs[]=$joueur;
    }

    public function creerEquipes($bdd){

        $nbreJoueursRestantATrier = $this->listeJoueurs;
        shuffle($nbreJoueursRestantATrier);
        for($i=0;$i<(count($nbreJoueursRestantATrier));$i){
            $rand=$i;

            while($rand == $i){
                $rand = rand(0,(count($nbreJoueursRestantATrier)-1));
            }

            $joueur = $nbreJoueursRestantATrier[$i];

            $joueur2 = $nbreJoueursRestantATrier[$rand];

            $equipe= new Equipe($this->idCompet, $joueur, $joueur2);
            $equipe->insertEquipes($bdd);
            $this->listeEquipes[]=$equipe;
            unset($nbreJoueursRestantATrier[$i]);
            unset($nbreJoueursRestantATrier[$rand]);
            $nbreJoueursRestantATrier = array_values($nbreJoueursRestantATrier);
        }
    }

    public function insererTournoi($bdd){

        $insertCompet = $bdd->prepare('INSERT INTO competitions(nomChamp, nbreJoueurs, dateDebut) VALUES(:nomChamp, :nbreJoueurs, :dateDebut)');
        $insertCompet->execute(array(
            'nomChamp' => $this->nomTournoi,
            'nbreJoueurs' => $this->nbreJoueurs,
            'dateDebut'=>$this->dateDebut
        ));
        $insertCompet->closeCursor();
        $idDernierTournoi = $bdd->query('SELECT id_competition FROM competitions ORDER BY id_competition DESC LIMIT 1');
        while ($donnee = $idDernierTournoi->fetch()) {
            $this->idCompet = intval($donnee['id_competition']);

        }
        $idDernierTournoi->closeCursor();
    }

    public function organiserMatchs($bdd){

        if(count($this->listeEquipes) ==4){

            $match1=  new Match($this->idCompet,'demi', null, null);
            $match2=  new Match($this->idCompet,'demi',null, null);

            $match3=  new Match($this->idCompet,'finale',null, null);
            $this->listeMatchs[]=$match1;
            $this->listeMatchs[]=$match2;
            $this->listeMatchs[]=$match3;
            $match1->setEquipe1($this->listeEquipes[0]);
            $match1->setEquipe2($this->listeEquipes[1]);
            $match2->setEquipe1($this->listeEquipes[2]);
            $match2->setEquipe2($this->listeEquipes[3]);

            foreach ($this->listeMatchs as $matchX){
                if($matchX->getEquipe1() !=null AND $matchX->getEquipe1() !=null){
                    $matchX->insererMatch($bdd);
                }

                $matchX->insererMatchVide($bdd);
            }

        }
        else if(count($this->listeEquipes)==6){
            echo('RATE');
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

    public static function findTournoi($idTournoi, $bdd){

        $detailTournoi = $bdd->prepare('SELECT * FROM competitions WHERE id_competition =?');
        $detailTournoi->execute(array($idTournoi));
        $tournoiX=null;

        while ($donnees =  $detailTournoi->fetch()){
            $tournoiX = new Tournoi($donnees['nomChamp'],$donnees['nbreJoueurs'],$donnees['dateDebut'],$bdd);
            $tournoiX->setIdCompet($idTournoi);
        }
        $detailTournoi->closeCursor();
        return $tournoiX;

    }

    public static function listerTournoiAll($bdd){
        $listTournoiAll= array();
        $listeCompet = $bdd->query('SELECT * FROM competitions ORDER BY dateDebut DESC');
        while ($donnees =  $listeCompet->fetch()){
            $tournoiX = new Tournoi($donnees['nomChamp'],$donnees['nbreJoueurs'],$donnees['dateDebut'],$bdd);
            $tournoiX->setIdCompet($donnees['id_competition']);
            $listTournoiAll[]=$tournoiX;
        }
        $listeCompet->closeCursor();
        return $listTournoiAll;
    }

    public static function listerTournoiEnCours($bdd){
        $listTournoiEnCours= array();
        $listeCompet = $bdd->query('SELECT * FROM competitions WHERE terminee = 0 ORDER BY dateDebut DESC');
        while ($donnees =  $listeCompet->fetch()){
            $tournoiX = new Tournoi($donnees['nomChamp'],$donnees['nbreJoueurs'],$donnees['dateDebut'],$bdd);
            $tournoiX->setIdCompet($donnees['id_competition']);
            $listTournoiEnCours[]=$tournoiX;
        }
        $listeCompet->closeCursor();
        return $listTournoiEnCours;
    }


    public function listerEquipesFromTournoi($bdd){
        $listEquipesFromTournoi= array();
        $listeEquipes= $bdd->prepare('SELECT * FROM equipes WHERE id_compet =?');
        $listeEquipes->execute(array($this->idCompet));
        while ($donnees =  $listeEquipes->fetch()){
            $equipeX = new Equipe($donnees['id_compet'],Joueur::findJoueur($donnees['joueur1'], $bdd),Joueur::findJoueur($donnees['joueur2'], $bdd),$bdd);
            $equipeX->setIdEquipe($donnees['id_Equipe']);
            $listEquipesFromTournoi[]=$equipeX;
        }
        $listeEquipes->closeCursor();
        return $listEquipesFromTournoi;
    }
    //endregion
}

?>