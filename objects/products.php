<?php

include("../../config/database_handler.php");

class Products {
    private $database_handler;
    private $product_id;

    public function __construct( $database_handler_IN ) {

        $this->database_handler = $database_handler_IN;

    }

    public function setProductId($product_id_IN) {

        $this->product_id = $product_id_IN;

    }

    public function fetchSingleProduct() {
        
        $query_string = "SELECT Id, productName, price, stockamount FROM products WHERE Id=:product_id";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {
            
            $statementHandler->bindParam(":product_id", $this->product_id);
            $statementHandler->execute();

            return $statementHandler->fetch();



        } else {
            echo "Could not create database statement!";
            die();
        }
    }

    public function fetchAllProducts() {

        
        $query_string = "SELECT Id, productName, price, stockamount FROM products ORDER BY price";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->execute();
            return $statementHandler->fetchAll();


        } else {
            echo "Could not create database statement!";
            die();
        }
        
    }

    public function fetchAllProductsDESC() {

       
        $query_string = "SELECT Id, productName, price, stockamount FROM products ORDER BY price DESC";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->execute();
            return $statementHandler->fetchAll();


        } else {
            echo "Could not create database statement!";
            die();
        }
        
    }

   
    public function addProduct($productName_param, $price_param, $stockamount_param) {

        $query_string = "INSERT INTO products (productName, price, stockamount) VALUES(:name_IN, :price_IN, :stockamount_IN)";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":name_IN", $productName_param);
            $statementHandler->bindParam(":price_IN", $price_param);
            $statementHandler->bindParam(":stockamount_IN", $stockamount_param);
         
            
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

 

    public function updateProduct($data) {

    

        if(!empty($data['productName'])) {
            $query_string = "UPDATE products SET productName=:productName WHERE Id=:product_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":productName", $data['productName']);
            $statementHandler->bindParam(":product_id", $data['Id']);

            $statementHandler->execute();
            
        }

        if(!empty($data['price'])) {
            $query_string = "UPDATE products SET price=:price WHERE Id=:product_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":price", $data['price']);
            $statementHandler->bindParam(":product_id", $data['Id']);

            $statementHandler->execute();
            
        }

        if(!empty($data['stockamount'])) {
            $query_string = "UPDATE products SET stockamount=:stockamount WHERE Id=:product_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":stockamount", $data['stockamount']);
            $statementHandler->bindParam(":product_id", $data['Id']);

            $statementHandler->execute();
            
        }

        $query_string = "SELECT Id, productName, price, stockamount FROM products WHERE Id=:product_id";
        $statementHandler = $this->database_handler->prepare($query_string);

        $statementHandler->bindParam(":product_id", $data['Id']);
        $statementHandler->execute();

        echo json_encode($statementHandler->fetch());


    }

    public function deleteProduct($productId_param) {

            $query_string = "DELETE FROM products WHERE Id=:product_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            
            $statementHandler->bindParam(":product_id", $productId_param);
            $success = $statementHandler->execute();

            if($success === true) {
            echo "Produkt har nu raderats";
            } else {
                echo "Produkten ligger i en varukorg, ta bort produkten ur varukorg innan du försöker igen!";
            }
            
        }


    public function getProductPrice($productId_param) {

        $query_string = "SELECT price FROM products WHERE Id=:productId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {
            
            $statementHandler->bindParam(":productId_IN", $productId_param);
            $statementHandler->execute();

            return $statementHandler->fetch();

        } else {
            echo "Could not create database statement!";
            die();
        }


    }


}


?>