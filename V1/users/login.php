<?php

    include("../../objects/users.php");

    $user_handler = new User($databaseHandler);

    print_r($user_handler->loginUser($_POST['username'], $_POST['password']));
   
    


?>