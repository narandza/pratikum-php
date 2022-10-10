<?php
include "../config/connection.php";
$email=$_POST['email'];
$msg = $_POST['msg'];

$result= $conn->prepare("INSERT INTO contact(email,message) VALUES(? , ?)");
$result->execute([$email, $msg]);
if($result){
    header("location: ../index.php");
}
?>