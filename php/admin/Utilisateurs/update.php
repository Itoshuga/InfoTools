<?php

    require '../database.php';

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

   $nameError = $prenomError = $mailError = $telError = $adresseError = $cpError = $villeError = $pseudoError = $role = $name = $prenom = $mail = $tel = $adresse = $cp = $ville = $pseudo = "";

    if(!empty($_POST)) 
    {
        //Création des variables d'un produit
        // $role               = checkInput($_POST['role']);
        $name               = checkInput($_POST['name']);
        $prenom             = checkInput($_POST['prenom']);
        $mail               = checkInput($_POST['mail']);
        $tel                = checkInput($_POST['tel']); 
        $adresse            = checkInput($_POST['adresse']); 
        $cp                 = checkInput($_POST['cp']); 
        $ville              = checkInput($_POST['ville']);
        $pseudo             = checkInput($_POST['pseudo']);
        $isSuccess          = true;
       
        //  if(empty($role)) //Si la variable role est vide alors:
        // {
        //     $roleError = 'Ce champ ne peut pas être vide';//Message d'erreur
        //     $isSuccess = false;
        // }
        if(empty($name)) //Si la variable nomP est vide alors:
        {
            $nameError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($prenom)) //Si la variable prenom est vide alors:
        {
            $prenomError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($mail)) //Si la variable mail est vide alors:
        {
            $mailError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($tel)) //Si la variable tel est vide alors:
        {
            $telError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($adresse)) //Si la variable adresse est vide alors:
        {
            $adresseError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($cp)) //Si la variable cp est vide alors:
        {
            $cpError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($ville)) //Si la variable ville est vide alors:
        {
            $villeError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($pseudo)) //Si la variable pseudo est vide alors:
        {
            $pseudoError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
       
         
        if (($isSuccess) || ($isSuccess)) 
        { 
            $db = Database::connect();
            if($isSuccess)
            {
                $statement = $db->prepare("UPDATE utilisateur  set Nom = ?, Prenom = ?, Mail = ?, Tel = ?, Adresse = ?, CP = ?, Ville = ?, Pseudo = ? WHERE IdUti = ?");
                $statement->execute(array($name,$prenom,$mail,$tel,$adresse,$cp,$ville,$pseudo,$id));
            }
            Database::disconnect();
            header("Location: ../index.php");
        }
           
    }
    else 
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM utilisateur where IdUti = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $name           = $item['Nom'];
        $prenom    = $item['Prenom'];
        $mail          = $item['Mail'];
        $tel          = $item['Tel'];
        $adresse       = $item['Adresse'];
        $cp       = $item['CP'];
        $ville       = $item['Ville'];
        $pseudo       = $item['Pseudo'];

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
                    <h1><strong>Modifier un Utilisateur</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'update.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom :</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name;?>">
                            <span class="help-inline"><?php echo $nameError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" value="<?php echo $prenom;?>">
                            <span class="help-inline"><?php echo $prenomError;?></span>
                        </div>
                        <div class="form-group">
                        <label for="mail">Mail :</label>
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="mail" value="<?php echo $mail;?>">
                            <span class="help-inline"><?php echo $mailError;?></span>
                        </div>


                        <div class="form-group">
                        <label for="tel">Téléphone :</label>
                            <input type="tel" class="form-control" id="tel" name="tel" placeholder="Téléphone" value="<?php echo $tel;?>">
                            <span class="help-inline"><?php echo $telError;?></span>
                        </div>

                        <div class="form-group">
                        <label for="adresse">Adresse :</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="<?php echo $adresse;?>">
                            <span class="help-inline"><?php echo $adresseError;?></span>
                        </div>
                        
                        <div class="form-group">
                        <label for="ville">Ville :</label>
                            <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" value="<?php echo $ville;?>">
                            <span class="help-inline"><?php echo $villeError;?></span>
                        </div>
                        <div class="form-group">
                        <label for="cp">CP :</label>
                            <input type="text" class="form-control" id="cp" name="cp" placeholder="cp" value="<?php echo $cp;?>">
                            <span class="help-inline"><?php echo $cpError;?></span>
                        </div>
                        <div class="form-group">
                        <label for="pseudo">Pseudo :</label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" value="<?php echo $pseudo;?>">
                            <span class="help-inline"><?php echo $pseudoError;?></span>
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            <a class="btn btn-primary" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                </div>
            </div>
        </div>   
    </body>
</html>
