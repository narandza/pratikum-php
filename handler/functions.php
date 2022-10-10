<?php
    function createThumbnail($img,$type,$path){
        list($width, $height) = getimagesize($img);
        $new_width=150;
        $height_percentage=$width/$new_width;
        $new_height=$height/$height_percentage;

        if($type=="image/jpeg"){
            $image=imagecreatefromjpeg($img);
        }
        elseif($type=="image/png"){
            $image=imagecreatefrompng($img);
        }
        $canvas=imagecreatetruecolor($new_width,$new_height);
        imagecopyresampled($canvas,$image,0,0,0,0,$new_width,$new_height,$width,$height);
        $new_image=$canvas;
        if($type=="image/jpeg"){
            imagejpeg($new_image,"../images/thumbnails/".$path);
        }
        elseif($type=="image/png")
        {
            imagepng($new_image,"../images/thumbnails/".$path);
        }
    }
    function fetchBrands(){
        $query = "SELECT * FROM brand";
        $result= executeQuery($query);
        return $result;
    }
    function fetchGender(){
        $query1 = ("SELECT * FROM gender") ;
        $result  = executeQuery($query1);
        return $result;
    }
    function fetchOrderDetailsById($id){
        $query=("SELECT * FROM order_details od JOIN product p ON od.product_id = p.id WHERE od.order_id=$id");
        $result=executeQuery($query);
        return $result;
    }
    function fetchProductsGenderBrand(){
        $query=("SELECT * FROM product p JOIN gender g ON p.gender_id = g.id_gender JOIN brand b ON p.brand_id = b.id_brand ");
        $result=executeQuery($query);
        return $result;
    }
    function fetchCustomersOrders(){
        $query=("SELECT * FROM orders o JOIN users u ON o.customer_id = u.id JOIN order_details od ON o.id = od.order_id");
        $result=executeQuery($query);
        return $result;
    }
    function fetchProductsLimit($a ,$b){
        $query = "SELECT * FROM product p JOIN brand b ON p.brand_id=b.id_brand LIMIT $a,$b";
        $result=executeQuery($query);
        return $result;
    }
    function fetchProuctsByBrand($brand_id){
        $query=("SELECT * FROM product p JOIN brand b ON p.brand_id=b.id_brand where p.brand_id=$brand_id");
        $result=executeQuery($query);
        return $result;
    }
    function fetchProuctsByPrice($price){
        if($price=="asc"){
            $query=("SELECT * FROM product p JOIN brand b ON p.brand_id=b.id_brand ORDER BY price ");
        }
        elseif($price=="desc"){
            $query=("SELECT * FROM product p JOIN brand b ON p.brand_id=b.id_brand ORDER BY price DESC ");
        }
        $result=executeQuery($query);
        return $result;
    }
    function fetchProductById($id){
        $query="select * from product where id = $id";
		$result=executeQuery($query);
        $product= $result[0];
        return $product;
    }
    function fetchProductGenderBrandById($id){
        $query= "SELECT * FROM product p JOIN brand b ON p.brand_id = b.id_brand JOIN gender g ON p.gender_id = g.id_gender WHERE id=$id";
		$result=executeQuery($query);
        $product=$result[0];
        return $product;
    }
    function fetchProuctsByGender($gender){
        $query=("SELECT * FROM product p JOIN brand b ON p.brand_id=b.id_brand where p.gender_id=$gender");
        $result=executeQuery($query);
        return $result;
    }
    function displayProducts($noProducts){
        if(isset($_GET['pg'])){
            $page=$_GET['pg'];
            if($page==0||$page<1){
                $showProduct = 0;
            }
            $showProduct = ($page*$noProducts)-$noProducts;
            $product = fetchProductsLimit($showProduct,$noProducts);
        }
        elseif(isset($_GET['brand'])){
            $brand_id=$_GET['brand'];
            $product=fetchProuctsByBrand($brand_id);
        }
        elseif(isset($_GET['price'])){
            $price = $_GET['price'];
            $product =fetchProuctsByPrice($price);
        }
        elseif(isset($_GET['gender'])){
            $gender = $_GET['gender'];
            $product =fetchProuctsByGender($gender);
        }
        else{
            $product=fetchProductsLimit(0,$noProducts);
        }
        return $product;
    }
    function countProducts(){
        $query="SELECT COUNT(*) AS total FROM product ";
        $result=executeQuery($query);
        return $result[0]->total;
    }
?>