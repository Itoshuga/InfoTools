<?php 
// Creation ou Restauration d'une sessions déjà existante sur le serveur
session_start();
?>
<!DOCTYPE html>
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
        <title>InfoTools - Page Produits</title>
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

    <!-- #region Produits -->
        <section class="background">

            <!-- #region Categorie Logiciel -->
                <section class="logiciel">
                    <h1 class="title"> Nos Logiciels </h1>
                    <?php
                        // Affichage des Produits correspondant à la catégorie [LOGICIEL]
                        $req = $db->query('SELECT Imgsrc, NomProd, PrixProd, DescProd FROM produit WHERE NumCat = "LOG"');
                        while($donnees = $req->fetch()) {
                            echo '<ul class="conteneur-produit">';
                                echo '<li class="conteneur">';
                                    echo '<div class="module">';
                                        echo '<img class="img-medium" src="../img/product/'.$donnees['Imgsrc'].'"/>';
                                    echo '</div>';
                                    echo '<div class="bottom-container">';
                                        echo '<div class="nom">';
                                            echo '<span> ' . $donnees['NomProd'] . ' </span>';
                                        echo '</div>'; 
                                        echo '<div class="prix">';
                                            echo '<span> ' . $donnees['PrixProd'] . ' € </span>';
                                        echo '</div>';
                                        echo '<div class="desc">';
                                            echo '<span> ' . $donnees['DescProd'] . ' </span>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                //echo '<button class="buy">Acheter</button>';
                                echo '</li>';
                            echo '</ul>';
                        }
                    ?>
                </section>
            <!-- #endregion -->

            <!-- #region Categorie PC Bureau -->
                <section class="Bureau">
                    <h1 class="title"> Nos Ordinateurs de Bureau </h1>
                    <?php
                    // Affichage des Produits correspondant à la catégorie [ORDINATEUR DE BUREAU]
                        $req = $db->query('SELECT Imgsrc, NomProd, PrixProd, DescProd FROM produit WHERE NumCat = "PCB"');
                        while($donnees = $req->fetch()) {
                            echo '<ul class="conteneur-produit">';
                                echo '<li class="conteneur">';
                                    echo '<div class="module">';
                                        echo '<img class="img-medium" src="../img/product/'.$donnees['Imgsrc'].'"/>';
                                    echo '</div>';
                                    echo '<div class="bottom-container">';
                                        echo '<div class="nom">';
                                            echo '<span> ' . $donnees['NomProd'] . ' </span>';
                                        echo '</div>'; 
                                        echo '<div class="prix">';
                                            echo '<span> ' . $donnees['PrixProd'] . ' € </span>';
                                        echo '</div>';
                                        echo '<div class="desc">';
                                            echo '<span> ' . $donnees['DescProd'] . ' </span>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                                // echo '<button class="buy">Acheter</button>';
                            echo '</li>';
                        echo '</ul>';
                        }
                    ?>
                </section>
            <!-- #endregion -->

            <!-- #region Categorie PC Portable -->
                <section class="portable">
                    <h1 class="title"> Nos Ordinateurs Portables </h1>
                    <?php
                    // Affichage des Produits correspondant à la catégorie [PC PORTABLE]
                        $req = $db->query('SELECT Imgsrc, NomProd, PrixProd, DescProd FROM produit WHERE NumCat = "PCP"');
                        while($donnees = $req->fetch()) {
                            echo '<ul class="conteneur-produit">';
                                echo '<li class="conteneur">';
                                    echo '<div class="module">';
                                        echo '<img class="img-medium" src="../img/product/'.$donnees['Imgsrc'].'"/>';
                                    echo '</div>';
                                    echo '<div class="bottom-container">';
                                        echo '<div class="nom">';
                                            echo '<span> ' . $donnees['NomProd'] . ' </span>';
                                        echo '</div>'; 
                                        echo '<div class="prix">';
                                            echo '<span> ' . $donnees['PrixProd'] . ' € </span>';
                                        echo '</div>';
                                        echo '<div class="desc">';
                                            echo '<span> ' . $donnees['DescProd'] . ' </span>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                                //echo '<button class="buy">Acheter</button>';
                            echo '</li>';
                        echo '</ul>';
                        }
                    ?>
                </section>
            <!-- #enregion -->

            <br/><br/><br/>
        </section>
    <!-- #endregion -->

        <script src="../js/script.js"></script>
    </body>

    <!-- #region Footer -->
        <footer>
            <div class="footer" style="background-color: #FFF;">
            <br/>
                <div class="logo-container-footer">
                    <img src="../img/logo/algorithm.svg" alt="logo" />
                    <h4 class="logo"><span class="color-info">Info</span>-<b>Tools</b></h4>
                </div>
                <div class="copyright">Copyright &copy 2020. Tous les droits sont réservés.</div>
            <br/>
            </div> 
        </footer>
    <!-- #enregion -->
</html>