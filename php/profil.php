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
                    <li><a class="link" href="contact.php">Contact</a></li>
                </ul>
                <nav class="navbar">
                    <?php 
                        //Connexion/Inscription 
                        include 'php/database.php';//Inclusion de la bdd
                        global $db;
        
                        if(isset($_SESSION['Pseudo']) and $_SESSION['Mdp']){ //Si la Session pseudo et mdp n'est pas nul alors CONNEXION            
                                echo'<ul class="nav-btn">';
                                    echo'<h1>Mon Compte</h1><br><br>';
                                    echo'<li><a class="menu-btn" href="php/profil.php?id='.$_SESSION['IdUti'].'"><button class="disconnect">Mon Profil</button></a></li>';
                                    if (isset($_SESSION['Pseudo']) and $_SESSION['Mdp'] and $_SESSION['NumRole'] == 2) {
                                            echo'<li><a class="menu-btn" href="php/admin/index.php"><button class="disconnect">Admin</button></a></li>';
                                    }
                                    // echo'<a href="php/signup.php"><button class="signup" href="">S\'Inscrire</button></a>
                                    echo'<li><a class="menu-btn" href="php/logout.php"><button class="disconnect">Se Déconnecter</button></a></li>';
                                    echo'</ul>';
                            }
                            else{//Sinon PAS CONNEXION
                                echo'<ul class="nav-btn">';
                                    echo'<h1>Mon Compte</h1><br><br>';
                                    echo'<li><a class="menu-btn" href="php/login.php"><button class="disconnect">Se Connecter</button></a></li>';
                                    echo'<li><a class="menu-btn" href="php/signup.php"><button class="disconnect" href="">S\'Inscrire</button></a></li>';
                                    echo'</ul>';
                            }

                            
                    ?>
                </nav>
            </nav>
        </header>
        <?php
            include 'database.php';//BDD
            global $db;

            if(isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $getid = intval($_GET['id']);
                $requser = $db->prepare('SELECT * FROM utilisateur WHERE IdUti = ?');//Requête
                $requser->execute(array($getid));//Execution de la requête
                $userinfo = $requser->fetch();
            
        ?>
            <div class="main-image">
                <?php
                    echo '<h1>Voici ton Profil '.$userinfo['Prenom'].'</h1>';
                ?>
                <p>Tu peux modifier les données de ton profil si tu le souhaite !</p>
                <br>
                <br>
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
        <footer>
            <div class="footer">
                <div class="logo-container-footer">
                    <img src="../img/logo/algorithm.svg" alt="logo" />
                    <h4 class="logo"><span class="color-info">Info</span>-<b>Tools</b></h4>
                </div>
                <div class="copyright">Copyright &copy 2020. Tous les droits sont réservés.</div>
           </div> 
        </footer>
    </body>
</html>