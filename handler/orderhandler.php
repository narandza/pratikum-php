<?php
session_start();
include "../config/connection.php";
    if(isset($_POST['submit'])){
        $total=$_POST['total'];
        $phone=$_POST['phone'];
        $adress=$_POST['adress'];
        $customer_id = $_SESSION['customer_id'];
        $result= $conn->prepare("INSERT INTO orders(customer_id, address, phone, total) VALUES(?, ? , ?, ?)");
        $result->execute([$customer_id, $adress, $phone, $total]);
        if($result){
            $query = ("SELECT id FROM orders ORDER BY id DESC limit 1");
            $order = executeQuery($query);
            $order_id= $order[0]->id;
            foreach ($_SESSION['cart'] as $key=>$value){
                $product_id=$value['item_id'];
                $quantity=$value['quantity'];
                $order_details=$conn->prepare("INSERT INTO order_details(order_id,product_id,quantity) VALUES (?, ?, ?)");
                $order_details->execute([$order_id, $product_id, $quantity]);
                if($result){
                    echo "<script>alert('Order Is Placed');window.location.href='../index.php'</script>";
                    unset($_SESSION['cart']);
                }
            }
        }
    }

?>