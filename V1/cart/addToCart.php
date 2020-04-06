<?php
include("../../objects/cart.php");
include("../../objects/users.php");
include("../../objects/products.php");

$cart_object = new Cart ($databaseHandler);
$user_handler = new User($databaseHandler);
// echo $cart_object->addProductToCart($_POST['tokenId'], $_POST['productId'], $_POST['productAmount']);


$productAmount_IN = ( isset($_GET['productAmount']) ? $_GET['productAmount'] : '' );
$productId_IN = ( isset($_GET['productId']) ? $_GET['productId'] : '' );
$tokenId_IN = ( isset($_GET['token']) ? $_GET['token'] : '' );
$userId_IN = ( isset($_GET['userId']) ? $_GET['userId'] : '');

 
if(!empty($productAmount_IN)) {
   if(!empty($productId_IN)) {
      if(!empty($tokenId_IN)) {

         $token = $_GET['token'];

         if($user_handler->validateToken($token) === false) {
             $retObject = new stdClass;
             $retObject->error = "Token is invalid";
             $retObject->errorCode = 1338;
             echo json_encode($retObject);
             die();
         }

       $cart_object->addProductToCart($productAmount_IN, $productId_IN, $userId_IN);
     
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