<?php
    include_once "includes/con_database.inc.php";

    // restriction d'accès : si l'utilisateur n'est pas connecté, on l'empéche de venir sur cette page avec une redirection.
if(empty($_SESSION['membre'])) {
    // si c'est vide ou ça n'existe pas, alors l'utilisateur n'est pas connecté, on le redirige
    header('location:deconnexion.php');
    
}

// verification si ajout ou suppression d'amis demandées
$userConId = $_SESSION['membre']['id_user'];
    
if(isset($_POST['userdelete'])) {

    $amis_supp = $_POST['userdelete'];

    $get_amis_id = $conn->query("SELECT * FROM membre WHERE pseudo = '$amis_supp'");
    $info_get_amis_id = $get_amis_id->fetch(PDO::FETCH_ASSOC);
    $amis_id=$info_get_amis_id['id_user'];
    $st_update = $conn->prepare("
              DELETE FROM amis
              WHERE user_id1 = '$userConId' AND user_id2 = '$amis_id'
            ");
            $st_update->execute();
            header('location:classement.php');
}

if(isset($_POST['useradd'])) {

    $amis_ajout = $_POST['useradd'];

    $get_amis_id = $conn->query("SELECT * FROM membre WHERE pseudo = '$amis_ajout'");
    $info_get_amis_id = $get_amis_id->fetch(PDO::FETCH_ASSOC);
    $amis_id=$info_get_amis_id['id_user'];
    $st_update = $conn->prepare("
              INSERT INTO amis (user_id1, user_id2)
              VALUES ('$userConId', '$amis_id')
            ");
            $st_update->execute();
            header('location:classement.php');
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
    <main class="leclassement">
        <img src="img/podium.jpg" alt="podium">
        <section class="leaderboard">
            <article class="leadAmis">
                <h2> Mes Amis</h2>
                <?php
                    $liste_amis = $conn->query("SELECT * FROM membre WHERE id_user IN (SELECT user_id2 FROM amis WHERE user_id1=$userConId) ORDER BY points DESC");
                        while($info_liste_amis = $liste_amis->fetch(PDO::FETCH_ASSOC)){
                ?>
                                    <div class="ajout">
                                        <div class="name">
                                            <div class="lesnoms">
                                                <p>
                                                    <?php echo $info_liste_amis['pseudo'];?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="score">
                                                <div class="lesscores">
                                                    <p>
                                                        <?php echo $info_liste_amis['points'];?>
                                                    </p>
                                                </div>
                                        </div>

                                        <p> 
                                        
                <?php 
                        $pseudoAmis = $info_liste_amis['pseudo'];
                        $recup_statut_amis = $conn->query("SELECT statut FROM membre WHERE pseudo = '$pseudoAmis'");
                        $info_statut_amis = $recup_statut_amis->fetch(PDO::FETCH_ASSOC);

                    if($info_statut_amis['statut'] == '1') {
                            echo 'Deconnecté';
                        }
                        else{
                            echo "Connecté";
                        }
                ?>
                                        </h2>
                                        <form method="post">
                                        <input id="userdelete" name="userdelete" type="hidden" value="<?php echo $info_liste_amis['pseudo']; ?>">
                                        <button type="submit" name="supprimer_amis" value="Supprimer">Supprimer</button>
                    </form>
                                    </div>
                <?php
                        }
                ?> 
            </article>
            <article class="lead">
            <h2> Ladder</h2>
            <?php
                $liste_non_amis = $conn->query("SELECT * FROM membre WHERE id_user NOT IN (SELECT user_id2 FROM amis WHERE user_id1=$userConId) ORDER BY points DESC");
                while($info_liste_non_amis = $liste_non_amis->fetch(PDO::FETCH_ASSOC)){
            ?>
                    <div class="ajout">
                        <div class="name">
                            <div class="lesnoms">
                                <p>
                                    <?php echo $info_liste_non_amis['pseudo'];?>
                                </p>
                            </div>
                        </div>

                        <div class="score">
                                <div class="lesscores">
                                    <p>
                                        <?php echo $info_liste_non_amis['points'];?>
                                    </p>
                                </div>
                        </div>
                    
                        <form method="post">
                            <input id="useradd" name="useradd" type="hidden" value="<?php echo $info_liste_non_amis['pseudo'];?>">
                            <button type="submit" name="ajouter_amis" value="Ajouter">Ajouter</button>
                        </form>
                    
                    </div>
            <?php
                }
            ?>
                
            </article>
        </section>

    </main>

    <section class="moi">
        <div class="name">
            <div class="lesnoms">
                <p>
                    <?php
                        if(isset($_SESSION['membre']['pseudo'])) {
                            echo $_SESSION['membre']['pseudo']; //  Affiche nom membre connecter
                        }
                    ?>
                </p>
            </div>
        </div>
        <div class="score">
                <div class="lesscores">
                    <p>
                        <?php
                            if(isset($_SESSION['membre']['points'])) {
                                echo $_SESSION['membre']['points']; //  Affiche score du membre connecter
                            }
                        ?>
                    </p>
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