<?php
    require '../database.php'; //Inclue la database

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']); //Récupère l'id par l'url
    }
    
    $db = Database::connect(); //Se connecte à la base de donnée
    $statement = $db->prepare("SELECT IdRDV, Nom, Prenom, Mail, Tel, Contenu, DteRDV FROM rdv WHERE IdRDV = ?"); //Sélectionne les rendez-vous dont l'id est dans l'url
    $statement->execute(array($_GET['id'])); //Execute la requete
    $rdv = $statement->fetch();
    Database::disconnect(); //Se déconnecte de la base de donnée

    function checkInput($data) //Fonction permettant d'assurer la sécurité du formulaire
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../../../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../../../img/logo/algorithm.svg" />
        <script src="js/diashow.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <title>InfoTools - Landing Page</title>
    </head>
    
    <body>
        <header> 
            <!-- Logo + Text -->
            <div class="logo-container">
                <img src="../../../img/logo/algorithm.svg" alt="logo" />
                <h4 class="logo"><span class="color-info">Info</span>-<b>Tools</b></h4>
            </div>
            
        </header>
         <div class="container admin">
            <div class="row">
               <div class="col-sm-6">
                    <h1><strong>Assigner un rendez-vous</strong></h1>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>ID:</label><?php echo '  '.$rdv['IdRDV'];?>
                      </div>
                      <div class="form-group">
                        <label>Nom:</label><?php echo '  '.$rdv['Nom'];?>
                      </div>
                      <div class="form-group">
                        <label>Prenom:</label><?php echo '  '.$rdv['Prenom'];?>
                      </div>
                      <div class="form-group">
                        <label>Mail:</label><?php echo '  '.$rdv['Mail'];?>
                      </div>
                      <div class="form-group">
                        <label>Tel:</label><?php echo '  '.$rdv['Tel'];?>
                      </div>
                      <div class="form-group">
                        <label>Contenu:</label><?php echo '  '.$rdv['Contenu'];?>
                      </div>
                      <div class="form-group">
                        <label>DteRDV:</label><?php echo '  '.$rdv['DteRDV'];?>
                      </div>
                    </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div> 
                </div> 
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <form class="form" action="assign.php?id=<?php echo $id;?>" method="post"> <!--Création d'un formulaire-->
                        <div class="form-group">
                            <label for="commercial">Commercial :</label>
                            <select class="form-control" id="commercial" name="commercial">
                                <?php
                                    $db = Database::connect();
                                    $statement = $db->query('SELECT * FROM utilisateur WHERE NumRole = 1 ORDER BY Nom ASC'); //Sélectionne tous les commerciaux
                                    while($Select = $statement->fetch()) //Tant qu'il y a des données dans le tableau
                                    {
                                        echo '<option selected="selected" value="'.$Select['IdUti'].'">'.$Select['Nom'].' '.$Select['Prenom'].'</option>'; //Création d'un combobox permettant de sélectionner le rôle
                                    }
                                    if (isset($_POST['commercial'])){ //Si le combobox n'est pas vide
                                        $choix = $_POST['commercial']; //création d'une variable permettant d'obtenir l'IdUti
                                        $Com = $db->query('SELECT * FROM utilisateur WHERE NumRole = 1 ORDER BY Nom ASC'); //Sélectionne toutes les données des commerciaux de la table utilisateur ordonné par le Nom en croissant
                                        while($donnees = $Com->fetch()) //Tant qu'il y a des données dans le tableau
                                        {
                                            $statement = $db->prepare("INSERT INTO rdv_commercial(IdRDV,IdUti) VALUES('$id','$choix')"); //Prepare la requete qui insère dans la table commercial l'IdRDV et l'IdUti
                                            $statement->execute([ //Execute la requete
                                                'IdRDV' => $id,
                                                'IdUti' => $choix
                                            ]);
                                            $update = $db->prepare("UPDATE rdv SET IdUti = $choix WHERE IdRDV = $id"); 
                                            $update->execute([ //Execute la requete
                                              'IdUti' => $choix
                                          ]);
                                        }
                                        header("Location: ../index.php"); //Renvoie vers l'index lors de l'execution de la requete
                                    }
                                    
                                    Database::disconnect();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-info" href="../../index.php"><span class="glyphicon glyphicon-ok"></span> Assigner</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>   
    </body>
</html>