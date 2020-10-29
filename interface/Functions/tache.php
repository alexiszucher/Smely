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

    function getTachesProjet()
    {
        require '../ConnexionBDD.php';
        $requete = $bdd->prepare("SELECT * from taches where id_projet=".$_SESSION['idProjet']);
        // exécute
        $requete->execute(); 
        $nbTaches = 1;
        while($tache = $requete->fetch(PDO::FETCH_ASSOC))
        {
            if($tache['fait'] == 0)
            {
                echo "<h4><b>".$nbTaches.". ".$tache['libelle']."&nbsp&nbsp&nbsp</b></h4><a href='?validTache=true&idTache=".$tache['id']."'><button class='btn btn-success'>Valider</button></a>&nbsp&nbsp&nbsp&nbsp<a href='?supprTache=true&idTache=".$tache['id']."'>ou supprimer la tâche ?</a><br><br><br>" ;
                $nbTaches++;
            }
            else
            {
                echo "<h4 style='color:#32CD32;'><b>".$tache['libelle']."&nbsp&nbsp&nbsp(Validée)</b></h4>" ;
            }
            
        }
    }

    function supprTache($idTache)
    {
        require '../ConnexionBDD.php';
        $requete = $bdd->prepare("DELETE FROM taches WHERE id=".$idTache);
        
        // exécute
        if($requete->execute())
        {
            echo'<div class="alert alert-success" role="alert">
                Tâche Supprimée ! veuillez patienter pendant la mise à jour ...
                </div>';
            ?>

            <script>
                    function redirect()
                    {
                        document.location.href="../interface/index.php";
                    }
                    setTimeout(redirect,1000);
            </script>
            <?php
        }
    }

    function validTache($idTache)
    {
        require '../ConnexionBDD.php';
        $requete = $bdd->prepare("UPDATE taches SET fait=1 WHERE id=".$idTache);
        
        // exécute
        if($requete->execute())
        {
            echo'<div class="alert alert-success" role="alert">
                Tâche efféctuée ! veuillez patienter pendant la mise à jour ...
                </div>';
            ?>

            <script>
                    function redirect()
                    {
                        document.location.href="../interface/index.php";
                    }
                    setTimeout(redirect,1000);
            </script>
            <?php
        }
    }
?>