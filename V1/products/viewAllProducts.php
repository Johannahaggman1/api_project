<?php
include('../../objects/products.php');

$products_object = new Products($databaseHandler);

if(isset($_POST['order']) && $_POST['order'] == "desc") {
    echo "<pre>";
    print_r($products_object->fetchAllProductsDESC());
    echo "</pre>";
 }  else {
    echo "<pre>";
    print_r($products_object->fetchAllProducts());
    echo "</pre>";
 }


?>