<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../../img/logo/algorithm.svg" />
        <script src="js/diashow.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <title>InfoTools - Landing Page</title>
    </head>
    <body>
        <?php
            // Connexion à la base de données et utilisation des produits qui sont dans la base de données
            require 'database.php';
            $db = Database::connect();
        ?>
        <header> 
            <!-- Logo + Text -->
            <div class="logo-container">
                <img src="../../img/logo/algorithm.svg" alt="logo" />
                <h4 class="logo"><span class="color-info">Info</span>-<b>Tools</b></h4>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a class="link" href="../../index.php">Accueil</a></li>
                </ul>
        </header>
        
        <div class="container admin">
            <div class="row">
                <h1><strong>Liste des produits </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
            </div>
            <!-- Tableau Affiche tout les produits -->
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $statement = $db->query('SELECT IdProd, NumCat, NomProd, DescProd, PrixProd, Imgsrc FROM produit ORDER BY produit.IdProd DESC');
                    while($produit = $statement->fetch()) 
                    {
                        echo '<tr>';
                        echo '<td>'. $produit['NomProd'] . '</td>';
                        echo '<td>'. $produit['DescProd'] . '</td>';
                        echo '<td>'. $produit['PrixProd'] . '</td>';
                        echo '<td>'. $produit['NumCat'] . '</td>';
                        echo '<td>'. $produit['Imgsrc'] . '</td>';
                        echo '<td width=300>';
                        echo '<a class="btn btn-default" href="view.php?id='.$produit['IdProd'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                        echo ' ';
                        echo '<a class="btn btn-primary" href="update.php?id='.$produit['IdProd'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="delete.php?id='.$produit['IdProd'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="row">
                <h1><strong>Liste des utilisateurs </strong><a href="Utilisateurs/insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
            </div>
            <!-- Tableau Affiche tout les utilisateurs -->
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Mail</th>
                        <th>Tel</th>
                        <th>Adresse</th>
                        <th>CP</th>
                        <th>Ville</th>
                        <th>Pseudo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $statement = $db->query('SELECT * FROM utilisateur ORDER BY utilisateur.IdUti DESC');
                    while($utilisateur = $statement->fetch()) 
                    {
                        echo '<tr>';
                        echo '<td>'. $utilisateur['NumRole'] . '</td>';
                        echo '<td>'. $utilisateur['Nom'] . '</td>';
                        echo '<td>'. $utilisateur['Prenom'] . '</td>';
                        echo '<td>'. $utilisateur['Mail'] . '</td>';
                        echo '<td>'. $utilisateur['Tel'] . '</td>';
                        echo '<td>'. $utilisateur['Adresse'] . '</td>';
                        echo '<td>'. $utilisateur['CP'] . '</td>';
                        echo '<td>'. $utilisateur['Ville'] . '</td>';
                        echo '<td>'. $utilisateur['Pseudo'] . '</td>';
                        echo '<td width=300>';
                        echo '<a class="btn btn-primary" href="Utilisateurs/update.php?id='.$utilisateur['IdUti'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="Utilisateurs/delete.php?id='.$utilisateur['IdUti'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="row">
                <h1><strong>Liste des rendez-vous </strong></h1>
            </div>
            <!-- Tableau Affiche tout les rendez-vous -->
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Mail</th>
                        <th>Tel</th>
                        <th>Contenu</th>
                        <th>Date</th>
                        <th>Commercial</th>
                        <!-- <th>Commerciaux</th> -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $statement = $db->query('SELECT r.IdRDV, IdUti, Nom, Prenom, Mail, Tel, Contenu, DteRDV FROM rdv r INNER JOIN prospects p ON r.IdProsp=p.IdProsp ORDER BY r.IdRDV DESC');
                        while($rdvd = $statement->fetch()) 
                        {
                            $statement2 = $db->query('SELECT IdRDV FROM rdv_commercial');
                            $rdv = $statement2->fetch();
                            $rdvid = $rdvd['IdRDV'];
                            echo '<tr>';
                            echo '<td>'. $rdvd['IdRDV'] . '</td>';
                            echo '<td>'. $rdvd['Nom'] . '</td>';
                            echo '<td>'. $rdvd['Prenom'] . '</td>';
                            echo '<td>'. $rdvd['Mail'] . '</td>';
                            echo '<td>'. $rdvd['Tel'] . '</td>';
                            echo '<td>'. $rdvd['Contenu'] . '</td>';
                            echo '<td>'. $rdvd['DteRDV'] . '</td>';
                            echo '<td style="text-align: center;">'. $rdvd['IdUti'] . '</td>';
                            echo '<td width=300>';
                            if($rdvd['IdUti'] == NULL){
                                echo '<a class="btn btn-warning" href="Rendez-Vous/assign.php?id='.$rdvd['IdRDV'].'"><span class="glyphicon glyphicon-ok"></span> Assigner Commercial</a><br><br>';
                            }
                            echo ' ';
                            echo '<a class="btn btn-primary" href="Rendez-Vous/update.php?id='.$rdvd['IdRDV'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="Rendez-Vous/delete.php?id='.$rdvd['IdRDV'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                            echo '</td>';
                        }
                        echo '</tr>';
                    ?>
                </tbody>
            </table>
        <?php
        Database::disconnect();
        ?>
    </body>
</html>