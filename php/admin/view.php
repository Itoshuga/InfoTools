<?php
    require 'database.php';

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }
     
    $db = Database::connect();
    $statement = $db->prepare("SELECT IdProd, NumCat, NomProd, DescProd, PrixProd, Imgsrc FROM produit WHERE IdProd = ?");
    $statement->execute(array($id));
    $produit = $statement->fetch();
    Database::disconnect();

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
               <div class="col-sm-6">
                    <h1><strong>Voir un produit</strong></h1>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>Nom:</label><?php echo '  '.$produit['NomProd'];?>
                      </div>
                      <div class="form-group">
                        <label>Description:</label><?php echo '  '.$produit['DescProd'];?>
                      </div>
                      <div class="form-group">
                        <label>Prix:</label><?php echo '  '.number_format((float)$produit['PrixProd'], 2, '.', ''). ' €';?>
                      </div>
                      <div class="form-group">
                        <label>Catégorie:</label><?php echo '  '.$produit['NumCat'];?>
                      </div>
                      <div class="form-group">
                        <label>Image:</label><?php echo '  '.$produit['Imgsrc'];?>
                      </div>
                    </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </div> 
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <img src="<?php echo '../../img/product/'.$produit['Imgsrc'];?>" alt="...">
                        <div class="price"><?php echo number_format((float)$produit['PrixProd'], 2, '.', ''). ' €';?></div>
                          <div class="caption">
                            <h4><?php echo $produit['NomProd'];?></h4>
                            <p><?php echo $produit['DescProd'];?></p>
                          </div>
                    </div>
                </div>
            </div>
        </div>   
    </body>
</html>

