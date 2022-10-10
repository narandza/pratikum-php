<?php
    session_start();
    if(isset($_POST['login'])){
        include "../config/connection.php";
        $email=$_POST['email'];
        $password = $_POST['password'];
        $query="SELECT * from users Where username='$email' AND password= '$password'";
        $result=executeQuery($query);
        
        $_SESSION['email']=$result[0]->username;
        $_SESSION['password']=$result[0]->password;
        $_SESSION['role']=$result[0]->role_id;
        $_SESSION['customer_id']=$result[0]->id;

        if($email==$result[0]->username&& $password==$result[0]->password && $result[0]->role_id==1){
          header("location: ../index.php?page=admin-panel");
        }
        else{
            header("location: ../index.php?page=admin-login");
        }
    }

?>