<?php
include("../objects/products.php");
$posts_object = new Posts($databaseHandler);

$title_IN = ( isset($_GET['name']) ? $_GET['name'] : '' );
// $content_IN = ( isset($_GET['content']) ? $_GET['content'] : '' );


 if(!empty($title_IN)) {
  // if(!empty($content_IN)) {
 // tog bort  $posts_object->addPost($title_IN, >>>>$content_IN<<<<<<); ur raden nedan
       $posts_object->addPost($title_IN);

   // } else {
   /*     echo "Error: content cannot be empty!";
    }  */
 } else {
    echo "Error: titel cannot be empty!";
 }



?>