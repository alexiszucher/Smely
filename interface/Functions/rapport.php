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
            echo '<div class="col-lg-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">'.strftime('%d / %m / %Y',strtotime($rapport['date'])).'</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header"></div>
                                    <a class="dropdown-item" href="?supprRapport=true&idRapport='.$rapport['id'].'">Supprimer le rapport</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <h4><b>'.$rapport['libelle'].'</b></h4>
                                <br><br>
                                <p>'.$rapport['contenu'].'</p>
                            </div>
                        </div>
                    </div>
                </div>';
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