<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `brand`.`name` AS `brand`, `model`.`name` AS `model`, `purchase_item`.`id` AS `id`, `description`, `released_at`, `os`, `display_size`, " .
    "`display_resolution`, `camera_pixels`, `ram`, `chipset`, `battery_size`, `battery_type`, `bluetooth`, `gps`, `sim`, `weight`, `dimensions`, `price` " .
    "FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` " .
    "JOIN `purchase_item` ON `model`.`id`=`purchase_item`.`model` " .
    "WHERE `purchase_item`.`id`=?";

return $connection->query($query, $_GET["id"])[0] ?? null;

?>