<?php 
// Creation ou Restauration d'une sessions déjà existante sur le serveur
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../img/logo/algorithm.svg" />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
        <title>InfoTools - Register</title>
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

    <!-- #region Inscription -->
        <div class="header">
            <main>
            <br/>
            <!-- Création du "Container" permettant l'inscription -->
                <section class="register-container">
                    <div class="inscription-register">
                        <h1>Enregistre ton Info-Account</h1>
                        <p>L'un des meilleurs site sur l'informatique.</p>
                        <form  method="post">
                            <div class="forms-top">
                                <input class="inscription" type="text" id="pseudo" name="pseudo" maxlength="15" required placeholder="Votre Pseudo (15 caractères max)" >
                                <input class="inscription" type="text" id="nom" name="nom" required placeholder="Votre Nom" >

                                <input class="inscription" type="text" id="prenom" name="prenom" required placeholder="Votre Prénom" >

                                <input class="inscription" type="email" id="email" name="email" minlength="8" required placeholder="Votre Email">
                                <input class="inscription" type="text" id="adresse" name="adresse" required placeholder="Votre adresse" >

                                <input class="inscription" type="text" id="cp" name="cp" required placeholder="Code Postale" >
                                <input class="inscription" type="text" id="ville" name="ville" required placeholder="Ville" >
                                <input class="inscription" type="tel" id="tel" name="tel" required placeholder="N°téléphone" >

                                <input class="inscription" type="password" id="password" name="passwords" minlength="8" required placeholder="Votre mot de passe (8 caractères min)">
                                <input class="inscription" type="password" id="cpassword" name="cpassword" minlength="8" required placeholder="Comfirmer votre mot de passe (8 caractères min)">
                                <br />
                                <input type='checkbox' name='case' class="general-condition" value='on' required> J'ai lu et j'accepte <a target="_blank" href="../img/charte.pdf">les conditions générales d'utilisation</a>  
                                
                                <input class="create" name="submit" type="submit" value="Créer votre compte">
                                

                                <p>Vous avez déjà un compte ? <a class="log-account" href="login.php">Se connecter</a></p>
                            </div>
                        </form>
                    <?php
                        // Extraction du formulaire d'inscription avce la méthode $_POST
                        if(isset($_POST['submit'])){
                            extract($_POST);
                    
                            // Cryptage du mot de passe en hashpass
                            if(!empty($passwords) && !empty($cpassword) && !empty($email)) {
                                if($passwords == $cpassword) {
                                    $options = [
                                        'cost' => 12,
                                    ];
                                    // Hachage du mot de passe
                                    $hashpass = password_hash($passwords, PASSWORD_BCRYPT, $options);
                            
                                    // Prépartion de la requête 
                                    $c = $db->prepare("SELECT Mail FROM utilisateur WHERE Mail= '$email'");
                                    $c->execute(['Mail' => $email]);
                                    $result = $c->rowCount();
                            
                                    // Création du Compte
                                    if($result == 0) {
                                        $q = $db->prepare("INSERT INTO utilisateur(NumRole, Nom, Prenom, Mdp, Mail, Tel, Adresse, CP, Ville, Pseudo) VALUES(3, '$nom','$prenom','$hashpass','$email','$tel','$adresse','$cp','$ville','$pseudo')");
                                        $q->execute([
                                        'Mail' => $email,
                                        'Mdp' => $hashpass
                                        ]);
                                        echo '<div>';
                                        echo '<h1 class="">Compte Créé.</h1>';
                                        echo '</div>';

                                    // Sinon renvoie une erreur
                                    } else {
                                        echo '<div>';
                                        echo '<h1 class="">Email déjà utilisé.</h1>';
                                        echo '</div>';
                                    }
                                }
                            }
                        }
                    ?>
                    </div>
                    <div class="image-register">
                        <img src="../img/connexion/register.svg" alt="Compte" />
                    </div>
                </section>
                <div class="void">
                    <br/>
                </div>
            </main>
        </div>
    <!-- #endregion -->

        <script src="../js/script.js"></script>
    </body>
</html>