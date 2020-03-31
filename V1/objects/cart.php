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

    public function addProductToCart($productAmount_param, $productId_param, $tokenId_param) {


        $query_string = "INSERT INTO cart (productAmount, productId, tokenId) VALUES(:productAmount_IN, :productId_IN, :tokenId_IN)";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":productAmount_IN", $productAmount_param);
            $statementHandler->bindParam(":productId_IN", $productId_param);
            $statementHandler->bindParam(":tokenId_IN", $tokenId_param);
          
            
            $success = $statementHandler->execute();

            if($success === true) {
                echo "OK!";
            } else {
                echo "Error while trying to insert product to database!";
            }

        } else {
            echo "Could not create database statement!";
            die();
        }
    }








}