
<?php
session_start();
//*Logout page*//
if(isset($_POST['logout_btn']))
{
    session_destroy();
    unset($_SESSION['username']);
    header('Location:login.php');
    
}
?>