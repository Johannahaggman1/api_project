<?php
include('../objects/products.php');
include('../objects/users.php');

$products_object = new Products($databaseHandler);
$user_handler = new User($databaseHandler);

$token = $_POST['token'];
//Försök att sortera

 if($user_handler->validateToken($token) === false) {
    echo "Invalid token!";
    die;
} 

if(isset($_POST['desc'])) {
    echo "<pre>";
    print_r($products_object->fetchAllProductsDESC());
    echo "</pre>";
 }  else {
    echo "<pre>";
    print_r($products_object->fetchAllProducts());
    echo "</pre>";
 }



/* echo "<pre>";
print_r($products_object->fetchAllProducts());
echo "</pre>";
 */


?>