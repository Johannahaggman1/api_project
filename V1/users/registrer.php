<?php

//Måste kanske lägga till yttligare ../ ?
// har inte koll på exakt hur många punkter och skit det handlar om när man ska gå ur en fil o in i en annan den ska en upp och sen ner i den filen
//vet du? nä men ere inte två för att backa, men osä
//såhär titta du ska ut två
//den ligger utanför v1 i samma nivå eller va man ska säga - om objekts legat i v1 hade de funkat såhär ../ ser du?
    include("../objects/users.php");

    $user_handler = new User($databaseHandler);

    echo $user_handler->addUser($_POST['username'], $_POST['password'], $_POST['email']);


?>