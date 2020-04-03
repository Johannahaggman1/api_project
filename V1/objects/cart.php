<?php

include("../../config/database_handler.php");

class Cart {
    private $database_handler;
    private $cart_id;

    public function __construct( $database_handler_IN ) {

        $this->database_handler = $database_handler_IN;

    }

    public function setCartId($cart_id_IN) {

        $this->cart_id = $cart_id_IN;

    } 

    public function addProductToCart($productAmount_param, $productId_param, $userId_param) {


        $query_string = "INSERT INTO cart (productAmount, productId, userId) VALUES(:productAmount_IN, :productId_IN, :userId_IN)";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":productAmount_IN", $productAmount_param);
            $statementHandler->bindParam(":productId_IN", $productId_param);
            $statementHandler->bindParam(":userId_IN", $userId_param);
          
            
            $success = $statementHandler->execute();

            if($success === true) {
                echo "Produkten är nu lagd i varukorgen < /br>";
            } else {
                echo "Error while trying to insert product to database!";
            }

        } else {
            echo "Could not create database statement!";
            die();
        }
    }

    public function fetchCart() {

        //Ändrade WHERE id=:product_id till Id med stort i
        

        $query_string = "SELECT Id, productAmount, userId, productId FROM cart WHERE userId=:userId";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {
            
            $statementHandler->bindParam(":userId", $this->user_id);
            $statementHandler->execute();

            return $statementHandler->fetch();



        } else {
            echo "Could not create database statement!";
            die();
        }
    }






}