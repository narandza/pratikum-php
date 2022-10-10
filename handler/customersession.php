<?php
    if(empty($_SESSION['email']&& $_SESSION['password'])){
        echo "<script>alert('You must be logged in to countinue');
        window.location.href='index.php?page=customer-forms';</script>";
    }
?>