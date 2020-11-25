<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="img/logo/algorithm.svg" />
        <script src="js/diashow.js"></script>

        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
        <title>InfoTools - Landing Page</title>
    </head>
    <body>
        <header> 
            <!-- Logo + Text -->
            <div class="logo-container">
                <img src="img/logo/algorithm.svg" alt="logo" />
                <h4 class="logo"><span class="color-info">Info</span>-<b>Tools</b></h4>
            </div>
            
            <!-- Création de la Barre de Navigation -->
            <nav>
                <ul class="nav-links">
                    <li><a class="link" href="index.php">Accueil</a></li>
                    <li><a class="link" href="#produit">Produits</a></li>
                    <li><a class="link" href="#rendezvous">Rendez-Vous</a></li>
                    <li><a class="link" href="php/contact.php">Contact</a></li>
                </ul>
                <nav class="navbar">
                    <?php 
                        //Connexion/Inscription 
                        include 'php/database.php';//Liaision avec la bdd
                        global $db;
        
                        if(isset($_SESSION['Pseudo']) and $_SESSION['Mdp']){ //Si la Session pseudo et mdp n'est pas nul alors CONNEXION            
                                echo'<ul class="nav-btn">';
                                    echo'<h1>Mon Compte</h1><br><br>';
                                    echo'<li><a class="menu-btn" href="php/profil.php?id='.$_SESSION['IdUti'].'"><button class="disconnect">Mon Profil</button></a></li>';
                                    if (isset($_SESSION['Pseudo']) and $_SESSION['Mdp'] and $_SESSION['NumRole'] == 2) {//Si la session NumRole = 2, alors connexion admin
                                            echo'<li><a class="menu-btn" href="php/admin/index.php"><button class="disconnect">Admin</button></a></li>';
                                    }
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
            <div class="menu-btn">
               <i class="fas fa-bars"></i>
           </div>
        </header>

            <!-- Création du contenu Principale [Accueil] -->
        <div class="header">
        <main>
            <section id="accueil" class="presentation">
                <div class="introduction">
                    <div class="text-introduction">
                        <h1>Info-<strong>Tools</strong></h1>
                        <p>La société <em>Info-Tools</em> développe et vend <strong>différents logiciels</strong>.<br/>Elle propose aussi le dimensionnement et la mise en place de l’infrastructure matérielle nécessaire au bon fonctionnement de ses différentes solutions logicielles.<br/>C’est dans son activité de démarchage de nouveaux clients que ce projet vient s’inscrire.</p>
                    </div>
                </div>
                <div class="image">
                    <img id='image'/>
                </div>
            </section>
            <div class="void">
                <br/><br/><br/>
            </div>
        </main>
        </div>

        <!-- Partie Produit -->
        <div id="produit" class="categories-produit">
            <div class="small-container">
                <h2 class="title">Nos Produits</h2>
                <p class="pp">Bien que nous sommes avant tout un centre de developpement de logiciels, nous ne nous arrêtons pas là.  Même si le prix n'est pas toujours une question de grandeur mais plutôt une question de cohérence. Info-Tools met à profits toute ses ressources afin de vous faire profiter du meilleurs au plus bas prix possible.</p>
                <div class="row">
                    <div class="col-3">
                        <?php // 3 requêtes pour afficher 2 produits de la base de données
                            $req = $db->query('SELECT Imgsrc,NomProd,DescProd,PrixProd FROM produit WHERE IdProd=7');
                            while($donnees = $req->fetch()){
                                echo '<img src="img/product/' .$donnees['Imgsrc']. '" alt="' .$donnees['NomProd']. '"/>';
                                echo '<h4>' .$donnees['NomProd']. '</h4>';
                                echo '<p>' .$donnees['PrixProd']. ' €</p>';
                            }
                        ?>
                    </div>
                    <div class="col-3">
                        <?php
                            $req = $db->query('SELECT Imgsrc,NomProd,DescProd,PrixProd FROM produit WHERE IdProd=6');
                            while($donnees = $req->fetch()){
                                echo '<img src="img/product/' .$donnees['Imgsrc']. '" alt="' .$donnees['NomProd']. '"/>';
                                echo '<h4>' .$donnees['NomProd']. '</h4>';
                                echo '<p>' .$donnees['PrixProd']. ' €</p>';
                            }
                        ?>
                    </div>
                    <div class="col-3">
                        <?php
                            $req = $db->query('SELECT Imgsrc,NomProd,DescProd,PrixProd FROM produit WHERE IdProd=5');
                            while($donnees = $req->fetch()){
                                echo '<img src="img/product/' .$donnees['Imgsrc']. '" alt="' .$donnees['NomProd']. '"/>';
                                echo '<h4>' .$donnees['NomProd']. '</h4>';
                                echo '<p>' .$donnees['PrixProd']. ' €</p>';
                            }
                        ?>
                    </div>
                </div>
                <div class="btn-container">
                    <a href="php/product.php"><button class="btn-product">Explorer les Produits</button></a>
                </div>
            </div>
        </div>
        <div id="rendezvous"class="header-appointment ">
        <main>
            <h2 class="title">Prendre un Rendez-Vous</h2>
            <div class="row">
                <div class="col-3">
                    <img src="img/appointment/24-24.png"/>
                    <p class="quote">Prenez rendez vous en ligne, <b>24h/24</b> et <b>7j/7</b>, pour une consultation physique ou vidéo.</p>
                </div>
                <div class="col-3">
                    <img src="img/appointment/bell.png"/>
                    <p class="quote">Prenez contact avec nos <b>experts</b> afin de vous guider dans toute vos <b>démarches</b>.</p>
                </div>
                <div class="col-3">
                    <img src="img/appointment/doc.png"/>
                    <p class="quote">Retrouvez votre <b>historique de rendez-vous</b> et vos <b>documents</b>.</p>
                </div>
            </div>
            <section class="rdv-header">
                <div class="appointment">
                    <h2 class="intro-text-rdv">Prenez un rendez-vous pour une consultation physique ou digitale avec un de nos commerciaux.</h2>
                    <?php
                    if (isset($_SESSION['Pseudo']) and $_SESSION['Mdp']) { //Si on est connecté, alors on peut prendre RDV
                        $IdUti = $_SESSION['IdUti'];
                        ?>
                    <form class="forms-rdv" method="post">
                        <div class"rdv">
                            <input type="date" id="DteRDV" name="DteRDV"><input type="time" id="HeureRDV" name="HeureRDV"><button class="btnkakyon" name ="submit" id="submit" type="submit">Envoyer</button>
                        </div>
                    </form>
                    <?php
                    if(isset($_POST['submit'])) { // Extraction du formulaire avec la méthod $_POST
                        extract($_POST);

                        if (!empty($DteRDV) && !empty($HeureRDV)) {
                            include 'database.php';
                            global $db;
                
                            //Prépartion de la requête 
                            $c = $db->prepare("SELECT DteRDV FROM rdv WHERE DteRDV = $DteRDV");
                            $c->execute(['DteRDV' => $DteRDV]);
                            $result = $c->rowCount();

                            if ($result==0) {//Execution de la requête
                                $requete = $db->prepare("INSERT INTO rdv (IdUti, DteRDV, HeureRDV) VALUES ('$IdUti','$DteRDV','$HeureRDV')");
                                $requete->execute([
                                    'IdUti' => $IdUti,
                                    'DteRDV' => $DteRDV,
                                    'HeureRDV' => $HeureRDV
                                    ]);
                                    echo "Rendez vous prévu le $DteRDV à $HeureRDV";
                                }
                            } else {//errreur lors de l'éxécution de la requête
                                echo "Veuillez remplir les données.";
                            }
                        }
                    } else {// Si pas connecter pour prendre un RDV -> Affiche Btn "Se connecter"
                        echo '<a href="php/login.php"><button class="btn-product" style="margin-left: 100%;">Se connecter</button></a>';
                    }
                    ?>
                </div>
            </section>
        </main>
        </div>
        <script src="js/script.js"></script>
    </body>
    <footer>
            <div class="footer" style="background-color: #FFF5EE;">
                <br/>
                <div class="logo-container-footer">
                    <img src="img/logo/algorithm.svg" alt="logo" />
                    <h4 class="logo"><span class="color-info">Info</span>-<b>Tools</b></h4>
                </div>
                <div class="copyright">Copyright &copy 2020. Tous les droits sont réservés.</div>
                <br/>
           </div> 
    </footer>
</html>