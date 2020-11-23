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
                        include 'database.php';//Inclusion de la bdd
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

            <!-- Création du "Container" permettant la connexxion -->
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
                            <input type="text" name="lpseudo" autocomplete="off" required/>
                            <label for="lpseudo" class="label-name">
                                <span class="lpseudo-name">Pseudo *</span>
                            </label>
                        </div>
                        <div class="formulaire-lpassword">
                            <input type="password" name="lpassword" minlength="8" autocomplete="off" required/>
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

                        if(!empty($lpseudo) && !empty($lpassword)) {
                            $q = $db->prepare("SELECT * FROM utilisateur WHERE Pseudo = '$lpseudo'");
                            $q->execute(['Pseudo' => $lpseudo]);
                            $result = $q->fetch();

                            
                            if($result == true) {                                
                                //Le compte existe bien 
                                $hashpassword = $result['Mdp'];
                            
                                if(password_verify($lpassword, $result['Mdp'])) {
                                    session_start();
                                    $_SESSION['Pseudo'] = $result['Pseudo'];
                                    $_SESSION['Mdp'] = $result['Mdp'];
                                    $_SESSION['IdUti'] = $result['IdUti'];
                                    $_SESSION['NumRole'] = $result['NumRole'];

                                    header('Location: ../Index.php?id='.$_SESSION['IdUti']);
                                    exit();
                                } else {
                                    echo '<h2>Mot de passe Inccorect.</h2>';
                                }
                            } else {
                                echo '<h2>' .$lpseudo. ' n\'existe pas.</h2>';
                            }
                        } else {
                            echo '<h2>Champs Incomplets</h2>';
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