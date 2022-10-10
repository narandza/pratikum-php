<?php
include "../config/connection.php";
include "functions.php";
if(isset($_POST['update'])){
    $id = $_POST['form_id'];
    $name= $_POST['name'];
    $price= $_POST['price'];
    $desc= $_POST['desc'];
    $brand= $_POST['brand'];
    $gender= $_POST['gender'];
    $target="uploads/";
    $file_path =$target.basename($_FILES['image']['name']);
    $file_name = $_FILES['image']["name"];
    $file_tmp=$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_store="../uploads/".$file_name;
    createThumbnail($file_tmp,$file_type,$file_path);
    move_uploaded_file($file_tmp,$file_store);

    $result= $conn->prepare("UPDATE product set model = ? , price = ?, image= ?, description = ?, brand_id = ?, gender_id = ? WHERE id = ?");
    $result->execute([$name, $price, $file_path , $desc, $brand,$gender, $id]);

    if($result){
        header('location: ../index.php?page=admin-products-show');
    }
    else{
        header('location: ../index.php?page=admin-panel');
    }
}
?>