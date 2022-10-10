<?php
    session_start();
    include("../config/connection.php");

    if(isset($_POST['submit'])){
        $email=$_POST['email'];
        $password=$_POST['password'];

        $query="SELECT * FROM users WHERE username= '$email' AND password = '$password'";
        $result= executeQuery($query);
        $user= $result[0];
        $_SESSION['email']= $user->username;
        $_SESSION['password']= $user->password;
        $_SESSION['customer_id']=$user->id;
        $_SESSION['role']=$user->role_id;
        if($email==$user->username&& $password==$user->password){
            header("location: ../index.php");
        }
        else{
            echo "<script>alert('Credentials are wrong');window.location.href='../index.php?page=customer-forms';</script>";
        }
    }
?>