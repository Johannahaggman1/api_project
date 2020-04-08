<?php
include('../../objects/orderrows.php');
include('../../objects/users.php');

$orderrow_handler = new Orderrow($databaseHandler);
$user_handler = new User($databaseHandler);

if(!empty($_POST['token'])) {
        $token = $_POST['token'];

        if($user_handler->validateToken($token) === false) {
            $retObject = new stdClass;
            $retObject->error = "Token is invalid";
            $retObject->errorCode = 554;
            echo json_encode($retObject);
            die();
        }

        $productAmount_IN = ( isset($_POST['amount']) ? $_POST['amount'] : '');
        $rowId_IN = ( isset($_POST['rowId']) ? $_POST['rowId'] : '');
        
        $orderrow_handler->updateCart($productAmount_IN, $rowId_IN);
      
        echo "Antal produkter på varukorgsrad $rowId_IN är nu ändrat $productAmount_IN ";

} else {
    $retObject = new stdClass;
    $retObject->error = "No token found!";
    $retObject->errorCode = 557;

    echo json_encode($retObject);
}
