<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../img/logo/algorithm.svg" />
        <title>InfoTools - Appointment</title>
    </head>
    <body class="apt">
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

        <div class="header-appointment ">
        <main>
            <h2 class="title">Prendre un Rendez-Vous</h2>
            <div class="row">
                <div class="col-3">
                    <img src="../img/appointment/24-24.png"/>
                    <p class="quote">Prenez rendez vous en ligne, <b>24h/24</b> et <b>7j/7</b>, pour une consultation physique ou vidéo.</p>
                </div>
                <div class="col-3">
                    <img src="../img/appointment/bell.png"/>
                    <p class="quote">Prenez contact avec nos <b>experts</b> afin de vous guider dans toute vos <b>démarches</b>.</p>
                </div>
                <div class="col-3">
                    <img src="../img/appointment/doc.png"/>
                    <p class="quote">Retrouvez votre <b>historique de rendez-vous</b> et vos <b>documents</b>.</p>
                </div>
            </div>
            <section class="rdv-header">
                <div class="appointment">
                    <h2 class="intro-text-rdv">Prenez un rendez-vous pour une consultation physique ou digitale avec un de nos commerciaux.</h2>
                    <?php
                    session_start();
                    if (isset($_SESSION['Pseudo']) and $_SESSION['Mdp']) {
                        $IdUti = $_SESSION['IdUti'];
                        ?>
                    <form class="forms-rdv" method="post">
                        <div class"rdv">
                            <input type="date" id="DteRDV" name="DteRDV"><input type="time" id="HeureRDV" name="HeureRDV"><button class="btnkakyon" name ="submit" id="submit" type="submit">Envoyer</button>
                        </div>
                    </form>
                    <?php
                    if(isset($_POST['submit'])) {
                        extract($_POST);

                        if (!empty($DteRDV) && !empty($HeureRDV)) {
                            include 'database.php';
                            global $db;
                
                            //Prépartion de la requête 
                            $c = $db->prepare("SELECT DteRDV FROM rdv WHERE DteRDV = $DteRDV");
                            $c->execute(['DteRDV' => $DteRDV]);
                            $result = $c->rowCount();

                            if ($result==0) {
                                $requete = $db->prepare("INSERT INTO rdv (IdUti, DteRDV, HeureRDV) VALUES ('$IdUti','$DteRDV','$HeureRDV')");
                                $requete->execute([
                                    'IdUti' => $IdUti,
                                    'DteRDV' => $DteRDV,
                                    'HeureRDV' => $HeureRDV
                                    ]);
                                    echo "Rendez vous prévu le $DteRDV à $HeureRDV";
                                }
                            } else {
                                echo "Veuillez remplir les données.";
                            }
                        }
                    } else {
                        echo '<a href="login.php"><button class="signup" style="margin-left: 100%;">Se connecter</button></a>';
                    }
                    ?>
                </div>
            </section>
        </main>
        </div>
    </body>
</html>