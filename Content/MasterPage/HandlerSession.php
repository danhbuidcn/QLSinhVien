<?php 
    session_start(); 
    if (!isset($_SESSION['name']))
    {
        header("location:/StudentApplication/Content/LoginRegister/Login.html");
    }
?>