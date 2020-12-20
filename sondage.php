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
    <main class="lesondage">

    <div class="partie">
                <?php 
                            
                                
                            $id_sond = $_GET['id'];
                            // $verif_id = "";

                            //     if ($verif_id !== $id_sond ){
                            //         print_r ('ouiii sondage');
                            //     }else{
                            //         echo 'Aucun sondage';
                            //         print_r ('Aucun sondage');
                            //     }

                            $sondage = $conn->query("SELECT * FROM creation WHERE id_sond = $id_sond");

                            while($infos_sondage = $sondage->fetch(PDO::FETCH_ASSOC)){
                            ?>
                    <h2> <?php echo $infos_sondage['question'];?> </h2>
                    <img src="img/bgd.png" alt="image" class="image">


            <div class="reponses">
                <button name="choixUn"> <?php echo $infos_sondage['choixUn'];?> </button>
                <button name="choixDeux"> <?php echo $infos_sondage['choixDeux'];?></button>
            </div>
            <?php
                            }
                        
                        
                        ?>

<div class="commentaires">
                <div class="scroll">

                    <!-- LE CHAT -->

                    <div id="messages">

                        <?php
                                
                                $liste_messages = $conn->query("SELECT * FROM messages  ORDER BY sendAt"); //recuperation les messages et leurs infos dans la table

                                //boucle pour afficher les messages
                                while($msg = $liste_messages->fetch(PDO::FETCH_ASSOC)){
                                ?>
                        <div>
                            <!--On affiiche les éléments du message 1 par 1 -->
                            <p> <?php echo $msg['user'];?>&nbsp|&nbsp</p>
                            <p><?php echo $msg['content'];?></p>
                            <p> | <?php echo $msg['sendAt'];?></p>
                        </div>
                        <?php
                                }
                                ?>
                    </div>
                </div>
                <div class="comm">
                    <p><?php  echo $_SESSION['membre']['pseudo']; ?></p>
                    <form name="tchat">
                        <input type="text" id="" required>
                        <button id="send" method="POST" onclick="submitForm()">Envoyer</button>
                    </form>
                </div>
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