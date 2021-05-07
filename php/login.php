<!DOCTYPE html> 
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../css/style.css" media="all">
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../img/logo/algorithm.svg" />
        <title>InfoTools - Log In</title>
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

            <div class="header">
                <main>
                    <br/>
                    <section class="connect-container">
                        <div class="image-connect">
                            <img src="../img/connexion/login.svg" alt="PC n' Cafe" />
                        </div>
                        <div class="connexion-login">
                            <h1>Bon retour sur Info<b>Tools</b></h1>
                            <p>L'un des meilleurs site sur l'informatique.</p>

                                <form method="POST">
                                    <div class="formulaire-lname">
                                        <input type="text" name="lmail" autocomplete="off" required/>
                                        <label for="lmail" class="label-name">
                                            <span class="lpseudo-name">Adresse Mail *</span>
                                        </label>
                                    </div>
                                    <div class="formulaire-lpassword">
                                        <input type="password" name="lpassword" minlength="7" autocomplete="off" required/>
                                        <label for="lpassword" class="label-name">
                                            <span class="lpseudo-name">Mot de Passe *</span>
                                        </label>
                                    </div>
                                    <input class="btnco" type="submit" value="Connexion" name="formlogin" id="formlogin">
                                </form>
                                <p>Vous n'avez pas de compte ? <a class="create-account" href="signup.php">Créer un compte</a></p>

                                <?php
                                if(isset($_POST['formlogin'])) {
                                    extract($_POST);

                                    include 'database.php';
                                    global $db;

                                    if(!empty($lmail) && !empty($lpassword)) {
                                        $q = $db->prepare("SELECT * FROM utilisateur WHERE Mail = '$lmail'");
                                        $q->execute(['Mail' => $lmail]);
                                        $result = $q->fetch();

                                        
                                        if($result == true) {                                
                                            //Le compte existe bien 
                                            $hashpassword = $result['Mdp'];
                                        
                                            if(password_verify($lpassword, $result['Mdp'])) {
                                                session_start();
                                                $_SESSION['Mail'] = $result['Mail'];
                                                $_SESSION['Mdp'] = $result['Mdp'];
                                                $_SESSION['Pseudo'] = $result['Pseudo'];
                                                $_SESSION['IdUti'] = $result['IdUti'];
                                                $_SESSION['NumRole'] = $result['NumRole'];

                                                header('Location: ../Index.php?id='.$_SESSION['IdUti']);
                                                exit();
                                            } else {
                                                echo '<h2>Mot de passe Inccorect.</h2>';
                                            }
                                        } else {    
                                            echo '<h2>' .$lmail. ' n\'existe pas.</h2>';
                                        }
                                    } else {
                                        echo '<h2>Champs Incomplets</h2>';
                                    }
                                    // Eléments d'authentification LDAP
                                    $ldaprdn  = $lmail;     // DN ou RDN LDAP
                                    $ldappass = $lpassword;  // Mot de passe associé

                                    // Connexion au serveur LDAP
                                    $ldapconn = ldap_connect("ldap://51.75.214.56")
                                        or die("Impossible de se connecter au serveur LDAP.");

                                    if ($ldapconn) {

                                        // Connexion au serveur LDAP
                                        $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

                                        // Vérification de l'authentification
                                        if ($ldapbind) {
                                            session_start();
                                            $_SESSION['Mail'] = $result['Mail'];
                                            $_SESSION['Mdp'] = $result['Mdp'];
                                            $_SESSION['Pseudo'] = $result['Pseudo'];
                                            $_SESSION['IdUti'] = $result['IdUti'];
                                            $_SESSION['NumRole'] = $result['NumRole'];
                                            echo "<h2>Connexion LDAP réussie...</h2>";
                                            header('refresh:3;url=../Index.php?id='.$_SESSION['IdUti']);
                                            exit();
                                        } else {
                                            echo "<h2>Connexion LDAP échouée...</h2>";
                                        }

                                    }
                                }
                                ?>
                        </div>
                    </section>
                    <div class="void">
                        <br/>
                    </div>
                </main>
            </div>
    </body>
</html>