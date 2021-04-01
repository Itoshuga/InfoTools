<?php
session_start();

include 'database.php';
global $db;

if(isset($_SESSION['IdUti']))
{
    $requser = $db->prepare("SELECT * FROM utilisateur WHERE IdUti = ?");
    $requser->execute(array($_SESSION['IdUti']));
    $user = $requser->fetch();

    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['MailUtil'])
    {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $db->prepare("UPDATE utilisateur SET Mail = ? WHERE IdUti = ?");
        $insertmail->execute(array($newmail, $_SESSION['IdUti']));
        header('Location: profil.php?id='.$_SESSION['IdUti']);
    }

    if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['NomUtil'])
    {
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $db->prepare("UPDATE utilisateur SET Nom = ? WHERE IdUti = ?");
        $insertnom->execute(array($newnom, $_SESSION['IdUti']));
        header('Location: profil.php?id='.$_SESSION['IdUti']);
    }

    if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['PrenomUtil'])
    {
        $newprennom = htmlspecialchars($_POST['newprenom']);
        $insertprennom = $db->prepare("UPDATE utilisateur SET Prenom = ? WHERE IdUti = ?");
        $insertprennom->execute(array($newprennom, $_SESSION['IdUti']));
        header('Location: profil.php?id='.$_SESSION['IdUti']);
    }

    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
    {
        if($mdp1 == $mdp2)
        {
            $options = [
                'cost' => 12,
            ];
            $mdp1 = password_hash($_POST['newmdp1'], PASSWORD_BCRYPT, $options);

       
            $insertmdp = $db->prepare("UPDATE utilisateur SET Mdp = ? WHERE IdUti = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['IdUti']));
            header('Location: profil.php?id='.$_SESSION['IdUti']);
        }else{
            $msg = "Vos deux mot de passe ne correspondent pas !";
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="img/logo/algorithm.svg" />
        <script src="js/diashow.js"></script>
        <title>InfoTools - Landing Page</title>
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
        <div align="center" class="main-image">
            <div class="edition">
                <h2>Edition de mon profil !</h2> 
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="modif-top">
                        <label>Mail :</label>
                        <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['Mail']; ?>">
                        <label>Nom :</label>
                        <input type="text" name="newnom" placeholder="Nom" value="<?php echo $user['Nom']; ?>">
                        <label>Prénom :</label>
                        <input type="text" name="newprenom" placeholder="prenom" value="<?php echo $user['Prenom']; ?>">
                    </div>
                    <br>
                    <br>
                    <div class="modif-bottom">
                        <label>Mot de passe :</label>
                        <input type="password" name="newmdp1" placeholder="Mot de passe">
                        <label>Confirmation mot de passe :</label>
                        <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe">
                    </div>
                        <input class="maj" type="submit" value="Mettre à jour mon profil !"/>
                    
                </form>
                <?php if(isset($msg)) { echo $msg; }?>
            </div>
        </div>
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
<?php
}
else
{
    header("Location: Connexion.php");//redirection automatique
}
?>