<?php
if(isset($_POST['submit'])){
    include "../config/connection.php";
$brand=$_POST['name'];


$result= $conn->prepare("INSERT INTO brand(brand) VALUES(?)");
$result->execute([$brand]);
if($result){
    header("location: ../index.php?page=admin-brand");
}
}
?>