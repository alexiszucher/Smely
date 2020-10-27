<?php 
    session_start();

    // Fonction d'affichage des tous les projets au format liste déroulante
    function getListeProjets()
    {
        require '../ConnexionBDD.php';
        $requete = $bdd->prepare("SELECT * from projets INNER JOIN droits_projets ON projets.id = droits_projets.id_projet where id_user=:id");
        $requete->bindParam(':id', $_SESSION['id']);
        // exécute
        $requete->execute();
        while($projet = $requete->fetch(PDO::FETCH_ASSOC))
        {
            $requete2 = $bdd->prepare("SELECT Count(id) as nbTaches from taches where id_projet=".$projet['id']." AND fait=0");
            $requete2->execute();
            while($tache = $requete2->fetch(PDO::FETCH_ASSOC))
            {
                echo "<option value='".$projet['id']."'>".$projet['libelle']." -------------> ".$tache['nbTaches']." Tâches en attentes</option>";
            }
        }
    }



    function getDernierRapport()
    {
        require '../ConnexionBDD.php';
        $requete = $bdd->prepare("SELECT id, libelle, contenu, date from rapports where id_projet=".$_SESSION['idProjet']." ORDER BY id DESC LIMIT 0, 1");
        // exécute
        $requete->execute(); 
        $nb = 1;
        while($rapport = $requete->fetch(PDO::FETCH_ASSOC))
        {
            echo "<h4><b>Rapport du ".strftime('%d / %m / %Y',strtotime($rapport['date']))." : ".$rapport['libelle']."</b></h4>
            <p>".$rapport['contenu']."</p>" ;
        }
    }

    

    function libelleProjet()
    {
        require '../ConnexionBDD.php';
        $requete = $bdd->prepare("SELECT * from projets where id=".$_SESSION['idProjet']);
        // exécute
        $requete->execute(); 
        $nbTaches = 1;
        $libelleProjet = "";
        while($projet = $requete->fetch(PDO::FETCH_ASSOC))
        {
            $libelleProjet = $projet['libelle'];
        }
        return $libelleProjet;
    }

    // Fonction de création de rapport
    function creationProjet($libelle)
    {
        require '../ConnexionBDD.php';
        $date = date("Y-m-d");
        $requete = $bdd->prepare("INSERT INTO projets(libelle) VALUES(:libelle)");
        $requete->bindParam(':libelle', $libelle);

        // exécute
        if($requete->execute())
        {
            $requete = $bdd->prepare("SELECT id from projets where libelle=:libelle");
            $requete->bindParam(':libelle', $libelle);
            $requete->execute();

            //Préparation variable idProjet
            $idProjet;
            //Récupération de l'id du projet créé
            while($projet = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $idProjet = $projet['id'];
            }

            $requete = $bdd->prepare("INSERT INTO droits_projets(id_user,id_projet) VALUES(:id_user,:id_projet)");
            $requete->bindParam(':id_user', $_SESSION['id']);
            $requete->bindParam(':id_projet',$idProjet);
            $requete->execute();
            echo'<div class="alert alert-success" role="alert">
                Projet créé ! veuillez patienter pendant la mise à jour ...
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