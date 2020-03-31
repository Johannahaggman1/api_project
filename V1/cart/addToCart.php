<?php
include("../objects/cart.php");
include("../objects/users.php");
include("../objects/products.php");

$cart_object = new Cart ($databaseHandler);

// echo $cart_object->addProductToCart($_POST['tokenId'], $_POST['productId'], $_POST['productAmount']);


$productAmount_IN = ( isset($_GET['productAmount']) ? $_GET['productAmount'] : '' );
$productId_IN = ( isset($_GET['productId']) ? $_GET['productId'] : '' );
$tokenId_IN = ( isset($_GET['tokenId']) ? $_GET['tokenId'] : '' );


 
if(!empty($productAmount_IN)) {
   if(!empty($productId_IN)) {
      if(!empty($tokenId_IN)) {

       $cart_object->addProductToCart($productAmount_IN, $productId_IN, $tokenId_IN);
     
      } else {
         echo "Error: TokenId cannot be empty!";
      }
   } else {
       echo "Error: productId cannot be empty!";
   }
} else {
   echo "Error: productamount cannot be empty!";
}



?>