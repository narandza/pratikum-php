<?php
session_start();
    if(isset($_SESSION['cart'])){
        $checker=array_column($_SESSION['cart'], 'item_name');
        if(in_array($_GET['cart_name'], $checker)){
            echo "<script>alert('Proudct Is Already In The Cart');window.location.href='index.php?page=product'</script>";
        }
        else{
            $count=count($_SESSION['cart']);
            $_SESSION['cart'][$count]=array('item_id'=>$_GET['id'],'item_name'=>$_GET['cart_name'],'item_price'=>$_GET['price'],'quantity'=>1);
            echo "<script>alert('Product Added');window.location.href='index.php?page=product'</script>";
        }
    }
    else{
        $_SESSION['cart'][0]=array('item_id'=>$_GET['id'],'item_name'=>$_GET['cart_name'],'item_price'=>$_GET['price'],'quantity'=>1);

        echo "<script>alert('Product Added');window.location.href='index.php?page=product'</script>";
    }

?>