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

    public function createCart($userId_param) {
        $query_string = "INSERT INTO cart (userId) VALUES (:userId_IN)";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":userId_IN", $userId_param);
            $success = $statementHandler->execute();

        } else {
            echo "Couldn't create statement handler!";
        }
    }

    public function checkoutCart($checkoutStatus_param, $cartId_param) {
        $query_string = "UPDATE cart SET checkoutStatus=:checkoutStatus_IN WHERE Id=:cartId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":checkoutStatus_IN", $checkoutStatus_param);
            $statementHandler->bindParam(":cartId_IN", $cartId_param);
            $statementHandler->execute();
            $statementHandler->fetch();
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

       public function getProductId($orderrowId_param) {
        $query_string = "SELECT productId FROM orderrows WHERE Id=orderrowId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":orderrowId_IN", $orderrowId_param);

            $statementHandler->execute();
            return $statementHandler->fetchAll();

            } else {
                echo "Error while trying to insert product to database!";
            }
       }

       public function getUserIdInCart ($cartId_param) {
        $query_string = "SELECT userId FROM cart WHERE userId=cartId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":cartId_IN", $cartId_param);

            $statementHandler->execute();
            return $statementHandler->fetch();

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

    public function getCheckoutStatus($cartId_param) {

        $query_string = "SELECT checkoutStatus FROM cart WHERE Id=:cartId_IN";
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

    public function deleteOrderrow($orderrowId_param) {

            $query_string = "DELETE FROM orderrows WHERE Id=:orderrow_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":orderrow_id", $orderrowId_param);
            $statementHandler->execute();
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

    public function fetchCart($cartId_param) {

        $query_string = "SELECT productAmount, totalPrice, productName FROM orderrows JOIN products ON orderrows.productId=products.Id WHERE cartId=:cartId_IN";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":cartId_IN", $cartId_param);
            $statementHandler->execute();
            return $statementHandler->fetchAll();

        } else {
            echo "Could not create database statement!";
            die();
        }
        
    }

    public function updateCart($productAmount_param, $orderrowId_param) {

            $query_string = "UPDATE orderrows SET productAmount=:productAmount_IN WHERE Id=:orderrowId_IN";
            $statementHandler = $this->database_handler->prepare($query_string);

            if($statementHandler !== false) {

            $statementHandler->bindParam(":productAmount_IN", $productAmount_param);
            $statementHandler->bindParam(":orderrowId_IN", $orderrowId_param);

            $statementHandler->execute();    
    
            } else {
                echo "Could not create database statement!";
                die();
            }

        }

        public function addToOrderrow($productAmount_param, $totalPrice_param, $productId_param, $cartId_param) {
            $return_object = new stdClass();
    
            if($this->isProductIdTaken($productId_IN) === false) {
                if($this->ischeckoutStatusChecked($checkoutstatus_IN) === false) {
    
                    
                    $return = $this->insertOrderrowToDatabase($productAmount_param, $totalPrice_param, $productId_param, $cartId_param);
                    if($return !== false) {
    
                        $return_object->state = "SUCCESS";
                        $return_object->user = $return;
    
                    }  else {
                        $return_object->state = "ERROR";
                        $return_object->message = "Something went wrong when trying to INSERT";
                    }
                } else {
                    $return_object->state = "ERROR";
                    $return_object->message = "Checkoutstatus is already checked out";
                }
            } else {
                $return_object->state = "ERROR";
                $return_object->message = "ProductId is taken";
            }
                
    
            return json_encode($return_object);
           }
        
           
           private function insertOrderrowToDatabase($productAmount_param, $totalPrice_param, $productId_param, $cartId_param) {
    
                $query_string = "INSERT INTO orderrows (productAmount, totalPrice, productId, cartId) VALUES(:productAmount_IN, :totalPrice_IN, :productId_IN, :cartId_IN)";
                $statementHandler = $this->database_handler->prepare($query_string);
    
                if($statementHandler !== false ){
    
                    $encrypted_password = md5($password_param);
    
                    $statementHandler->bindParam(':productAmount_IN', $productAmount_param);
                    $statementHandler->bindParam(':totalPrice_IN', $totalPrice_param);
                    $statementHandler->bindParam(':productId_IN', $productId_param);
                    $statementHandler->bindParam(':cartId_IN', $cartId_param);
    
                    $statementHandler->execute();
    
    
                    $last_inserted_id = $this->database_handler->lastInsertId();
    
                    $query_string = "SELECT Id, productAmount, totalPrice, productId, cartId FROM orderrows WHERE Id=:last_id";
                    $statementHandler = $this->database_handler->prepare($query_string);
    
                    $statementHandler->bindParam(':last_id', $last_inserted_id);
    
                    $statementHandler->execute();
    
                    return $statementHandler->fetch();
                    
    
                } else {
                    return false;
                }
           }
    
           public function isProductIdTaken($productId_param, $userId_param) {
    
                $query_string = "SELECT COUNT(productId) FROM orderrows JOIN cart ON orderrows.cartId=cart.Id WHERE productId=:productId_IN AND userId=:userId_IN";
                $statementHandler = $this->database_handler->prepare($query_string);
    
                if($statementHandler !== false ){
    
                    $statementHandler->bindParam(":productId_IN", $productId_param);
                    $statementHandler->bindParam(":userId_IN", $userId_param);
                    $statementHandler->execute();
    
                    $numberOfProductId = $statementHandler->fetch()[0];
    
                    if($numberOfProductId > 0) {
                        
                        return true; 
                    } else {
                        return false;
                    }
    
    
                } else {
                    echo "Statementhandler faild!";
                    die;
                }
            }
            
            public function ischeckoutStatusChecked($checkoutStatus_param, $cartId_IN) {
                
                $query_string = "SELECT COUNT(Id) FROM cart WHERE checkoutStatus=:checkoutStatus_IN AND Id=:cartId_IN";
                $statementHandler = $this->database_handler->prepare($query_string);
    
                if($statementHandler !== false ){
    
                    $statementHandler->bindParam(":checkoutStatus_IN", $checkoutStatus_param);
                    $statementHandler->bindParam(":cartId_IN", $cartId_param);
                    $statementHandler->execute();
    
                    $numberOfCheckoutstatus = $statementHandler->fetch()[0];
    
                    if($numberOfCheckoutstatus > 0) {
                        return true; 
                    } else {
                        return false;
                    }
    
    
                } else {
                    echo "Statementhandler fail!";
                    die;
                }
            } 

}