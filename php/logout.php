<!-- Déconnexion d'un compte membre-->
<?php  
        session_start();   
        if(isset($_SESSION['Pseudo']) and $_SESSION['Mdp'])
        {
                session_destroy();
                $_SESSION['Pseudo']=$Pseudo;
                $_SESSION['Mdp']=$Mdp;
        }  
        header('Location: ../Index.php');
         exit();                   
?>