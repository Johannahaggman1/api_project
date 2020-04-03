<?php
include("../objects/products.php");
include("../objects/users.php"); 

$products_object = new Products($databaseHandler);
$user_handler = new User($databaseHandler);
//ANDERS KOD
//$posts_object = new Posts($databaseHandler);



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


// SLUT 




$title_IN = ( isset($_POST['productName']) ? $_POST['productName'] : '' );
// $content_IN = ( isset($_GET['content']) ? $_GET['content'] : '' );


 if(!empty($title_IN)) {
  // if(!empty($content_IN)) {
 // tog bort  $products_object->addproduct($title_IN, >>>>$content_IN<<<<<<); ur raden nedan
       $products_object->addProduct($title_IN);

   // } else {
   /*     echo "Error: content cannot be empty!";
    }  */
 } else {
    echo "Error: titel cannot be empty!";
 }



?>