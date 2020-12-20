<?php
    include_once "includes/con_database.inc.php"; // les outils php pour le bon fonctionnement de ce site (ouverture de session, connexion à la BDD ...)
    $msg = "";
    // Code PHP

    if(isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
        // On met à jour le statut utilisateur
        $pseudo = $_SESSION['membre']['pseudo'];
        $st_update = $conn->prepare("
        UPDATE membre
        SET statut = '1'
        WHERE pseudo = '$pseudo'
      ");
      $st_update->execute(); 
        session_destroy();
        header('location:connexion.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="CSS/connexion.css">
</head>

<body>

    <header>
        <nav>
            <a href="index.php">
				<img src="img/pie-chart.png" alt="Sondages">
				
			</a>
			<a href="classement.php">
                <img src="img/trophy.png" alt="Classement">

				
			</a>
			<a href="#">
                <img src="img/profile.png" alt="Connexion">

				
			</a>
			<a href="#">
                <img src="img/email (2).png" alt="Contact">

				
			</a>

                <?php
                if(isset($_SESSION['membre'])) {
                    ?>
                <a href="deconnexion.php">Deconnexion</a>
                <?php
                }
                ?>

                <a href="inscription.php">Inscription</a>
        </nav>
    </header>
    

  <?php

    // récupération des saisies utilisateur lors de la validation du formulaire
    if(isset($_POST['pseudo']) && isset($_POST['mdp'])) {

        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];

        // on interroge la BDD pour récupérer les informations de l'utilisateur sur la base de son pseudo
        $recup_infos = $conn->query("SELECT * FROM membre WHERE pseudo = '$pseudo'");

        // on vérifie si on a récupéré une ligne.
        if($recup_infos->rowCount() > 0) {
            // le pseudo est bon

            // on vérifie le mdp, pour cela il faut traiter la réponse avec un fetch
            $infos_membre = $recup_infos->fetch(PDO::FETCH_ASSOC);
            // echo '<pre>'; print_r($infos_membre); echo '</pre>';


            //ne marche pas
            // var_dump(password_verify($mdp, $infos_membre['mdp']));

            // if(password_verify($mdp, $infos_membre['mdp'])) {
                if($mdp == $infos_membre['mdp']) {
            //     // le mdp est bon, on met à jour lel statut utilisateur
            $st_update = $conn->prepare("
                  UPDATE membre
                  SET statut = '2'
                  WHERE pseudo = '$pseudo'
                ");
                $st_update->execute();

            //     // Pour la connexion, on place les informations de l'utilisateur sauf son mdp dans la session pour pouvoir intéroger la session par la suite.
                
                $_SESSION['membre']['id_user'] = $infos_membre['id_user'];
                $_SESSION['membre']['pseudo'] = $infos_membre['pseudo'];
                $_SESSION['membre']['statut'] = $infos_membre['statut'];
                $_SESSION['membre']['mdp'] = $infos_membre['mdp'];
                header('location:index.php');
               
            } else {
                $msg = "<div style='padding: 20px; background-color: red; color: white;'>Mdp incorrect,<br>Veuillez recommencer</div>";
                echo $msg;
                include('deconnexion.php');
            }

        } else {
            // pseudo incorrect
            $msg = "<div style='padding: 20px; background-color: red; color: white;'>Pseudo incorrect,<br>Veuillez recommencer</div>";
            echo $msg;
            include('deconnexion.php');
        }
    } 
?>
    <!-- <section>
        <div class="divconnexion">
        <h2> Bienvenue :
        
        <?php 
        if(isset($_SESSION['membre']['pseudo'])) {
            echo $_SESSION['membre']['pseudo']; //  Affiche nom membre connecter
        }
        ?>

        . Vous êtes connecté !</h2>
                    
        </div>
    </section> -->


</body>

</html>
