<?php
    include_once "includes/con_database.inc.php";

    // restriction d'accès : si l'utilisateur n'est pas connecté, on l'empéche de venir sur cette page avec une redirection.
if(empty($_SESSION['membre'])) {
    // si c'est vide ou ça n'existe pas, alors l'utilisateur n'est pas connecté, on le redirige
    header('location:connexion.php');
    
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
    <main class="leclassement">
        <img src="img/podium.jpg" alt="podium">
        <section class="leaderboard">
            
            <div class="position">
                <h2>Rang</h2>
                <div class="pos">
                    <p>1</p>
                    <p>2</p>
                    <p>3</p>
                    <p>4</p>
                </div>
            </div>
            <div class="name">
                <h2>Nom</h2>
                <div class="lesnoms">
                    <p>John</p>
                    <p>Jack</p>
                    <p>Rene</p>
                    <p>Henri</p>
                </div>
            </div>
            <div class="nombre">
                <h2>Réponses</h2>
                <div class="lesreponses">
                    <p>156</p>
                    <p>125</p>
                    <p>103</p>
                    <p>45</p>
                </div>
            </div>
            <div class="score">
                <h2>Points</h2>
                    <div class="lesscores">
                        <p>3205</p>
                        <p>2780</p>
                        <p>2197</p>
                        <p>1214</p>
                    </div>
            </div>
        </section>

    </main>

    <section class="moi">
        <div class="position">
            <div class="pos">
                <p>5</p>
            </div>
        </div>
        <div class="name">
            <div class="lesnoms">
                <p>Arthur</p>
            </div>
        </div>
        <div class="nombre">
            <div class="lesreponses">
                <p>15</p>
            </div>
        </div>
        <div class="score">
                <div class="lesscores">
                    <p>324</p>
                </div>
        </div>
    </section>


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