<?php
    function nbTachesFaites()
    {
        require '../ConnexionBDD.php';
        $nbTaches = 0;
        $requete = $bdd->prepare("SELECT COUNT(id) as nb_taches FROM taches WHERE fait=1 AND id_projet=".$_SESSION['idProjet']);
        
        // exécute
        $requete->execute();
        while($tache = $requete->fetch(PDO::FETCH_ASSOC))
        {
            $nbTaches = $tache['nb_taches'];
        }
        return $nbTaches;
    }

    function nbTachesNonFaites()
    {
        require '../ConnexionBDD.php';
        $nbTaches = 0;
        $requete = $bdd->prepare("SELECT COUNT(id) as nb_taches FROM taches WHERE fait=0 AND id_projet=".$_SESSION['idProjet']);
        
        // exécute
        $requete->execute();
        while($tache = $requete->fetch(PDO::FETCH_ASSOC))
        {
            $nbTaches = $tache['nb_taches'];
        }
        return $nbTaches;
    }
?>