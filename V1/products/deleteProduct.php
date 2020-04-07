<?php
include('../../objects/products.php');
include('../../objects/users.php');

$product_handler = new Products($databaseHandler);
$user_handler = new User($databaseHandler);

if(!empty($_POST['token'])) {

    if(!empty($_POST['Id'])) { 

        $token = $_POST['token'];

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

        $product_handler->deleteProduct($_POST);
        echo "Produkt har nu raderats";


    } else {

        // här borde man kanske skapa en separat funktion i ex "users.php" dit man hänvisar så man slipper upprepa. 
        $retObject = new stdClass;
        $retObject->error = "Invalid id!";
        $retObject->errorCode = 554;

        echo json_encode($retObject);
    }

} else {
    $retObject = new stdClass;
    $retObject->error = "No token found!";
    $retObject->errorCode = 556;

    echo json_encode($retObject);
}
