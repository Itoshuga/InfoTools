<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../img/logo/algorithm.svg" />
        <script src="js/diashow.js"></script>
        <title>InfoTools - Landing Page</title>
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
            <div class="header">
                <br/><br/><br/>
                <form id="contact" method="post" action="contact.php">
                <fieldset class="name"><legend>Formulaire de Contact</legend><br>
                    <ul>
                        <li>
                            <label for="nom">Nom * :</label><input class="contact" type="text" id="nom" name="nom" placeholder="Votre Nom" />
                            <label for="nom">Prénom * :</label><input class="contact" type="text" id="prenom" name="prenom" placeholder="Votre Prénom"/>
                            <label for="email">Email * :</label><input class="contact" type="text" id="email" name="email" placeholder="Votre Email"/>
                        </li>
                    <ul>
                <br>
                <br>
                    <label for="nom">Objet * :</label><input class="contact" type="text" id="objet" name="objet" placeholder="Objet"/><br>
                    <textarea id="message" name="message" cols="80" rows="10" placeholder="Votre Message"></textarea><br>
                </fieldset>
                <br>
                <div style="text-align:center;"><input type="submit" name="submit" id="submit" value="Soumettre le formulaire !" /></div>
            </form>
            
            <?php
                //BDD
                include 'database.php';
                global $db;
                // Extraction du formulaire d'inscription avce la méthode $_POST
                if(isset($_POST['submit']))
                {
        
                    extract($_POST);
        
                    //Prépartion de la requête 
                    $c = $db->prepare("SELECT MailCont FROM contact WHERE MailCont= '$email'");
                    $c->execute(['MailCont' => $email]);
                    $result = $c->rowCount();
        
                    if($result == 0){
                        $q = $db->prepare("INSERT INTO contact(NomCont, PrenomCont, MailCont, Objet, Message) VALUES('$nom','$prenom','$email', '$objet', '$message')");
                        $q->execute([
                        'MailCont' => $email
                    ]);
                        echo '<div class="">';
                        echo '<h1 class="">Votre Message à bien été envoyé !</h1>';
                        echo '<a class="" href="../Index.php">Accueil</a>';
                        echo '</div>';
                    }else{
                        echo '<div class="">';
                        echo '<h1 class="">Erreur lors de l\'envoie de votre message !</h1>';
                        echo '<a class="" href="../Index.php">Accueil</a>';
                        echo '</div>';
                    }
                } 
                
                    // DANS LA PAGE ADMIN 
                    // NE PAS UTILISER POUR LE MOMENT 
                               
                    // $req = ('SELECT * FROM contact');//Requête
                    // foreach  ($db->query($req) as $res) 
                    // {
                    //     echo '<h4>'.$res['NomCont'], $res['PrenomCont'].'&nbsp;&nbsp;&nbsp;', $res['MailCont'].'</h4>';
                    //     echo '<h4>'.$res['Objet'].'</h4>';
                    //     echo '<p class="message">'.$res['Message'].'<p>';
                    //     echo '<a href="mailto:?to='.$res['MailCont'].' &subject='.$res['Objet'].' &body='.$res['NomCont'].''.$res['PrenomCont'].' %20à écrit : %0D%0A'.$res['Message'].'"> Test de mailto </a>';
                    // }
                ?>
                <br/><br/><br/>
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