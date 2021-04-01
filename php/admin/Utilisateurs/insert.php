<?php
    //Connexion à la BBD
    require '../database.php';
 
    $roleError = $nameError = $prenomError = $mdpError = $mailError = $telError = $adresseError = $cpError = $villeError = $pseudoError = $role = $name = $prenom = $mdp = $mail = $tel = $adresse = $cp = $ville = $pseudo = "";
    //Si le formulaire n'est pas vide alors:
    if(!empty($_POST)) 
    {
        //Création des variables d'un produit
        $role               = checkInput($_POST['role']);
        $name               = checkInput($_POST['name']);
        $prenom             = checkInput($_POST['prenom']);
        $options = ['cost' => 12,];
        $mdp                = password_hash($_POST['mdp'], PASSWORD_BCRYPT, $options);
        $mail               = checkInput($_POST['mail']);
        $tel                = checkInput($_POST['tel']); 
        $adresse            = checkInput($_POST['adresse']); 
        $cp                 = checkInput($_POST['cp']); 
        $ville              = checkInput($_POST['ville']);
        $pseudo             = checkInput($_POST['pseudo']);
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        if(empty($role)) //Si la variable role est vide alors:
        {
            $roleError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
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
        if(empty($mdp)) //Si la variable prenom est vide alors:
        {
            $mdpError = 'Ce champ ne peut pas être vide';//Message d'erreur
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
        else //Sinon
        {
            $isUploadSuccess = true;
        }
        
        if($isSuccess && $isUploadSuccess) //Si $isSuccess && $isUploadSuccess sont true alors on Insert les données dans la table utilisateur 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO utilisateur (NumRole,Nom,Prenom,Mdp,Mail,Tel,Adresse,CP,Ville,Pseudo) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(array($role,$name,$prenom,$mdp,$mail,$tel,$adresse,$cp,$ville,$pseudo));
            Database::disconnect();
            header("Location: ../index.php");
        }
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
                <h1><strong>Ajouter un utilisateur</strong></h1>
                <br>
                <!-- Formulaire pour insérer un prosuit -->
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select class="form-control" id="role" name="role">
                        <?php
                           $db = Database::connect();
                           $statement = $db->query('SELECT * FROM role'); //Sélectionne tous les commerciaux
                            while($Select = $statement->fetch()) 
                            {
                                echo '<option selected="selected" value="'.$Select['NumRole'].'">'.$Select['LibRole'].'</option>';
                            }
                           Database::disconnect();
                        ?>
                        </select>
                        <span class="help-inline"><?php echo $roleError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name;?>">
                        <span class="help-inline"><?php echo $nameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" value="<?php echo $prenom;?>">
                        <span class="help-inline"><?php echo $prenomError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="mdp">Mdp:</label>
                        <input type="text" class="form-control" id="mdp" name="mdp" minlength="8" placeholder="Mot de passe" value="<?php echo $mdp;?>">
                        <span class="help-inline"><?php echo $mdpError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="mail">Mail:</label>
                        <input type="text" class="form-control" id="mail" name="mail" placeholder="Mail" value="<?php echo $mail;?>">
                        <span class="help-inline"><?php echo $mailError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="tel">Tel:</label>
                        <input type="number" class="form-control" id="tel" name="tel" placeholder="Tel" value="<?php echo $tel;?>">
                        <span class="help-inline"><?php echo $telError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse:</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="<?php echo $adresse;?>">
                        <span class="help-inline"><?php echo $adresseError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="cp">CP:</label>
                        <input type="number" class="form-control" id="cp" name="cp" placeholder="CP" value="<?php echo $cp;?>">
                        <span class="help-inline"><?php echo $cpError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville:</label>
                        <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" value="<?php echo $ville;?>">
                        <span class="help-inline"><?php echo $villeError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="pseudo">Pseudo:</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" value="<?php echo $pseudo;?>">
                        <span class="help-inline"><?php echo $pseudoError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>