<?php
include("../objects/products.php");

$posts_object = new Posts($databaseHandler);

//Ändrade här till stort I 

//Kan det va så att det inte funkar för att vi inte har med nån "user_id" som han har i sin fetchSingelPost() funktion? 

$postID = ( !empty($_GET['id'] ) ? $_GET['id'] : -1 );


if($postID > -1) {

    $posts_object->setPostId($postID);
    print_r( $posts_object->fetchSinglePost() );


} else {

    echo "Error: Missing parameter id!";

}

?>
