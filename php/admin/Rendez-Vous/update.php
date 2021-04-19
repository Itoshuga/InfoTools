<?php

    require '../database.php';

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

   $idutiError = $iduti = "";

    if(!empty($_POST)) 
    {
        //Création des variables d'un produit
        $iduti              = checkInput($_POST['iduti']);
        $isSuccess          = true;
       
        if(empty($iduti)) //Si la variable role est vide alors:
        {
            $idutiError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }

        if (($isSuccess) || ($isSuccess)) 
        {
            $db = Database::connect();
            if($isSuccess)
            {
                $statement = $db->prepare("UPDATE rdv set IdUti = ? WHERE IdRDV = ?");
                $statement->execute(array($iduti,$id));
            }
            Database::disconnect();
            header("Location: ../index.php");
        }
           
    }
    else 
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM rdv where IdRDV = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $iduti = $item['IdUti'];
        Database::disconnect();
    }

    function checkInput($data) 
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
        <title>InfoTools - Update</title>
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
                    <h1><strong>Modifier un rendez-vous</strong></h1>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div> 
                </div> 
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <form class="form" action="<?php echo 'update.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data"> <!--Création d'un formulaire-->
                        <div class="form-group">
                            <label for="iduti">Commerciaux:</label>
                            <select class="form-control" id="iduti" name="iduti">
                                <?php
                                    $db = Database::connect();
                                    foreach ($db->query('SELECT * FROM utilisateur WHERE NumRole = 1') as $row) 
                                    {
                                        if($row['id'] == $iduti)
                                            echo '<option selected="selected" value="'. $row['IdUti'] .'">'. $row['Nom'] .' '. $row['Prenom'] .'</option>';
                                        else
                                            echo '<option value="'. $row['IdUti'] .'">'. $row['Nom'] .' '. $row['Prenom'] .'</option>';
                                    }
                                    header("Location: ../index.php"); //Renvoie vers l'index lors de l'execution de la requete
                                    Database::disconnect();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" href="../index.php"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>   
    </body>
</html>