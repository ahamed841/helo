<?php


session_start();
require_once './db.php';
$db = new DB();
  $user_type = $_REQUEST['user_type'];
  $admin = $db->getResults("SELECT * FROM `users` ORDER BY `users`.`user_type` ASC = '$user_type'  ");

