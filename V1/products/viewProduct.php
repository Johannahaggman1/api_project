<?php
include("../../objects/products.php");

$products_object = new Products($databaseHandler);

$productID = ( !empty($_POST['Id'] ) ? $_POST['Id'] : -1 );


if($productID > -1) {
    
    $products_object->setProductId($productID);
    print_r( $products_object->fetchSingleProduct() );

} else {
    echo "Error: Missing parameter id!";
}

?>
