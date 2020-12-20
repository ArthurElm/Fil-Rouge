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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fil Rouge</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

 <!-----------------------------HEADER--------------------------->
     <header class="sticky">
        <nav>
			
			<a href="index.html">
				<img src="img/pie-chart.png" alt="Sondages">
				
			</a>
			<a href="classement.html">
                <img src="img/trophy.png" alt="Classement">

				
			</a>
			<a href="#">
                <img src="img/profile.png" alt="Connexion">

				
			</a>
			<a href="#">
                <img src="img/email (2).png" alt="Contact">

				
			</a>
		</nav>

     </header>


       <!-----------------------------MAIN--------------------------->
    <main class="sondages">

        <div class="sond">
            <h2>Sondage 1</h2>
            <img src="img/bgd.png" alt="image" class="image">
            <choix class="choix">
                <a href="sondage.html" class="reponse btn-4">Participer !</a>
            </choix>
        </div>

        <div class="sond">
            <h2>Sondage 1</h2>
            <img src="img/bgd2.jpg" alt="image" class="image">
            <choix class="choix">
                <a href="sondage.html" class="reponse btn-4">Participer !</a>
            </choix>
        </div>

        <div class="sond">
            <h2>Sondage 1</h2>
            <img src="img/bgd3.png" alt="image" class="image">
            <choix class="choix">
                <a href="sondage.html" class="reponse btn-4">Participer !</a>
            </choix>
        </div>

    </main>


    <div class="footer">
        <div class="ligne1">
            <div class="subtitle">
                <p>Site de sondage</p>
            </div>
            <div class="logos">
                <a href="https://www.facebook.com/arthur.elmalawi" target="_blank"><img class="lelogo" src="img/facebook.png" alt="facebook"></a>
    
                <a href="#" target="_blank"><img class="lelogo" src="img/twitter.png" alt="twitter"></a>
    
                <a href="https://www.instagram.com/tur.elm/" target="_blank"><img class="lelogo" src="img/instagram%20(1).png" alt="instagram"></a>
    
                <a href="https://www.linkedin.com/in/arthur-el-malawi/" target="_blank"><img class="lelogo" src="img/linkedin%20(1).png" alt="linkedin">
                </a>
            </div>
        </div>
        <div class="trait3"></div>
        <div class="phrase">
            <p>Site créé dans le cadre d'un projet scolaire</p>
        </div>
    
    
    </div>


</body>
</html>