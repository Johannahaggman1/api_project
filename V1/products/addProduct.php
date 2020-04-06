<?php
include("../../objects/products.php");
include("../../objects/users.php"); 

$products_object = new Products($databaseHandler);
$user_handler = new User($databaseHandler);

$token = $_POST['token'];

if($user_handler->validateToken($token) === false) {
    echo "Invalid token!";
    die;
}

$isAdmin = $user_handler->isAdmin($token);

if($isAdmin === false) {
    echo "You are not admin";
    die;
}


$productName_IN = ( isset($_POST['productName']) ? $_POST['productName'] : '' );
$price_IN = ( isset($_POST['price']) ? $_POST['price'] : '' );
$stockamount_IN = ( isset($_POST['stockAmount']) ? $_POST['stockAmount'] : '' );


 if(!empty($productName_IN)) {
   if(!empty($price_IN)) {
      if (!empty($stockamount_IN )){

         $products_object->addProduct($productName_IN, $price_IN, $stockamount_IN);
      } else {
         echo "Error: Stockamount cannot be empty!";
      }  

   } else {
       echo "Error: content cannot be empty!";
    }  
 } else {
    echo "Error: titel cannot be empty!";
 }



?>