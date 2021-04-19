<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../img/logo/algorithm.svg" />
        <script src="js/diashow.js"></script>
        <title>Profil</title>
    </head>
    <body>
        <!-- #region Entête -->
            <header> 
                <!-- Logo + Text -->
                <div class="logo-container">
                    <img src="../img/logo/algorithm.svg" alt="logo" />
                    <h4 class="logo"><span class="color-info">Info</span>-<b>Tools</b></h4>
                </div>
                    
                <!-- Création de la Barre de Navigation -->
                <nav>
                    <ul class="nav-links">
                        <li><a class="link" href="../index.php">Accueil</a></li>
                        <li><a class="link" href="product.php">Produits</a></li>
                        <li><a class="link" href="appointment.php">Rendez-Vous</a></li>
                        <!-- <li><a class="link" href="php/contact.php">Contact</a></li> -->
                    </ul>
                    <nav class="navbar">

                        <!-- Connexion / Inscription -->
                        <?php
                            // Liaison avec la base de donnée 
                            include 'database.php';
                            global $db;

                            // Si les inputs / session [pseudo] & [mdp] ne sont pas vide alors on se connecte
                            if(isset($_SESSION['Pseudo']) and $_SESSION['Mdp']){
                                echo '<ul class="nav-btn">';
                                echo    '<h1>Menu</h1><br/><br/>';
                                echo    '<li><a class="menu-btn" href="../index.php"><button class="disconnect">Accueil</button></a></li>';
                                echo    '<li><a class="menu-btn" href="product.php"><button class="disconnect">Produits</button></a></li>';
                                echo    '<li><a class="menu-btn" href="appointment.php"><button class="disconnect">Rendez-Vous</button></a></li>';
                                echo    '<h1 style="margin-top:20vh;">Mon Compte</h1><br><br>';
                                echo    '<li><a class="menu-btn" href="profil.php?id='.$_SESSION['IdUti'].'"><button class="disconnect">Mon Profil</button></a></li>';
                                
                                // Si le NumRole de l'utilisateur est égal à 2, alors connexion en tant qu'admin
                                if (isset($_SESSION['Pseudo']) and $_SESSION['Mdp'] and $_SESSION['NumRole'] == 2) {
                                    echo'<li><a class="menu-btn" href="admin/index.php"><button class="disconnect">Admin</button></a></li>';
                                }
                                
                                    echo'<li><a class="menu-btn" href="logout.php"><button class="disconnect">Se Déconnecter</button></a></li>';
                                echo'</ul>';
                            } 
                            
                            // Sinon l'utilisateur n'est pas connecté
                            else {
                                echo'<ul class="nav-btn">';
                                    echo '<h1>Menu</h1><br/><br/>';
                                    echo '<li><a class="menu-btn" href="index.php"><button class="disconnect">Accueil</button></a></li>';
                                    echo '<li><a class="menu-btn" href="#produit"><button class="disconnect">Produits</button></a></li>';
                                    echo '<li><a class="menu-btn" href="#rendezvous"><button class="disconnect">Rendez-Vous</button></a></li>';
                                    echo'<h1 style="margin-top:20vh;">Mon Compte</h1><br><br>';
                                    echo'<li><a class="menu-btn" href="login.php"><button class="disconnect">Se Connecter</button></a></li>';
                                    echo'<li><a class="menu-btn" href="signup.php"><button class="disconnect" href="">S\'Inscrire</button></a></li>';
                                echo'</ul>';
                            }
                        ?>
                    </nav>
                </nav>
                <div class="menu-btn">
                    <i class="fas fa-bars"></i>
                </div>

            </header>
        <!-- #endregion -->

        <!-- #region Profil -->
            <?php

                // Récupére l'id utilisateur dans l'url
                if(isset($_GET['id']) AND $_GET['id'] > 0)
                {
                    $getid = intval($_GET['id']);
                    $requser = $db->prepare('SELECT * FROM utilisateur WHERE IdUti = ?'); //Requête
                    $requser->execute(array($getid)); //Execution de la requête
                    $userinfo = $requser->fetch();
                
            ?>
                <div class="main-image">
                    <?php
                        echo '<h1>Voici ton Profil '.$userinfo['Prenom'].'</h1>';
                    ?>
                    <p>Tu peux modifier les données de ton profil si tu le souhaite !</p>
                    <br/><br/>
                    <a class="profile" href="modifprofil.php">Modifier mon Profil</a>
                    <a class="profilachat" href="pageachat.php?id=<?php echo $_SESSION['IdUti'] ?>">Voir mes achats</a>
                    <div class="profil">
                    <ul>
                        <li><?php echo '<label>Mon Pseudo :</label><h2>'.$userinfo['Pseudo'].'</h2>'; ?></li>
                        <li><?php echo '<label>Mon Adresse Mail :</label><h2>'.$userinfo['Mail'].'</h2>'; ?></li>
                        <li><?php echo '<label>Mon Nom :</label><h2>'.$userinfo['Nom'].'</h2>'; ?></li>
                        <li><?php echo '<label>Mon Prénom :</label><h2>'.$userinfo['Prenom'].'</h2>'; ?></li>
                    </ul>
                </div>
                </div>
                <br />

            <?php
                }
            ?>
        <!-- #endregion -->

        <!-- #region Footer -->
            <footer>
                <div class="footer">
                    <div class="logo-container-footer">
                        <img src="../img/logo/algorithm.svg" alt="logo" />
                        <h4 class="logo"><span class="color-info">Info</span>-<b>Tools</b></h4>
                    </div>
                    <div class="copyright">Copyright &copy 2020. Tous les droits sont réservés.</div>
                </div>
            </footer>
        <!-- #endregion -->

    </body>
</html>