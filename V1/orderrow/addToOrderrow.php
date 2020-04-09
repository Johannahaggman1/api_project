<?php
include("../../objects/orderrows.php");
include("../../objects/users.php");
include("../../objects/products.php");

$orderrow_object = new Orderrow ($databaseHandler);
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

         
         $cartId_IN =  $orderrow_object->getCartId($userId_IN);
         
         $checkoutStatus = $orderrow_object->getCheckoutStatus($cartId_IN['Id']);
         
         $existingCartId = $orderrow_object->checkUserId($userId_IN);


         if ($orderrow_object->isProductIdTaken($productId_IN, $userId_IN) === true) {
            echo "Produkten du valt finns redan i din varukorg, ändra produkt mängd i 'uppdatera varukorg'!";
            die;
         } 

       if (($existingCartId[0] == $userId_IN) === true && $checkoutStatus['checkoutStatus'] == 0) {
        
           
            $cartId = $orderrow_object->getCartId($userId_IN);
            $cartId_IN = $cartId['0'];
            $orderrow_object->addProductToOrderrow($productAmount_IN, $totalPrice_IN, $productId_IN, $cartId_IN);
            die;

         }   else {
             $orderrow_object->createCart($userId_IN);
            $cartId = $orderrow_object->getCartId($userId_IN);
            $cartId_IN = $cartId['0'];
            $orderrow_object->addProductToOrderrow($productAmount_IN, $totalPrice_IN, $productId_IN, $cartId_IN);  
         }  
     
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