<?php
include('../../objects/orderrows.php');
include('../../objects/users.php');

$orderrow_handler = new Orderrow($databaseHandler);
$user_handler = new User($databaseHandler);


$orderrowId_IN = ( isset($_POST['orderrowId']) ? $_POST['orderrowId'] : '');


if(!empty($_POST['token'])) {
    $token = $_POST['token'];

    if($user_handler->validateToken($token) === false) {
        $retObject = new stdClass;
        $retObject->error = "Token is invalid";
        $retObject->errorCode = 554;
        echo json_encode($retObject);
        die();
    }

        $orderrow_handler->deleteOrderrow($orderrowId_IN);
        
        echo "Orderrad $orderrowId_IN har nu raderats";

} else {
    $retObject = new stdClass;
    $retObject->error = "No token found!";
    $retObject->errorCode = 556;

    echo json_encode($retObject);
}
