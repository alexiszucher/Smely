<?php

    function getRapports()
    {
        require '../ConnexionBDD.php';
        $requete = $bdd->prepare("SELECT * from rapports where id_projet=".$_SESSION['idProjet']." ORDER BY id desc");
        // exécute
        $requete->execute(); 
        $nbTaches = 1;
        while($rapport = $requete->fetch(PDO::FETCH_ASSOC))
        {
            echo "<h4><b>Rapport du ".strftime('%d / %m / %Y',strtotime($rapport['date']))." : ".$rapport['libelle']."</b> <a href='?supprRapport=true&idRapport=".$rapport['id']."'><button class='btn btn-warning'>supprimer ?</button></a></h4>
                <p>".$rapport['contenu']."</p><br><br>" ;
        }
    }

    // Fonction de création de rapport
    function creationRapport($libelle, $contenu)
    {
        require '../ConnexionBDD.php';
        $date = date("Y-m-d");
        $requete = $bdd->prepare("INSERT INTO rapports(id_projet, libelle, date, contenu) VALUES(:idProjet, :libelle, :date, :contenu)");
        // :idProjet, :libelle, :date, :contenu
        $requete->bindParam(':idProjet', $_SESSION['idProjet']);
        $requete->bindParam(':libelle', $libelle);
        $requete->bindParam(':date', $date);
        $requete->bindParam(':contenu', $contenu);
        // exécute
        if($requete->execute())
        {
            echo'<div class="alert alert-success" role="alert">
                Rapport Généré ! veuillez patienter pendant la mise à jour ...
                </div>';
            ?>

            <script>
                    function redirect()
                    {
                        document.location.href="../interface/rapports.php";
                    }
                    setTimeout(redirect,1000);
            </script>
            <?php
        }
    }

    function nbRapports()
    {
        require '../ConnexionBDD.php';
        $nbRapports = 0;
        $requete = $bdd->prepare("SELECT COUNT(id) as nb_rapports FROM rapports WHERE id_projet=".$_SESSION['idProjet']);
        
        // exécute
        $requete->execute();
        while($rapport = $requete->fetch(PDO::FETCH_ASSOC))
        {
            $nbRapports = $rapport['nb_rapports'];
        }
        return $nbRapports;
    }

    function supprRapport($idRapport)
    {
        require '../ConnexionBDD.php';
        $nbRapports = 0;
        $requete = $bdd->prepare("DELETE FROM rapports WHERE id=".$idRapport);
        
        // exécute
        if($requete->execute())
        {
            echo'<div class="alert alert-success" role="alert">
                Rapport Supprimé ! veuillez patienter pendant la mise à jour ...
                </div>';
            ?>

            <script>
                    function redirect()
                    {
                        document.location.href="../interface/rapports.php";
                    }
                    setTimeout(redirect,1000);
            </script>
            <?php
        }
    }

?>