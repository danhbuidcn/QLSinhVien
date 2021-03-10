<?php session_start(); 
        unset($_SESSION['name']);
        echo("<script>window.location.replace('../LoginRegister/Login.html');</script>");
?>