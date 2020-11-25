<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>InfoTools</title>
</head>
<body>
    <form method="post">
        <div class="container">
            <div class="form-group">
                <label for="Nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" aria-describedby="nomHelp" placeholder="Nom">
            </div>
            <div class="form-group">
                <label for="Prenom">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" aria-describedby="prenomHelp" placeholder="Prénom">
            </div>
            <div class="form-group">
                <label for="Mail">Email :</label>
                <input type="email" class="form-control" id="mail" name="mail" aria-describedby="emailHelp" placeholder="Mail">
            </div>
            <div class="form-group">
                <label for="Tel">Téléphone :</label>
                <input type="tel" class="form-control" id="tel" name="tel" aria-describedby="telephoneHelp" placeholder="Téléphone">
            </div>
            <div class="form-group">
                <label for="Contenu">Contenu :</label>
                <textarea type="text" class="form-control" id="contenu" name="contenu" aria-describedby="contenuHelp" placeholder="Contenu"></textarea>
            </div>
            <div class="form-group">
                <label for="DateRDV">Date de RDV :</label>
                <input type="date" class="form-control" id="daterdv" name="daterdv" aria-describedby="daterdvHelp" placeholder="Date de RDV">
            </div>
            <div class="form-group">
                <label for="HeureRDV">Heure de RDV :</label>
                <input type="time" class="form-control" id="heurerdv" name="heurerdv" aria-describedby="heurerdvHelp" placeholder="Heure de RDV">
            </div>
            <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Prendre rendez-vous">
        </div>
    </form>
    <?php
        // Extraction du formulaire d'inscription avce la méthode $_POST
        if(isset($_POST['submit'])){
                    
            extract($_POST);
            //BDD
            include 'database.php';
            global $db;

            //Prépartion de la requête 
            $rdv = $db->prepare("INSERT INTO rdv(Nom, Prenom, Mail, Tel, Contenu, DteRDV, HeureRDV) VALUES('$nom', '$prenom', '$mail', '$tel', '$contenu', '$daterdv', '$heurerdv')");
            $rdv->execute([
            'Nom' => $nom,
            'Prenom' => $prenom,
            'Mail' => $mail,
            'Tel' => $tel,
            'Contenu' => $contenu,
            'DateRDV' => $daterdv,
            'HeureRDV' => $heurerdv
            ]);
            echo '<div class="">';
                echo '<h3 class="text-success">Votre rendez-vous a bien été prit en compte.</h3>';
            echo '</div>';
        }
    ?>
</body>
</html>