<?php
    include_once "includes/con_database.inc.php";

    // restriction d'accès : si l'utilisateur n'est pas connecté, on l'empéche de venir sur cette page avec une redirection.
if(empty($_SESSION['membre'])) {
    // si c'est vide ou ça n'existe pas, alors l'utilisateur n'est pas connecté, on le redirige
    header('location:connexion.php');
}

if(isset($_POST['pseudo'])) {

    $new_pseudo = $_POST['pseudo'];
    $membre_id = $_SESSION['membre']['id_user'];

    $membre_update = $conn->prepare("
        UPDATE membre
        SET pseudo = '$new_pseudo'
        WHERE id_user = '$membre_id'
    ");
    
    $membre_update->execute();
    $_SESSION['membre']['pseudo'] = $new_pseudo;
    // header('location:modification.php');
}

if(isset($_POST['mdp'])) {

    $new_mdp = $_POST['mdp'];
    $membre_id = $_SESSION['membre']['id_user'];

    $membre_update = $conn->prepare("
        UPDATE membre
        SET mdp = '$new_mdp'
        WHERE id_user = '$membre_id'
    ");
    
    $membre_update->execute();
    $_SESSION['membre']['mdp'] = $new_mdp;
    // header('location:modification.php');
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/modification.css">
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
                <a href="deconnexion.php">Deconnexion</a>
                <a href="inscription.php">Inscription</a>
        </nav>
    </header>

    <section>
        <div class="divconnexion">
        <h2> Bienvenue :
        
        <?php 
        if(isset($_SESSION['membre']['pseudo'])) {
            echo $_SESSION['membre']['pseudo']; //  Affiche nom membre connecter
        }
        ?>
        </h2>
                    
        </div>
    </section>

    <div class="EbgnM">
        <section class="EformM">
 
                <h2>Modification :</h2>

                <form id="formPseudo" method="post" action="">
                <div>
						<?php
						if(isset($err_pseudo)){
							echo $err_pseudo;
						}
										
						if(!isset($pseudo)){
							$pseudo = $_SESSION['membre']['pseudo'];
						}
					?>
					<label>Pseudo :</label>
					<br>
					<input type="text" placeholder="New Pseudonyme" name="pseudo">
                    <input type="submit" value="Modifier" class="mdpM" name="Modification1">
                </div>
                <form>

                <form id="formMdp" method="post" action="">
                <div>
					<?php
						if(isset($err_mdp)){
							echo $err_mdp;
						}
								
						if(!isset($mdp)){
							$mdp = $_SESSION['membre']['mdp'];
						}
					?>
					<label>Mdp :</label>
					<br>
					<input type="password" placeholder="New Password" name="mdp">
                    <input type="submit" value="Modifier" class="mdpM" name="Modification2">
				</div>
                <form>

        </section>

    </div>
</body>

</html>