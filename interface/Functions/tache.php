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

    // Fonction de création de rapport
    function creationTache($libelle)
    {
        require '../ConnexionBDD.php';
        $requete = $bdd->prepare("INSERT INTO taches(id_projet, libelle, fait) VALUES(:idProjet, :libelle, 0)");
        $requete->bindParam(':idProjet', $_SESSION['idProjet']);
        $requete->bindParam(':libelle', $libelle);
        // exécute
        if($requete->execute())
        {
            echo'<div class="alert alert-success" role="alert">
                Tache Créée ! veuillez patienter pendant la mise à jour ...
                </div>';
            ?>

            <script>
                    function redirect()
                    {
                        document.location.href="../interface/taches.php";
                    }
                    setTimeout(redirect,1000);
            </script>
            <?php
        }
    }
?>