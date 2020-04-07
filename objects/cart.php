<?php

include("../../config/database_handler.php");

class Cart {
    private $database_handler;
    private $cart_id;

    public function __construct( $database_handler_IN ) {

        $this->database_handler = $database_handler_IN;

    }

    public function setCartId($cart_id_IN) {

        $this->cartID = $cart_id_IN;

    } 

    public function addProductToCart($productAmount_param, $totalPrice_param, $productId_param, $userId_param) {


        $query_string = "INSERT INTO cart (productAmount, totalPrice, productId, userId) VALUES(:productAmount_IN, :totalPrice_IN, :productId_IN, :userId_IN)";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":productAmount_IN", $productAmount_param);
            $statementHandler->bindParam(":totalPrice_IN", $totalPrice_param);
            $statementHandler->bindParam(":productId_IN", $productId_param);
            $statementHandler->bindParam(":userId_IN", $userId_param);
            

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

    public function fetchCart($userId_param) {

        $query_string = "SELECT Id, productAmount, productID, userId FROM Cart WHERE userId=:userId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":userId_IN", $userId_param);
            $statementHandler->execute();
            return $statementHandler->fetchAll();

        } else {
            echo "Could not create database statement!";
            die();
        }
        
    } 

    public function deleteCart($data) {


        if(!empty($data['Id'])) {
            $query_string = "DELETE FROM cart WHERE Id=:cart_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":cart_id", $data['Id']);

            $statementHandler->execute();
            
        }

    
        $query_string = "SELECT Id FROM cart WHERE Id=:cart_id";
        $statementHandler = $this->database_handler->prepare($query_string);

        $statementHandler->bindParam(":cart_id", $data['Id']);
        $statementHandler->execute();

        echo json_encode($statementHandler->fetch());


    }



}