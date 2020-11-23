
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../img/logo/algorithm.svg" />
        <script src="js/diashow.js"></script>
        <title>InfoTools - Page Produits</title>
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
            </nav>
        </header>
           <section class="background">
                <section class="logiciel">
                        <h1 class="title"> Nos Logiciels </h1>
                    <?php
                            include 'database.php';
                            global $db;

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
                    
                    <section class="Bureau">
                        <h1 class="title"> Nos Ordinateurs de Bureau </h1>
                        <?php
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
                                                echo '<span> ' . $donnees['PrixProd'] . ' </span>';
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

                    <section class="portable">
                            <h1 class="title"> Nos Ordinateurs Portables </h1>
                        <?php
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
                                                echo '<span> ' . $donnees['PrixProd'] . ' </span>';
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
            <br/><br/><br/>
        </section>
    </body>
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
</html>