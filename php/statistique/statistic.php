<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">

        <link rel="shortcut icon" href="../../img/logo/algorithm.svg" />
        <script src="js/diashow.js"></script>
        <title>Statistique</title>
    </head>
    <body>
        <!-- #region Entête -->
            <header> 
                <!-- Logo + Text -->
                <div class="logo-container">
                    <img src="../../img/logo/algorithm.svg" alt="logo" />
                    <h4 class="logo"><span class="color-info">Info</span>-<b>Tools</b></h4>
                </div>
                    
                <!-- Création de la Barre de Navigation -->
                <nav>
                    <ul class="nav-links">
                        <li><a class="link" href="../../index.php">Accueil</a></li>
                        <li><a class="link" href="../product.php">Produits</a></li>
                        <li><a class="link" href="../appointment.php">Rendez-Vous</a></li>
                        <!-- <li><a class="link" href="php/contact.php">Contact</a></li> -->
                    </ul>
                    <nav class="navbar">

                        <!-- Connexion / Inscription -->
                        <?php
                            // Liaison avec la base de donnée 
                            include '../database.php';
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

                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {

                            var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            ['Work',     11],
                            ['Eat',      2],
                            ['Commute',  2],
                            ['Watch TV', 2],
                            ['Sleep',    7]
                            ]);

                            var options = {
                            title: 'My Daily Activities'
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                            chart.draw(data, options);
                        }
                    </script>

            </header>
        <!-- #endregion -->

        <!-- #region Profil -->
            
            <section class="statistic">
                <div class="container">
                    <div id="piechart" style="width: 900px; height: 500px;"></div>
                </div>
            </section>

        <!-- #endregion -->

        <!-- #region Footer -->
            <footer>
                <div class="footer">
                    <div class="logo-container-footer">
                        <img src="../../img/logo/algorithm.svg" alt="logo" />
                        <h4 class="logo"><span class="color-info">Info</span>-<b>Tools</b></h4>
                    </div>
                    <div class="copyright">Copyright &copy 2020. Tous les droits sont réservés.</div>
                </div>
            </footer>
        <!-- #endregion -->

    </body>
</html>