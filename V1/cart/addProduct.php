<?php
include("../objects/products.php");
$products_object = new Product($databaseHandler);

$title_IN = ( isset($_GET['name']) ? $_GET['name'] : '' );
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