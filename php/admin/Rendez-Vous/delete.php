<?php
    require '../database.php';
 
    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }
    $db = Database::connect();
    $req = $db->query("SELECT * FROM rdv WHERE IdRDV = ?");

    if(!empty($_POST)) {
        $errors = array();
        $id = checkInput($_POST['id']);
        $statement = $db->prepare("DELETE FROM rdv WHERE IdRDV = ?");
        $statement->execute(array($id));
        header("Location: ../index.php"); 
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
        <title>InfoTools - Delete</title>
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
                <?php 
                    if(!empty($_GET['id'])) 
                    {
                        $id = checkInput($_GET['id']);
                    }
                    $reqU = $db->query("SELECT * FROM rdv where IdRDV = $id");
                    while($donnees = $reqU->fetch()){
                        echo '<h1><strong>Supprimer le rendez-vous n° '.$donnees['IdRDV'].' ?</strong></h1>';
                    }
                ?>
                <br>
                <form class="form" action="delete.php" role="form" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning">Oui</button>
                      <a class="btn btn-default" href="../index.php">Non</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>

