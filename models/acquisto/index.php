<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `brands`.`name` AS `brand`, `devices`.`name` as `device`, `purchase_item`.`id` AS `id`, `price` " .
    "FROM `brands` JOIN `devices` ON `brands`.`id`=`devices`.`brand` " .
    "JOIN `purchase_item` ON `devices`.`id`=`purchase_item`.`device` " .
    "WHERE `user` IS NULL";

return $connection->query($query);

?>