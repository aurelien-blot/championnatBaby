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
                else{
                    $matchX->insererMatchVide($bdd);
                }


            }

        }
        else if(count($this->listeEquipes)==5){
            $match1=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[1]);
            $match2=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[2]);
            $match3=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[3]);
            $match4=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[4]);
            $match5=  new Match($this->idCompet,'poule', $this->listeEquipes[1], $this->listeEquipes[2]);
            $match6=  new Match($this->idCompet,'poule', $this->listeEquipes[1], $this->listeEquipes[3]);
            $match7=  new Match($this->idCompet,'poule', $this->listeEquipes[1], $this->listeEquipes[4]);
            $match8=  new Match($this->idCompet,'poule', $this->listeEquipes[2], $this->listeEquipes[3]);
            $match9=  new Match($this->idCompet,'poule', $this->listeEquipes[2], $this->listeEquipes[4]);
            $match10=  new Match($this->idCompet,'poule', $this->listeEquipes[3], $this->listeEquipes[4]);
            $match11=  new Match($this->idCompet,'demi', null, null);
            $match12=  new Match($this->idCompet,'demi',null, null);
            $match13=  new Match($this->idCompet,'fausseFinale',null, null);
            $match14=  new Match($this->idCompet,'finale',null, null);
            $this->listeMatchs[]=$match1;
            $this->listeMatchs[]=$match2;
            $this->listeMatchs[]=$match3;
            $this->listeMatchs[]=$match4;
            $this->listeMatchs[]=$match5;
            $this->listeMatchs[]=$match6;
            $this->listeMatchs[]=$match7;
            $this->listeMatchs[]=$match8;
            $this->listeMatchs[]=$match9;
            $this->listeMatchs[]=$match10;
            $this->listeMatchs[]=$match11;
            $this->listeMatchs[]=$match12;
            $this->listeMatchs[]=$match13;
            $this->listeMatchs[]=$match14;

            foreach ($this->listeMatchs as $matchX) {
                if ($matchX->getEquipe1() != null AND $matchX->getEquipe1() != null) {
                    $matchX->insererMatch($bdd);
                } else {
                    $matchX->insererMatchVide($bdd);
                }
            }
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
            $tournoiX->setFini($donnees['terminee']);
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
            $tournoiX->setFini($donnees['terminee']);
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
            $tournoiX->setFini($donnees['terminee']);
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
            $equipeX->setPointsPoule($donnees['pointsPoule']);
            $listEquipesFromTournoi[]=$equipeX;
        }
        $listeEquipes->closeCursor();
        return $listEquipesFromTournoi;
    }
    //endregion

    public static function misAJourMatchFinale($idTournoi, $vainqMatch, $bdd){
        $matchFinale= Match::listerMatchByType('finale', $idTournoi, $bdd);
        foreach ($matchFinale as $matchZ){
            //on insere les donnnees match

            if($matchZ->getEquipe1()==null){
                $insEquipe1 = $bdd->prepare('UPDATE matchs SET equipe1 = :equipe1 WHERE id_Match = :id_Match');
                $insEquipe1->execute(array(
                    'equipe1' => $vainqMatch,
                    'id_Match' => $matchZ->getIdMatch()
                ));
                $insEquipe1->closeCursor();
            }
            elseif($matchZ->getEquipe2()==null){
                $insEquipe2 = $bdd->prepare('UPDATE matchs SET equipe2 = :equipe2 WHERE id_Match = :id_Match');
                $insEquipe2->execute(array(
                    'equipe2' => $vainqMatch,
                    'id_Match' => $matchZ->getIdMatch()
                ));
                $insEquipe2->closeCursor();
            }
        }

    }

    public static function misAJourMatchPoule($idTournoi, $vainqueur, $bdd){

        $reqPoule = $bdd->prepare('SELECT * FROM equipes WHERE id_Equipe =?');
        $reqPoule->execute(array($vainqueur));

        while($donnees = $reqPoule->fetch()) {
            $pointsPoules = $donnees['pointsPoule']+1;
            $updPointsPoule = $bdd->prepare('UPDATE equipes SET pointsPoule = :pointsPoule WHERE id_Equipe = :id_Equipe');
            $updPointsPoule->execute(array(
                'id_Equipe'=>$vainqueur,
                'pointsPoule'=>$pointsPoules
            ));
        }
        $reqPoule->closeCursor();

        $listeMatchsPoules= Match::listerMatchByType('poule',$idTournoi,$bdd);
        $pouleTerminee =true;
        foreach($listeMatchsPoules as $matchP){
            if($matchP->getVainqueurMatch()==null){
                $pouleTerminee =false;
            }
        }
        if($pouleTerminee){
            $premiereEquipe= array();
            $reqEquipesPoules=$bdd->prepare('SELECT * FROM equipes WHERE id_compet= :id_compet AND pointsPoule = (SELECT MAX(pointsPoule) FROM equipes WHERE id_compet= :id_compet2)');
            $reqEquipesPoules= $bdd->execute(array(
                'id_compet'=>$idTournoi,
                'id_compet2'=>$idTournoi
            ));
            while($donnees2=$reqEquipesPoules->fetch()){
                $premiereEquipe[]= Equipe::findEquipe(($donnees2['id_Equipe']),$bdd);
            }
            $reqEquipesPoules->closeCursor();

            if(count($premiereEquipe)>1){

            }

            $idVainqueurPoule = $premiereEquipe[0]->getIdEquipe();
            $matchFinale= Match::listerMatchByType('finale',$idTournoi,$bdd);
            $insEquipe1 = $bdd->prepare('UPDATE matchs SET equipe1 = :equipe1 WHERE id_Match = :id_Match');
            $insEquipe1->execute(array(
                'equipe1' => $idVainqueurPoule,
                'id_Match' => $matchFinale->getIdMatch()
            ));
            $insEquipe1->closeCursor();
            //RESTE A INSERER LES EQUIPES EN MATCH DE DEMI

            //$this->listeMatchs[10];
            //$this->listeMatchs[11];

        }
    }
}
?>