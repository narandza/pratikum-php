<?php
include "config/connection.php";
$id=$_GET['id'];

$result= $conn->prepare("DELETE FROM product WHERE id =?");
$result->execute([$id]);
if($result){
    header("location: index.php?page=admin-products-show");
}
else{
    echo "An error has accured";
}
?>