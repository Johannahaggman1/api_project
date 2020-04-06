<?php

include('../../objects/Cart.php');
include('../../objects/Users.php');

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


if($cartID > -1) {

    $cart_object->setCartId($cartID);
    print_r( $cart_object->fetchCart($cartID) );

} else {

    echo "Error: Missing parameter id!";

}
?>
