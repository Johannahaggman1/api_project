<?php
include("../../objects/cart.php");
include("../../objects/users.php");
include("../../objects/products.php");

$cart_object = new Cart ($databaseHandler);
$user_handler = new User($databaseHandler);
$product_object = new Products($databaseHandler);


$productAmount_IN = ( isset($_POST['productAmount']) ? $_POST['productAmount'] : '' );
$productId_IN = ( isset($_POST['productId']) ? $_POST['productId'] : '' );
$tokenId_IN = ( isset($_POST['token']) ? $_POST['token'] : '' );
$userId_IN = ( isset($_POST['userId']) ? $_POST['userId'] : '');

$productPrice = $product_object->getProductPrice($productId_IN);
$totalPrice_IN = $productAmount_IN * $productPrice['0'];

 
 if(!empty($productAmount_IN)) {
   if(!empty($productId_IN)) {
      if(!empty($tokenId_IN)) {

         $token = $_POST['token'];

         if($user_handler->validateToken($token) === false) {
             $retObject = new stdClass;
             $retObject->error = "Token is invalid";
             $retObject->errorCode = 1338;
             echo json_encode($retObject);
             die();
         }

       $cart_object->addProductToCart($productAmount_IN, $totalPrice_IN, $productId_IN, $userId_IN);
     
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