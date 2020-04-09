<?php

include('../../objects/orderrows.php');
include('../../objects/users.php');

$orderrow_object = new Orderrow ($databaseHandler);
$user_handler = new User($databaseHandler);

$cartId_IN = ( isset($_POST['cartId']) ? $_POST['cartId'] : '');
$token = $_POST['token'];
$checkoutStatus = 1;

if($user_handler->validateToken($token) === false) {
    $retObject = new stdClass;
    $retObject->error = "Token is invalid";
    $retObject->errorCode = 1338;
    echo json_encode($retObject);
    die();
} 

if(!empty($cartId_IN)) {
    $orderrow_object->checkoutCart($checkoutStatus, $cartId_IN);
    $orderrow_object->updatestockAmount ($cartId_IN);
    echo "Nu är din varukorg utcheckad";
} else {
    echo "Error: userId cannot be empty!";
}

