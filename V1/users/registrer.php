<?php

    include("../../objects/users.php");

    $user_handler = new User($databaseHandler);

    echo $user_handler->addUser($_POST['username'], $_POST['password'], $_POST['email']);


?>