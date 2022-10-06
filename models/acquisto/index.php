<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `brand`.`name` AS `brand`, `model`.`name` as `model`, `purchase_item`.`id` AS `id`, `price` " .
    "FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` " .
    "JOIN `purchase_item` ON `model`.`id`=`purchase_item`.`model` " .
    "WHERE `user` IS NULL";

return $connection->query($query);

?>