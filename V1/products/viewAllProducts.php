<?php
include('../objects/products.php');
include('../objects/users.php');

$posts_object = new Posts($databaseHandler);
$user_handler = new User($databaseHandler);

$token = $_POST['token'];

if($user_handler->validateToken($token) === false) {
    echo "Invalid token!";
    die;
}

echo "<pre>";
print_r($posts_object->fetchAllPosts());
echo "</pre>";



?>