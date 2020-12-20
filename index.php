<?php
    include_once "includes/con_database.inc.php"; // les outils php pour le bon fonctionnement de ce site (ouverture de session, connexion à la BDD ...)
    $msg = "";
    // Code PHP

    // restriction d'accès : si l'utilisateur n'est pas connecté, on l'empéche de venir sur cette page avec une redirection.
    if(empty($_SESSION['membre'])) {
        // si c'est vide ou ça n'existe pas, alors l'utilisateur n'est pas connecté, on le redirige
        header('location:deconnexion.php');
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
            <a href="modification.php">
                <?php
            if(isset($_SESSION['membre']['pseudo'])) {
                echo $_SESSION['membre']['pseudo']; //  Affiche nom membre connecter
            }
            ?>
            </a>
		</nav>

     </header>


       <!-----------------------------MAIN--------------------------->
    <main class="sondages">
    <?php
        $liste_sond_term = $conn->query("SELECT * FROM creation WHERE dateFin < now() ORDER BY id_sond DESC");
        ?>

    <article >
        <h2>Sondages : <?php echo $liste_sond_term->rowCount(); ?></h2>
            <section class="titresTermines">
            <?php
                while($sond_term = $liste_sond_term->fetch(PDO::FETCH_ASSOC)){
            
                        $id_sond = $sond_term['id_sond'];
            ?>
                <a href="sondage.php?id=<?php echo $id_sond ?>">   <!-- Redirection vers la page du sondage -->
                    <div class="sond">
                        <h2> <?php echo $sond_term['question'];?></h2>
                        
                        <img src="img/bgd.png" alt="image" class="image">

                        <choix class="choix">
                            <a href="sondage.php?id=<?php echo $id_sond ?>" class="reponse btn-4">Participer !</a>
                        </choix>
                    </div>
                </a>
                 <?php
                }
                ?>

            </section>
    </article>

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