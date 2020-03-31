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

        //Ändrade WHERE id=:product_id till Id med stort i
        

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

        $query_string = "SELECT Id, productName, price, stockamount FROM products";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->execute();
            return $statementHandler->fetchAll();


        } else {
            echo "Could not create database statement!";
            die();
        }
        
    }

    //Ändrade om namnen i :name_IN och tog även bort ,content_param från addproduct( ).
    public function addProduct($title_param) {

        $query_string = "INSERT INTO products (productName, price, stockamount) VALUES(:name_IN, 150, 20)";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":name_IN", $title_param);
           /*  $statementHandler->bindParam(":content_IN", $content_param); */
            
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

        // Testar att byta title till name -- if(!empty($data['title'])) 

        if(!empty($data['productName'])) {
            $query_string = "UPDATE products SET productName=:productName WHERE Id=:product_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":productName", $data['productName']);
            $statementHandler->bindParam(":product_id", $data['Id']);

            $statementHandler->execute();
            
        }

        // Testar att byta content till stockamount , 
        //Ändrade även [id] till [Id]

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


    // Ett försök att skapa DELETEproduct funktion

    public function deleteProduct($data) {


        if(!empty($data['Id'])) {
            $query_string = "DELETE FROM products WHERE Id=:product_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":product_id", $data['Id']);

            $statementHandler->execute();
            
        }

    
        $query_string = "SELECT Id FROM products WHERE Id=:product_id";
        $statementHandler = $this->database_handler->prepare($query_string);

        $statementHandler->bindParam(":product_id", $data['Id']);
        $statementHandler->execute();

        echo json_encode($statementHandler->fetch());


    }

}


?>