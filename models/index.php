<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT COUNT(`username`) AS `users` FROM `user` WHERE `admin`=FALSE";
$users = $connection->query($query)[0];

$query = "SELECT COUNT(`id`) AS `items` ".
    "FROM `purchase_item` " .
    "WHERE `purchase_item`.`user` IS NOT NULL";
$items = $connection->query($query)[0];

return array_merge($users, $items);

?>