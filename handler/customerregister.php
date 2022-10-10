<?php
    include("../config/connection.php");

    if(isset($_POST['submit'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $password2 = $_POST['password2'];
        
        if($password==$password2){
            $result= $conn->prepare("INSERT INTO users(username,password,role_id) VALUES(?,?,2)");
            $result->execute([$email,$password]);
            echo "<script>alert('Reggistration Succesfull!');window.location.href='../index.php?page=customer-forms';</script>";
            
        }
        else{
            echo "<script>alert('Passwords do not match');window.location.href='../index.php?page=customer-forms';</script>";
        }
    }

?>