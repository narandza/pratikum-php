<?php
    session_start();
    if(empty($_SESSION['email']&& $_SESSION['password'])||$_SESSION['role']!=1){
        header('location: index.php?page=admin-login');
    }
    ?>