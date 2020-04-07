<?php

include('../../objects/orderrows.php');
include('../../objects/users.php');
include('../../objects/products.php');

$orderrow_object = new Orderrow ($databaseHandler);
$user_handler = new User($databaseHandler);
$product_handler = new Products($databaseHandler);

$token = $_POST['token'];
$orderrowID = ( !empty($_POST['orderId'] ) ? $_POST['orderId'] : -1 );
 

if($user_handler->validateToken($token) === false) {
    $retObject = new stdClass;
    $retObject->error = "Token is invalid";
    $retObject->errorCode = 1338;
    echo json_encode($retObject);
    die();
} 


if($orderrowID > -1) {

    $orderrow_object->setOrderrowId($orderrowID);
    print_r( $orderrow_object->fetchOrderrow($orderrowID) );

} else {

    echo "Error: Missing parameter id!";

}
?>
