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
        elseif (count($this->listeEquipes)==6){
            $this->listeEquipes[0]->attribuerNumPoule(1,$bdd);
            $this->listeEquipes[1]->attribuerNumPoule(1,$bdd);
            $this->listeEquipes[2]->attribuerNumPoule(1,$bdd);
            $this->listeEquipes[3]->attribuerNumPoule(2,$bdd);
            $this->listeEquipes[4]->attribuerNumPoule(2,$bdd);
            $this->listeEquipes[5]->attribuerNumPoule(2,$bdd);
            $match1=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[1]);
            $match1->setNumPoule(1);
            $match2=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[2]);
            $match2->setNumPoule(1);
            $match3=  new Match($this->idCompet,'poule', $this->listeEquipes[1], $this->listeEquipes[2]);
            $match3->setNumPoule(1);
            $match4=  new Match($this->idCompet,'poule', $this->listeEquipes[3], $this->listeEquipes[4]);
            $match4->setNumPoule(2);
            $match5=  new Match($this->idCompet,'poule', $this->listeEquipes[3], $this->listeEquipes[5]);
            $match5->setNumPoule(2);
            $match6=  new Match($this->idCompet,'poule', $this->listeEquipes[4], $this->listeEquipes[5]);
            $match6->setNumPoule(2);
            $match7=  new Match($this->idCompet,'demi', null, null);
            $match8=  new Match($this->idCompet,'demi',null, null);
            $match9=  new Match($this->idCompet,'finale',null, null);
            $this->listeMatchs[]=$match1;
            $this->listeMatchs[]=$match2;
            $this->listeMatchs[]=$match3;
            $this->listeMatchs[]=$match4;
            $this->listeMatchs[]=$match5;
            $this->listeMatchs[]=$match6;
            $this->listeMatchs[]=$match7;
            $this->listeMatchs[]=$match8;
            $this->listeMatchs[]=$match9;

            foreach ($this->listeMatchs as $matchX) {
                if ($matchX->getEquipe1() != null AND $matchX->getEquipe1() != null) {
                    $matchX->insererMatch($bdd);
                } else {
                    $matchX->insererMatchVide($bdd);
                }
            }
        }
        elseif(count($this->listeEquipes)==7){
            $match1=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[1]);
            $match2=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[2]);
            $match3=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[3]);
            $match4=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[4]);
            $match5=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[5]);
            $match6=  new Match($this->idCompet,'poule', $this->listeEquipes[0], $this->listeEquipes[6]);
            $match7=  new Match($this->idCompet,'poule', $this->listeEquipes[1], $this->listeEquipes[2]);
            $match8=  new Match($this->idCompet,'poule', $this->listeEquipes[1], $this->listeEquipes[3]);
            $match9=  new Match($this->idCompet,'poule', $this->listeEquipes[1], $this->listeEquipes[4]);
            $match10=  new Match($this->idCompet,'poule', $this->listeEquipes[1], $this->listeEquipes[5]);
            $match11=  new Match($this->idCompet,'poule', $this->listeEquipes[1], $this->listeEquipes[6]);
            $match12=  new Match($this->idCompet,'poule', $this->listeEquipes[2], $this->listeEquipes[3]);
            $match13=  new Match($this->idCompet,'poule', $this->listeEquipes[2], $this->listeEquipes[4]);
            $match14=  new Match($this->idCompet,'poule', $this->listeEquipes[2], $this->listeEquipes[5]);
            $match15=  new Match($this->idCompet,'poule', $this->listeEquipes[2], $this->listeEquipes[6]);
            $match16=  new Match($this->idCompet,'poule', $this->listeEquipes[3], $this->listeEquipes[4]);
            $match17=  new Match($this->idCompet,'poule', $this->listeEquipes[3], $this->listeEquipes[5]);
            $match18=  new Match($this->idCompet,'poule', $this->listeEquipes[3], $this->listeEquipes[6]);
            $match19=  new Match($this->idCompet,'poule', $this->listeEquipes[4], $this->listeEquipes[5]);
            $match20=  new Match($this->idCompet,'poule', $this->listeEquipes[4], $this->listeEquipes[6]);
            $match21=  new Match($this->idCompet,'poule', $this->listeEquipes[5], $this->listeEquipes[6]);
            $match22=  new Match($this->idCompet,'demi', null, null);
            $match23=  new Match($this->idCompet,'demi',null, null);
            $match24=  new Match($this->idCompet,'finale',null, null);
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
            $this->listeMatchs[]=$match15;
            $this->listeMatchs[]=$match16;
            $this->listeMatchs[]=$match17;
            $this->listeMatchs[]=$match18;
            $this->listeMatchs[]=$match19;
            $this->listeMatchs[]=$match20;
            $this->listeMatchs[]=$match21;
            $this->listeMatchs[]=$match22;
            $this->listeMatchs[]=$match23;
            $this->listeMatchs[]=$match24;

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
            $equipeX->setNumPoule($donnees['num_poule']);
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

        Tournoi::majPointsPoule($vainqueur, $bdd);
        $pouleTerminee = Tournoi::verifPoulesTerminees($idTournoi, $bdd);

        if($pouleTerminee){
            $premiereEquipe=Tournoi::listerVainqueursPoules($idTournoi,0, $bdd);
            $vainqueurPoule = $premiereEquipe[0];

            //SI EGALITE : le vainqueur poule sera :
            if(count($premiereEquipe)==2) {
                $reqDuelPoule=$bdd->prepare('SELECT * FROM matchs WHERE (equipe1 = :equipe1 AND equipe2 = :equipe2) OR (equipe1 = :equipe2 AND equipe2 = :equipe1)');
                $reqDuelPoule->execute(array(
                   'equipe1'=>$premiereEquipe[0]->getIdEquipe(),
                   'equipe2'=>$premiereEquipe[1]->getIdEquipe()
                ));

                while($donnees=$reqDuelPoule->fetch()) {
                    if($premiereEquipe[1]->getIdEquipe() == intval($donnees['vainqueur'])){
                        $vainqueurPoule = $premiereEquipe[1];
                    }
                }
                $reqDuelPoule->closeCursor();

            }

            elseif(count($premiereEquipe)>2){
               $vainqueurPoule=Tournoi::vainqueurGoalAverage($premiereEquipe, $bdd);
            }

            $idVainqueurPoule = $vainqueurPoule->getIdEquipe();
            $matchFinale= Match::listerMatchByType('finale',$idTournoi,$bdd);

            $insEquipe1 = $bdd->prepare('UPDATE matchs SET equipe1 = :equipe1 WHERE id_Match = :id_Match');
            $insEquipe1->execute(array(
                'equipe1' => $idVainqueurPoule,
                'id_Match' => $matchFinale[0]->getIdMatch()
            ));
            $insEquipe1->closeCursor();

            //ON RECUP LES EQUIPES EN MATCH DE DEMI
            $autresEquipes= array();
            $reqAutresEquipes=$bdd->prepare('SELECT * FROM equipes WHERE id_compet= :id_compet AND id_Equipe != :id_Equipe');
            $reqAutresEquipes->execute(array(
                'id_compet'=>$idTournoi,
                'id_Equipe'=>$idVainqueurPoule
            ));
            while($donnees2=$reqAutresEquipes->fetch()){

                $eq=Equipe::findEquipe((intval($donnees2['id_Equipe'])),$bdd);
                $autresEquipes[]= $eq;

            }
            $reqAutresEquipes->closeCursor();

            //ON RECUP LES MATCHS
            $matchDemi= Match::listerMatchByType('demi',$idTournoi,$bdd);
            $i =0;
            foreach ($matchDemi as $mDemi){
                $mDemi->setEquipe1($autresEquipes[$i]);$i++;
                $mDemi->setEquipe2($autresEquipes[$i]);$i++;

                $insEquipes = $bdd->prepare('UPDATE matchs SET equipe1 = :equipe1, equipe2= :equipe2 WHERE id_Match = :id_Match');
                $insEquipes->execute(array(
                    'equipe1' => $mDemi->getEquipe1()->getIdEquipe(),
                    'equipe2' => $mDemi->getEquipe2()->getIdEquipe(),
                    'id_Match' => $mDemi->getIdMatch()
                ));
                $insEquipes->closeCursor();
            }




        }
    }

    public static function misAJourMatchFausseFinale($idTournoi, $vainqMatch, $bdd){
        $matchFausseFinale= Match::listerMatchByType('fausseFinale', $idTournoi, $bdd);
        foreach ($matchFausseFinale as $matchZ){
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

    public static function misAJourMatchPoule12($idTournoi,$vainqMatch, $bdd){

        Tournoi::majPointsPoule($vainqMatch, $bdd);
        $pouleTerminee = Tournoi::verifPoulesTerminees($idTournoi, $bdd);
        $tournoiX = Tournoi::findTournoi($idTournoi, $bdd);

        if($pouleTerminee){

            //DETERMINER VAINQUEUR
            $matchsDemi= Match::listerMatchByType('demi',$idTournoi,$bdd);

            //On prend toutes les équipes dans un tableau

            function trierTabF($obj1, $obj2){
                $co= new ConnexionBdd();
                $bdd=$co->getBdd();
                $a=$obj1->getPointsPoule();
                $b=$obj2->getPointsPoule();

                return ($a > $b) ? -1 : 1;
            }
            function trierTabM($obj1, $obj2){
                $co= new ConnexionBdd();
                $bdd=$co->getBdd();
                $a=$obj1->totalButsPoule($bdd);
                $b=$obj2->totalButsPoule($bdd);
                return ($a > $b) ? -1 : 1;
            }
            $tabDeTabEquipesPoules=array();


            for($i=1;$i<3;$i++) {
                $premiereEquipe=Tournoi::listerVainqueursPoules($idTournoi,$i, $bdd);
                $equipesParPoule = $tournoiX->listerEquipesTournoiParPoules($i, $bdd);
                $tableauEquipesParPoulesClassee=array();

                if(count($premiereEquipe)==1) {


                    uasort($equipesParPoule, "trierTabF");
                    foreach ($equipesParPoule as $equipeV){
                        $tableauEquipesParPoulesClassee[]=$equipeV;
                    }

                }
                elseif(count($premiereEquipe)==3){

                    uasort($equipesParPoule, "trierTabM");

                    foreach ($equipesParPoule as $equipeV){
                        $tableauEquipesParPoulesClassee[]=$equipeV;
                    }
                }
                else{echo'MERDE';}
                $tabEquipe=array();
                $tabEquipe[]=$tableauEquipesParPoulesClassee[0];
                $tabEquipe[]=$tableauEquipesParPoulesClassee[1];
                $tabDeTabEquipesPoules[]=$tabEquipe;

            }
            // on rentre les équipes dans les matchs
            //var_dump($tabDeTabEquipesPoules);
            $poule1=$tabDeTabEquipesPoules[0];
            $poule2=$tabDeTabEquipesPoules[1];
            $vainqueurPoule1 = $poule1[0];
            $deuxiemePoule1 = $poule1[1];
            $vainqueurPoule2= $poule2[0];
            $deuxiemePoule2 = $poule2[1];

            $idVainqueurPoule1=$vainqueurPoule1->getIdEquipe();
            $idVainqueurPoule2=$vainqueurPoule2->getIdEquipe();
            $idDeuxiemePoule1=$deuxiemePoule1->getIdEquipe();
            $idDeuxiemePoule2=$deuxiemePoule2->getIdEquipe();

            $insEquipe1 = $bdd->prepare('UPDATE matchs SET equipe1 = :equipe1 WHERE id_Match = :id_Match');
            $insEquipe1->execute(array(
                'equipe1' => $idVainqueurPoule1,
                'id_Match' => $matchsDemi[0]->getIdMatch()
            ));
            $insEquipe1->closeCursor();

            $insEquipe2 = $bdd->prepare('UPDATE matchs SET equipe1 = :equipe1 WHERE id_Match = :id_Match');
            $insEquipe2->execute(array(
                'equipe1' => $idDeuxiemePoule1,
                'id_Match' => $matchsDemi[1]->getIdMatch()
            ));
            $insEquipe2->closeCursor();

            $insEquipe3 = $bdd->prepare('UPDATE matchs SET equipe2 = :equipe2 WHERE id_Match = :id_Match');
            $insEquipe3->execute(array(
                'equipe2' => $idVainqueurPoule2,
                'id_Match' => $matchsDemi[1]->getIdMatch()
            ));
            $insEquipe3->closeCursor();

            $insEquipe4 = $bdd->prepare('UPDATE matchs SET equipe2 = :equipe2 WHERE id_Match = :id_Match');
            $insEquipe4->execute(array(
                'equipe2' => $idDeuxiemePoule2,
                'id_Match' => $matchsDemi[0]->getIdMatch()
            ));
            $insEquipe4->closeCursor();

        }
    }

    public static function vainqueurGoalAverage($listeEquipesPoulesEgalite, $bdd){
        $equipeWin=0;
        foreach ($listeEquipesPoulesEgalite as $equipeW) {
            $total=$equipeW->totalButsPoule($bdd);

            if($total>$equipeWin){
                $equipeWin=$total;
                $vainqueurPoule=$equipeW;
            }
        }
        return $vainqueurPoule;
    }
    public static function classementGoalAverage($listeEquipesPoulesEgalite, $bdd){

            function trierTab($obj1, $obj2){
                $co= new ConnexionBdd();
                $bdd=$co->getBdd();
                $a=$obj1->totalButsPoule($bdd);
                $b=$obj2->totalButsPoule($bdd);

                return ($a > $b) ? -1 : 1;
            }
            uasort($listeEquipesPoulesEgalite, "trierTab");


        return $listeEquipesPoulesEgalite;
    }

    public static function majPointsPoule($vainqueur, $bdd){
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
    }

    public static function verifPoulesTerminees($idTournoi, $bdd){
        $listeMatchs= Match::listerMatchByType('poule',$idTournoi,$bdd);
        $pouleTerminee =true;
        foreach($listeMatchs as $matchP){
            if($matchP->getVainqueurMatch()==null){
                $pouleTerminee =false;
            }
        }
        return $pouleTerminee;
    }

    public static function listerVainqueursPoules($idTournoi, $numPoule,$bdd){

        $premiereEquipe=array();
        $reqEquipesPoules=$bdd->prepare('SELECT * FROM equipes WHERE id_compet= :id_compet AND num_poule= :num_poule AND pointsPoule = (SELECT MAX(pointsPoule) FROM equipes WHERE id_compet= :id_compet2 AND num_poule= :num_poule)');
        $reqEquipesPoules->execute(array(
            'id_compet'=>$idTournoi,
            'id_compet2'=>$idTournoi,
            'num_poule'=>$numPoule
        ));
        while($donnees2=$reqEquipesPoules->fetch()){
            $premiereEquipe[]= Equipe::findEquipe(($donnees2['id_Equipe']),$bdd);
        }
        $reqEquipesPoules->closeCursor();

        return $premiereEquipe;
    }

    public function listerEquipesTournoiParPoules($numPoule, $bdd){
        $listEquipesFromTournoi= array();
        $listeEquipes= $bdd->prepare('SELECT * FROM equipes WHERE id_compet = :id_compet AND num_poule = :num_poule');
        $listeEquipes->execute(array(
            'id_compet'=>$this->idCompet,
            'num_poule'=>$numPoule
        ));
        while ($donnees =  $listeEquipes->fetch()){
            $equipeX = new Equipe($donnees['id_compet'],Joueur::findJoueur($donnees['joueur1'], $bdd),Joueur::findJoueur($donnees['joueur2'], $bdd),$bdd);
            $equipeX->setIdEquipe($donnees['id_Equipe']);
            $equipeX->setPointsPoule($donnees['pointsPoule']);
            $equipeX->setNumPoule($donnees['num_poule']);
            $listEquipesFromTournoi[]=$equipeX;
        }
        $listeEquipes->closeCursor();
        return $listEquipesFromTournoi;
    }

    public static function listerJoueursPoulesParPosition($idTournoi,$numPoules, $bdd){
        $equipesPoules = array();
        $reqEquipesPoules2 = $bdd->prepare('SELECT * FROM equipes WHERE id_compet= :id_compet AND num_poule = :num_poule ORDER BY pointsPoule DESC');
        $reqEquipesPoules2->execute(array(
            'id_compet' => $idTournoi,
            'num_poule' => $numPoules
        ));
        while ($donnees2 = $reqEquipesPoules2->fetch()) {
            $equipesPoules[] = Equipe::findEquipe(($donnees2['id_Equipe']), $bdd);
        }
        return $equipesPoules;
    }

    public static function misAjourMatchPoule14($idTournoi, $vainqMatch,$bdd){
        Tournoi::majPointsPoule($vainqMatch, $bdd);
        $pouleTerminee = Tournoi::verifPoulesTerminees($idTournoi, $bdd);

        if($pouleTerminee){
            $tableau4Vainqueurs =array();
            $premiereEquipe=Tournoi::listerJoueursPoulesParPosition($idTournoi,0, $bdd);

            //MEGA FORMULE POUR EGALITE POULE
            $i=0;
            while(count($tableau4Vainqueurs)<4){

                if($premiereEquipe[$i]->getPointsPoule()!=$premiereEquipe[$i+1]->getPointsPoule()){
                    $tableau4Vainqueurs[]=$premiereEquipe[$i];
                    $i++;
                }
                else{
                    $tableauEgalite=array();
                    foreach ($premiereEquipe as $vxx){
                        if($vxx->getPointsPoule()==$premiereEquipe[$i]->getPointsPoule()){
                            $tableauEgalite[]=$vxx;
                        }
                    }
                    if(count($tableau4Vainqueurs)+count($tableauEgalite)<=4){
                        foreach ($tableauEgalite as $tabEgal){
                            $tableau4Vainqueurs[]=$tabEgal;
                            $i++;
                        }
                    }
                    else{
                        $nbreEquipesAInserer=4-count($tableau4Vainqueurs);
                        $tableauEgaliteClasse=array();
                        $tableauEgaliteInt = Tournoi::classementGoalAverage($tableauEgalite, $bdd);
                        foreach ($tableauEgaliteInt as $tab){
                            $tableauEgaliteClasse[]=$tab;
                        }

                        for($j=0;$j<$nbreEquipesAInserer;$j++){
                            $tableau4Vainqueurs[]=$tableauEgaliteClasse[$j];
                            $i++;
                        }

                    }
                }
            }

            $matchDemi= Match::listerMatchByType('demi',$idTournoi,$bdd);

            $insEquipe1 = $bdd->prepare('UPDATE matchs SET equipe1 = :equipe1 WHERE id_Match = :id_Match');
            $insEquipe1->execute(array(
                'equipe1' => $tableau4Vainqueurs[0]->getIdEquipe(),
                'id_Match' => $matchDemi[0]->getIdMatch()
            ));
            $insEquipe1->closeCursor();

            $insEquipe2 = $bdd->prepare('UPDATE matchs SET equipe2 = :equipe2 WHERE id_Match = :id_Match');
            $insEquipe2->execute(array(
                'equipe2' => $tableau4Vainqueurs[3]->getIdEquipe(),
                'id_Match' => $matchDemi[0]->getIdMatch()
            ));
            $insEquipe2->closeCursor();


            $insEquipe3 = $bdd->prepare('UPDATE matchs SET equipe1 = :equipe1 WHERE id_Match = :id_Match');
            $insEquipe3->execute(array(
                'equipe1' => $tableau4Vainqueurs[1]->getIdEquipe(),
                'id_Match' => $matchDemi[1]->getIdMatch()
            ));
            $insEquipe3->closeCursor();

            $insEquipe4 = $bdd->prepare('UPDATE matchs SET equipe2 = :equipe2 WHERE id_Match = :id_Match');
            $insEquipe4->execute(array(
                'equipe2' => $tableau4Vainqueurs[2]->getIdEquipe(),
                'id_Match' => $matchDemi[1]->getIdMatch()
            ));
            $insEquipe4->closeCursor();

        }
    }

}
?>