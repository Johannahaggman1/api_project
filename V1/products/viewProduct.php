<?php
include("../objects/products.php");

$products_object = new Products($databaseHandler);

//Ändrade här till stort I 

//Kan det va så att det inte funkar för att vi inte har med nån "user_id" som han har i sin fetchSingelPost() funktion? 

$productID = ( !empty($_GET['Id'] ) ? $_GET['Id'] : -1 );


if($productID > -1) {

    $products_object->setProductId($productID);
    print_r( $products_object->fetchSingleProduct() );


} else {

    echo "Error: Missing parameter id!";

}

?>
