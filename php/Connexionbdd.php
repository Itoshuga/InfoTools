<!-- Connexion à la base de données localhost-->
<?php
$host = "localhost"; 
$user = "root";    //   root par exemple 
$passwd  = "root"; 
$bdd =  "infotools";  
$mysqli = mysqli_init(); 
if (!$mysqli) 
{     
    die('mysqli_init ne fonctionne pas'); 
} 
if (!$mysqli->real_connect($host, $user, $passwd, $bdd)) 
{     
     die('Connect Error (' . mysqli_connect_errno() . ')'. mysqli_connect_error()); 
} 
?>