<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../img/logo/algorithm.svg" />
    <script src="js/diashow.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../css/style.css" />
    <title>Mes rendez-vous</title>
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
                        // Si les inputs / session [pseudo] & [mdp] ne sont pas vide alors on se connecte
                        if(isset($_SESSION['Pseudo']) and $_SESSION['Mdp']){
                            echo '<ul class="nav-btn">';
                            echo    '<h1>Menu</h1><br/><br/>';
                            echo    '<li><a class="menu-btn" href="../../index.php"><button class="disconnect">Accueil</button></a></li>';
                            echo    '<li><a class="menu-btn" href="../product.php"><button class="disconnect">Produits</button></a></li>';
                            echo    '<li><a class="menu-btn" href="../appointment.php"><button class="disconnect">Rendez-Vous</button></a></li>';
                            echo    '<h1 style="margin-top:20vh;">Mon Compte</h1><br><br>';
                            echo    '<li><a class="menu-btn" href="../profil.php?id='.$_SESSION['IdUti'].'"><button class="disconnect">Mon Profil</button></a></li>';
                            
                            // Si le NumRole de l'utilisateur est égal à 2, alors connexion en tant qu'admin
                            if (isset($_SESSION['Pseudo']) and $_SESSION['Mdp'] and $_SESSION['NumRole'] == 2) {
                                echo'<li><a class="menu-btn" href="../admin/index.php"><button class="disconnect">Admin</button></a></li>';
                            }
                            
                                echo'<li><a class="menu-btn" href="../logout.php"><button class="disconnect">Se Déconnecter</button></a></li>';
                            echo'</ul>';
                        } 
                        
                        // Sinon l'utilisateur n'est pas connecté
                        else {
                            echo'<ul class="nav-btn">';
                                echo '<h1>Menu</h1><br/><br/>';
                                echo    '<li><a class="menu-btn" href="../../index.php"><button class="disconnect">Accueil</button></a></li>';
                                echo    '<li><a class="menu-btn" href="../product.php"><button class="disconnect">Produits</button></a></li>';
                                echo    '<li><a class="menu-btn" href="../appointment.php"><button class="disconnect">Rendez-Vous</button></a></li>';
                                echo'<h1 style="margin-top:20vh;">Mon Compte</h1><br><br>';
                                echo'<li><a class="menu-btn" href="../login.php"><button class="disconnect">Se Connecter</button></a></li>';
                                echo'<li><a class="menu-btn" href="../signup.php"><button class="disconnect" href="">S\'Inscrire</button></a></li>';
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
    <br><br>
    <h1 class="rdv-commercial">Vos rendez-vous à venir ! <a href="ajout.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter RDV </a></h1>
    <?php
        require '../database.php';
        global $db;

        $id = $_SESSION['IdUti'];
        // if(!empty($_GET['id'])) 
        // {
        //     $id = checkInput($_GET['id']);
        // }
    
        $statement = $db->prepare("SELECT * FROM rdv R INNER JOIN rdv_commercial C ON R.IdRDV = C.IdRDV WHERE C.IdUti = ?");
        $statement->execute(array($id));
        $rdv = $statement->fetch();


        function checkInput($data) 
        {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
    ?>
    <!-- Tableau Affiche tout les rdvs -->
    <table class="table table-stripped table-bordered" style="width: 1500px; margin:auto; text-align:center;">
        <thead>
            <tr>
            <th>IdRdv</th>
                <th>IdProsp</th>
                <th>IdUti</th>
                <th>Contenu</th>
                <th>DteRDV</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if(!empty($_GET['id'])) 
            {
                $id = checkInput($_GET['id']);
            }

            date_default_timezone_set('Europe/Paris');
            $dateheure = date('Y-m-d H:i:s');

            $statement = $db->query("SELECT C.IdRDV, IdProsp, R.IdUti, Contenu, DteRDV FROM rdv R INNER JOIN rdv_commercial C ON R.IdRDV = C.IdRDV WHERE C.IdUti = $id AND DteRDV > '$dateheure' ORDER BY DteRDV");
            $statement->execute(array($id));
            while($rdv = $statement->fetch()) 
            {
                echo '<tr>';
                echo '<td>'. $rdv['IdRDV'] . '</td>';
                echo '<td>'. $rdv['IdProsp'] . '</td>';
                echo '<td>'. $rdv['IdUti'] . '</td>';
                echo '<td>'. $rdv['Contenu'] . '</td>';
                echo '<td>'. $rdv['DteRDV'] . '</td>';
                echo '<td width=300>';
                // echo '<a class="btn btn-primary" href="update.php?id='.$rdv['IdRDV'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                // echo ' ';
                echo '<a class="btn btn-danger" href="delete.php?id='.$rdv['IdRDV'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                echo '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
    
    <br><br>
    <h1 class="rdv-commercial">Historique des rendez-vous</h1>
    <!-- Tableau Affiche tout les rdvs -->
    <table class="table table-stripped table-bordered" style="width: 1500px; margin:auto; text-align:center;">
        <thead>
            <tr>
                <th>IdRdv</th>
                <th>IdProsp</th>
                <th>IdUti</th>
                <th>Contenu</th>
                <th>DteRDV</th>
                <th>Action</th>
                <!-- <th>Actions</th> -->
            </tr>
        </thead>
        <tbody>
        <?php
            if(!empty($_GET['id'])) 
            {
                $id = checkInput($_GET['id']);
            }

            $statement = $db->query("SELECT C.IdRDV, IdProsp, R.IdUti, Contenu, DteRDV FROM rdv R INNER JOIN rdv_commercial C ON R.IdRDV = C.IdRDV WHERE C.IdUti = $id and DteRDV < current_timestamp() ORDER BY DteRDV DESC");
            $statement->execute(array($id));
            while($rdv = $statement->fetch()) 
            {
                echo '<tr>';
                echo '<td>'. $rdv['IdRDV'] . '</td>';
                echo '<td>'. $rdv['IdProsp'] . '</td>';
                echo '<td>'. $rdv['IdUti'] . '</td>';
                echo '<td>'. $rdv['Contenu'] . '</td>';
                echo '<td>'. $rdv['DteRDV'] . '</td>';
                echo '<td width=300>';
                // echo '<a class="btn btn-primary" href="update.php?id='.$rdv['IdRDV'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                // echo ' ';
                echo '<a class="btn btn-danger" href="delete.php?id='.$rdv['IdRDV'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                echo '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
    <script src="../../js/script.js"></script>
</body>
</html>