<?php
     //Coonexion à la BBD
    require 'database.php';
 
    $nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";
    //Si le formulaire n'est pas vide alors:
    if(!empty($_POST)) 
    {
        //Création des variables d'un produit
        $name               = ($_POST['name']);
        $description        = ($_POST['description']);
        $price              = ($_POST['price']);
        $category           = ($_POST['category']); 
        $image              = ($_FILES["image"]["name"]);
        $imagePath          = '../../img/product/'. basename($image);
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        if(empty($name)) //Si la variable nom est vide alors:
        {
            $nameError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($description)) //Si la variable description est vide alors:
        {
            $descriptionError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($price)) //Si la variable prix est vide alors:
        {
            $priceError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        } 
        if(empty($category)) //Si la variable catégorie est vide alors:
        {
            $categoryError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        if(empty($image)) //Si la variable image est vide alors:
        {
            $imageError = 'Ce champ ne peut pas être vide';//Message d'erreur
            $isSuccess = false;
        }
        else //Sinon
        {
            $isUploadSuccess = true;
            if($imageExtension != "png") //Format de l'image uniquement en png
            {
                $imageError = "Les fichiers autorises sont: .png";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)) 
            {
                $imageError = "Le fichier existe deja";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000) 
            {
                $imageError = "Le fichier ne doit pas depasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) 
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                } 
            } 
        }
        
        if($isSuccess && $isUploadSuccess) //Si $isSuccess && $isUploadSuccess sont true alors on Insert les données dans la table produit 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO produit (NumCat,NomProd,DescProd,PrixProd,Imgsrc) values(?, ?, ?, ?, ?)");
            $statement->execute(array($category,$name,$description,$price,$image));
            Database::disconnect();
            header("Location: index.php");
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
        <header> 
            <!-- Logo + Text -->
            <div class="logo-container">
                <img src="../../img/logo/algorithm.svg" alt="logo" />
                <h4 class="logo"><span class="color-info">Info</span>-<b>Tools</b></h4>
            </div>
            
        </header>
         <div class="container admin">
            <div class="row">
                <h1><strong>Ajouter un produit</strong></h1>
                <br>
                <!-- Formulaire pour insérer un prosuit -->
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name;?>">
                        <span class="help-inline"><?php echo $nameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description;?>">
                        <span class="help-inline"><?php echo $descriptionError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="price">Prix: (en €)</label>
                        <input type="number" step="1.00" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price;?>">
                        <span class="help-inline"><?php echo $priceError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie:</label>
                        <select class="form-control" id="category" name="category">
                        <?php
                           $db = Database::connect();
                           foreach ($db->query('SELECT * FROM categorie') as $row) 
                           {
                                echo '<option value="'. $row['NumCat'] .'">'. $row['LibCat'] . '</option>';;
                           }
                           Database::disconnect();
                        ?>
                        </select>
                        <span class="help-inline"><?php echo $categoryError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="image">Sélectionner une image:</label>
                        <input type="file" id="image" name="image"> 
                        <span class="help-inline"><?php echo $imageError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>