<?php
include("../objects/cart.php");
include("../objects/users.php");

$cart_object = new Cart($databaseHandler);
$user_handler = new User($databaseHandler);

$token = $_POST['token'];

$cartID = ( !empty($_POST['userId'] ) ? $_POST['userId'] : -1 );

if($user_handler->validateToken($token) === false) {
    $retObject = new stdClass;
    $retObject->error = "Token is invalid";
    $retObject->errorCode = 1338;
    echo json_encode($retObject);
    die();
} 

//Kan det va så att det inte funkar för att vi inte har med nån "user_id" som han har i sin fetchSingelPost() funktion? 


if($cartID > -1) {

    $cart_object->setCartId($cartID);
    print_r( $cart_object->fetchCart() );

} else {

    echo "Error: Missing parameter id!";

}

?>
