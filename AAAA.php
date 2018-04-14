

<?php
// Initialize the session

session_start();
require_once './db.php';
$db = new DB();

$users = $db->getResults("SELECT * FROM `users`");
$type = $db->getResults("SELECT * FROM `users` WHERE `user_type`  ");
        echo "<pre>";
        print_r($type);


?>
