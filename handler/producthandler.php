<?php
if(isset($_POST['submit'])){
    include "../config/connection.php";
    include "functions.php";
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $brand = $_POST['brand'];
    $gender = $_POST['gender'];

    $target="uploads/";
    $file_path =$target.basename($_FILES['image']['name']);
    $file_name = $_FILES['image']["name"];
    $file_tmp=$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_store="../uploads/".$file_name;
    createThumbnail($file_tmp,$file_type,$file_path);
    move_uploaded_file($file_tmp,$file_store);
    $result= $conn->prepare("INSERT INTO product(model,price,image,description,brand_id,gender_id) VALUES(?, ? ,?, ? , ?,?)");
    $result->execute([$name, $price, $file_path , $desc, $brand, $gender]);

    if($result){
        header("location: ../index.php?page=admin-products-show");
    }
}
?>
