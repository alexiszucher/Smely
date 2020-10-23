<?php  
    session_start();

    // Fonction de connexion
    function login($email,$mdp)
    {
        require '../ConnexionBDD.php';
        $requete = $bdd->prepare("SELECT * from users where email = :email");
        $requete->bindParam(':email', $email);
        // exécute
        $requete->execute();
        $data=$requete->fetch();

        if (md5($mdp) == $data['mdp']) // Acces OK !
        {
            $_SESSION['id'] = $data['id'];
            $_SESSION['email'] = $data['email'];	
            echo'<div class="alert alert-success" role="alert">
                Connexion Réussi ! chargement de l\'interface en cours...
                </div>';
            ?>

            <script>
                    function redirect()
                    {
                        document.location.href="../interface/index.php?projet=0";
                    }
                    setTimeout(redirect,1000);
            </script>

            <?php
        }
        else
        {
            echo'<div class="alert alert-danger" role="alert">
                Compte incorrect, vérifiez vos identifiants.
                </div>';
        }
        $requete->closeCursor();
    }
    
?>