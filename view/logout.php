<?php 

    setcookie("username","");
    setcookie("password","");    

    setcookie('flag', 'true', time()-10, '/');
    header("location: userLogin.php");

?>