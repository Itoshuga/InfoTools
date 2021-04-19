<?php
    session_start();

    require '../database.php';
    global $db;

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }
    $req = $db->query("SELECT * FROM rdv_commercial WHERE IdRDV = $id");

    if(!empty($_POST)) {
        $errors = array();
        $id = checkInput($_POST['id']);
        $statement = $db->prepare("DELETE FROM rdv_commercial WHERE IdRDV = ?");
        $statement->execute(array($id));
        header('Location: rdv-commercial.php?id='.$_SESSION['IdUti'].''); 
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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../img/logo/algorithm.svg" />
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
                <?php 
                    if(!empty($_GET['id'])) 
                    {
                        $id = checkInput($_GET['id']);
                    }
                    $reqU = $db->query("SELECT * FROM rdv_commercial where IdRDV = $id");
                    while($donnees = $reqU->fetch()){
                        echo '<h1><strong>Supprimer le rendez-vous ?</strong></h1>';
                    }
                ?>
                <br>
                <form class="form" action="delete.php?id=<?php echo $id;?>" role="form" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning">Oui</button>
                      <a class="btn btn-default" href="rdv-commercial.php?id=<?php echo $_SESSION['IdUti'];?>">Non</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>

