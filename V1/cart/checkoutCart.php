<?php

include('../../objects/orderrows.php');
include('../../objects/users.php');

$orderrow_object = new Orderrow ($databaseHandler);
$user_handler = new User($databaseHandler);

$userId_IN = ( isset($_POST['userId']) ? $_POST['userId'] : '');
$token = $_POST['token'];
$checkoutStatus = 1;
$cartId = $orderrow_object->getCartId($userId_IN);


if($user_handler->validateToken($token) === false) {
    $retObject = new stdClass;
    $retObject->error = "Token is invalid";
    $retObject->errorCode = 1338;
    echo json_encode($retObject);
    die();
} 

if(!empty($userId_IN)) {
    $orderrow_object->checkoutCart($checkoutStatus, $userId_IN);
    $orderrow_object->updatestockAmount ($cartId[0]);
    echo "Nu är din varukorg utcheckad";
} else {
    echo "Error: userId cannot be empty!";
}

