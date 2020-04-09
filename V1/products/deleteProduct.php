<?php
 include('../../objects/products.php');
include('../../objects/users.php');

$product_handler = new Products($databaseHandler);
$user_handler = new User($databaseHandler);

$productId_IN = ( isset($_POST['Id']) ? $_POST['Id'] : '');
$token = ( isset($_POST['token']) ? $_POST['token'] : '');


        if($user_handler->validateToken($token) === false) {
            $retObject = new stdClass;
            $retObject->error = "Token is invalid";
            $retObject->errorCode = 1338;
            echo json_encode($retObject);
            die();
        } 

        

        $isAdmin = $user_handler->isAdmin($token);

        if($isAdmin === false) {
        echo "You are not admin";
        die;
        } 

        $product_handler->deleteProduct($productId_IN);
        
    
 
?>




