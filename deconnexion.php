<?php
    include_once "includes/con_database.inc.php"; // les outils php pour le bon fonctionnement de ce site (ouverture de session, connexion à la BDD ...)
    $msg = "";
    // Code PHP
    
    if(isset($_SESSION['membre'])) {
    $pseudo = $_SESSION['membre']['pseudo'];
    $st_update = $conn->prepare("
        UPDATE membre
        SET statut = '1'
        WHERE pseudo = '$pseudo'
    ");
    
    $st_update->execute(); 
    session_destroy();
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

</head>

        <body>

            <section>
                <div class="divconnexion">
                <a href="inscription.php">Inscription</a>
                <h2>Vous n'êtes pas connecté !</h2>
                    <h1>Connexion</h1>

                    <form method="post" action="connexion.php" class="formulaire_connexion">
                        <hr>
                        <label for="pseudo">Pseudo</label>
                        <br>
                        <input type="text" name="pseudo" class="form_connexion" id="pseudo"><br><br>

                        <label for="mdp">Mot de passe</label>
                        <br>
                        <input type="password" name="mdp" class="form_connexion" id="mdp">
                        <hr>

                        <button type="submit" name="connexion" class="form_connexion_submit" id="connexion"> Se connecter </button>

                    </form>
                </div>
            </section>

        </body>

</html>

</body>

</html>
