<?php
session_start();
$connection = mysqli_connect("localhost", "root" , "", "adminpanel");

if(!$_SESSION['username'])
{
    header('Location: login.php');
    
}
?>