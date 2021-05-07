<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>InfoTools</title>
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

    <!-- #region Formulaire de Rendez-Vous -->
        <!-- #region Partie HTML -->
            <form method="post">
                <div class="container">
                    <div class="form-group">
                        <label for="Nom">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                    </div>

                    <div class="form-group">
                        <label for="Prenom">Prénom :</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
                    </div>

                    <div class="form-group">
                        <label for="Mail">Email :</label>
                        <input type="text" class="form-control" id="mail" name="mail" placeholder="Mail" required>
                    </div>

                    <div class="form-group">
                        <label for="Tel">Téléphone :</label>
                        <input type="text" class="form-control" id="tel" name="tel" placeholder="Téléphone" required>
                    </div>

                    <div class="form-group">
                        <label for="Contenu">Contenu :</label>
                        <textarea type="text" class="form-control" id="contenu" name="contenu" placeholder="Contenu" required></textarea>
                    </div>

                    <?php
                        date_default_timezone_set('Europe/Paris');
                        $date = date('Y-m-d');
                        $heure = date('H:i');
                    
                        echo '<div class="form-group">';
                            echo '<label for="DateRDV">Date de RDV :</label>';
                            echo '<input type="datetime-local" class="form-control" id="daterdv" name="daterdv" min="'.$date.'T'.$heure.'" placeholder="Date de RDV" required >';
                        echo '</div>';
                    ?>

                    <!-- <div class="form-group">
                        <label for="HeureRDV">Heure de RDV :</label>
                        <input type="time" class="form-control" id="heurerdv" name="heurerdv" placeholder="Heure de RDV" required 
                        min="8:00" max="18:00">
                    </div> -->
                    
                    <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Prendre rendez-vous">
                </div>
            </form>
        <!-- #endregion -->
        
        <!-- #region Partie PHP -->
            <?php
                // Extraction du formulaire d'inscription avce la méthode $_POST
                if(isset($_POST['submit'])){
                    extract($_POST);

                    $idprosp = $db->query("SELECT MAX(IdProsp) as idprosp FROM prospects"); //Selectionne la dernière ligne de la table pointage l'utilisateur correspond à l'id
                    $idProsp = $idprosp->fetch();

                    $idprosp = $idProsp['idprosp'];

                    //Prépartion de la requête 
                    $rdv = $db->prepare("INSERT INTO rdv(IdProsp, Contenu, DteRDV) VALUES('$idprosp', '$contenu','$daterdv')");
                    $rdv->execute([
                        'IdProsp' => $idprosp,
                        'Contenu' => $contenu,
                        'DteRDV' => $daterdv
                    ]);


                    $maxid = $db->query("SELECT MAX(IdRDV) as MaxId FROM rdv"); //Selectionne la dernière ligne de la table pointage l'utilisateur correspond à l'id
                    $MaxId = $maxid->fetch();

                    $maxid = $MaxId['MaxId'];

                    $statement = $db->prepare("INSERT INTO prospects(IdRDV, Nom, Prenom, Mail, Tel) VALUES('$maxid', '$nom', '$prenom', '$mail', '$tel')"); //Prepare la requete qui insère dans la table commercial l'IdRDV et l'IdUti
                    $statement->execute([ //Execute la requete
                        'IdRDV' => $maxid,
                        'Nom' => $nom,
                        'Prenom' => $prenom,
                        'Mail' => $mail,
                        'Tel' => $tel
                    ]);
                    echo '<div class="">';
                        echo '<center><h3 class="text-success">Votre rendez-vous a bien été prit en compte.</h3></center>';
                    echo '</div>';
                }
            ?>
        <!-- #endregion -->
    <!-- #endregion -->

        <script src="../js/script.js"></script>
    </body>
</html>