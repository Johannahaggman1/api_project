<?php

include("../../config/database_handler.php");

class Orderrow {
    private $database_handler;
    private $orderrow_id;

    public function __construct( $database_handler_IN ) {

        $this->database_handler = $database_handler_IN;

    }

    public function setOrderrowId($orderrow_id_IN) {

        $this->orderrowID = $orderrow_id_IN;

    } 

    public function checkoutCart($checkoutStatus_param, $userId_param) {
        $query_string = "UPDATE cart SET checkoutStatus=:checkoutStatus_IN WHERE userId=:userId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":checkoutStatus_IN", $checkoutStatus_param);
            $statementHandler->bindParam(":userId_IN", $userId_param);
            $statementHandler->execute();
            
            //$return = $statementHandler->fetch();

        } else {
            echo "Couldn't create statement handler!";
        }

       }

       public function getStockAmount($cartId_param) {
        $query_string = "SELECT stockamount FROM orderrows JOIN products ON orderrows.productId=products.Id WHERE cartId=:cartId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":cartId_IN", $cartId_param);

            $statementHandler->execute();
            return $statementHandler->fetch();

            } else {
                echo "Error while trying to insert product to database!";
            }
       }

       public function getProductId($cartId_param) {
        $query_string = "SELECT productId FROM orderrows WHERE cartId=cartId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":cartId_IN", $cartId_param);

            $statementHandler->execute();
            return $statementHandler->fetchAll();

            } else {
                echo "Error while trying to insert product to database!";
            }
       }



       public function updatestockAmount ($cartId_param) {

        $query_string = "UPDATE orderrows JOIN products ON orderrows.productId= products.Id SET stockAmount=stockAmount-productAmount WHERE cartId=:cartId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {
            $statementHandler->bindParam(":cartId_IN", $cartId_param);

            $statementHandler->execute();

        } else {
                echo "Error while trying to insert product to database!";
        }
       }

       public function getCartId($userId_param) {
        $query_string = "SELECT Id FROM cart WHERE userId=:userId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":userId_IN", $userId_param);

            $statementHandler->execute();
            return $statementHandler->fetch();

            } else {
                echo "Error while trying to insert product to database!";
            }
       }

    public function checkUserId($userId_param) {
        $query_string = "SELECT userId FROM cart WHERE userId=:userId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":userId_IN", $userId_param);
            $statementHandler->execute();
            return $statementHandler->fetch();

            } else {
                echo "Error while trying to hämta nått ? to database!";
            }
       }
    
    
    public function addProductToOrderrow($productAmount_param, $totalPrice_param, $productId_param, $cartId_param) {


        $query_string = "INSERT INTO orderrows (productAmount, totalPrice, productId, cartId) VALUES(:productAmount_IN, :totalPrice_IN, :productId_IN, :cartId_IN)";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":productAmount_IN", $productAmount_param);
            $statementHandler->bindParam(":totalPrice_IN", $totalPrice_param);
            $statementHandler->bindParam(":productId_IN", $productId_param);
            $statementHandler->bindParam(":cartId_IN", $cartId_param);
            

            $success = $statementHandler->execute();

            if($success === true) {
                echo "Produkten är nu lagd i varukorgen";
            } else {
                echo "Error while trying to insert product to database!";
            }

        } else {
            echo "Could not create database statement!";
            die();
        }
    }

    public function fetchOrderrow($orderId_param) {

        $query_string = "SELECT Id, productAmount, productID, orderId FROM orderrows WHERE orderId=:orderId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":orderId_IN", $orderId_param);
            $statementHandler->execute();
            return $statementHandler->fetchAll();

        } else {
            echo "Could not create database statement!";
            die();
        }
        
    } 

    public function fetchOrderrowId($orderId_param) {

        $query_string = "SELECT Id FROM orderrows WHERE orderId=:orderId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":orderId_IN", $orderId_param);
            $statementHandler->execute();
            return $statementHandler->fetchAll();

        } else {
            echo "Could not create database statement!";
            die();
        }
    }



    public function deleteOrderrow($data) {


        if(!empty($data['Id'])) {
            $query_string = "DELETE FROM orderrows WHERE Id=:orderrow_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":orderrow_id", $data['Id']);

            $statementHandler->execute();
            
        }

    
        $query_string = "SELECT Id FROM orderrows WHERE Id=:orderrow_id";
        $statementHandler = $this->database_handler->prepare($query_string);

        $statementHandler->bindParam(":orderrow_id", $data['Id']);
        $statementHandler->execute();

        echo json_encode($statementHandler->fetch());


    }

    public function checkCartId ($cartId_param) {
        $query_string = "SELECT Id FROM cart WHERE Id=:cartId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":cartId_IN", $cartId_param);
            $statementHandler->execute();

            return $statementHandler->fetch();

        } else {
            echo "Could not create database statement!";
            die();
        }
    }

    public function CreateOrder($orderrowId_param, $checkoutStatus_param) {
 
        $query_string = "INSERT INTO cart (checkoutStatus) VALUES (:checkoutStatus_IN) WHERE cartId=:cartId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":orderrowId_IN", $orderrowId_param);
            $statementHandler->bindParam(":checkoutStatus_IN", $checkoutStatus_param);
            
            $success = $statementHandler->execute();

            if($success === true) {
                echo "orderrow nu lagd i orders";
            } else {
                echo "Error while trying to insert products in orderrow to orders in database!";
            }

            } else {
            echo "Could not create database statement!";
            die();
            }        

    }



}