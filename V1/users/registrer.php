<?php

    include("../../objects/users.php");

    $user_handler = new User($databaseHandler);

    

    if(!empty($_POST['username'])) {
        if(!empty($_POST['password'])) {
            if(!empty($_POST['email'])) {

                echo $user_handler->addUser($_POST['username'], $_POST['password'], $_POST['email']);

            } else {
            echo "Error: Skriv in emailadress!";
        }

        } else {
            echo "Error: Skriv in lösenord!";
        }

    } else {
        echo "Error: Skriv in Användarnamn!";
    }


?>