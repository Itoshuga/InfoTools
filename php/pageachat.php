<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../css/style.css" media="all">
        <meta charset="UTF-8">
        <title>Récapitulatif</title>
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
            $IdUti = $_GET['id'];
            include 'database.php';
            global $db;

            $PrixTotal = 0;
            $req = $db->query("SELECT Imgsrc, NomProd, PrixProd, Quantite FROM facturation f INNER JOIN produit p ON f.IdProd = p.IdProd WHERE IdUti = $IdUti GROUP BY Imgsrc, NomProd");
            while($donnees = $req->fetch()){
                echo('<img src="../img/product/'.$donnees['Imgsrc'].'"/></br>' . $donnees['NomProd'] . '</br></br>' . 'Prix : ' . $donnees['PrixProd'] . '</br></br>' . 'Quantité : ' . $donnees['Quantite'] . '</br></br>' . '<br><hr></article>');
                $donnees['PrixProd'] = $donnees['PrixProd'] * $donnees['Quantite'];
                $PrixTotal += $donnees['PrixProd'];
            }        
            echo 'Le prix total est de '.$PrixTotal.' €';
        ?>
    </body>
</html>    