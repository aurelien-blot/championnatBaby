<?php

function afficherLienListeTournoi($listeTournoi){
    foreach ($listeTournoi as $tournoiX){
        ?>
        <a href="championnat.php?idC=<?php echo $tournoiX->getIdCompet(); ?>"><?php echo$tournoiX->getNomTournoi(); ?></a>
        <p id="dateDebut">commencée le <?php echo $tournoiX->getDateDebut(); ?></p>

        <?php
    }
}

function afficherIconeEquipe($idEquipe, $bdd){

    if($idEquipe !=null) {
        $equipeY = Equipe::findEquipe($idEquipe, $bdd);
        ?>
        <div class="iconeEquipe">
            <p>Equipe <?php echo($equipeY->getNomEquipe()); ?> :</p>
            <div class="iconeJoueurs">
                <?php
                foreach ($equipeY->getJoueursEquipe() as $joueurY) {
                    ?>
                    <div class="iconeJoueur">
                        <a href="joueurs.php?idJ=<?php echo($joueurY->getIdJoueur()); ?>"><img
                                src="<?php echo($joueurY->getPhoto()); ?>"/></a>
                        <p><?php echo($joueurY->getPrenom()); ?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    else{
        ?>
        <div class="iconeEquipe">
            <p>Equipe Inconnue:</p>
            <div class="iconeJoueurs">
                <div class="iconeJoueur">
                    <img src="img/photo_default.png"/></a>
                    <p> ? </p>
                </div>
                <div class="iconeJoueur">
                    <img src="img/photo_default.png"/></a>
                    <p> ? </p>
                </div>
                <?php
                ?>
            </div>
        </div>
        <?php
    }
}