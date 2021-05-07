<!-- Déconnexion d'un compte membre-->
<?php  
        session_start();   
        if(isset($_SESSION['Mail']) and $_SESSION['Mdp'])
        {
                session_destroy();
                $_SESSION['Mail']=$Mail;
                $_SESSION['Mdp']=$Mdp;
        }  
        header('Location: ../Index.php');
         exit();                   
?>