<?php
include('../../objects/orderrows.php');
include('../../objects/users.php');

$orderrow_object = new Orderrow($databaseHandler);
$user_handler = new User($databaseHandler);

$cartId_IN = ( isset($_POST['cartId']) ? $_POST['cartId'] : '');
$token = $_POST['token'];

if($user_handler->validateToken($token) === false) {
    $retObject = new stdClass;
    $retObject->error = "Token is invalid";
    $retObject->errorCode = 1338;
    echo json_encode($retObject);
    die();
} 

    echo "<pre>";
    print_r($orderrow_object->fetchCart($cartId_IN));
    echo "</pre>";



?>