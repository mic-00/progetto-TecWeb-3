<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `brand`.`name` AS `brand`, `model`.`name` as `model`, `model`.`id` AS `id`, `released_at`, `os`, `display_size`, " .
    "`display_resolution`, `camera_pixels`, `ram`, `chipset`, `battery_size`, `battery_type`, `bluetooth`, `gps`, `sim`, `weight`, `dimensions` " .
    "FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` " .
    "WHERE `model`.`id`=?";

return $connection->query($query, $_GET["id"])[0];

?>