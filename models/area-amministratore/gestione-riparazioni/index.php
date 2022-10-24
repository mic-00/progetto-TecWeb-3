<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `brand`.`name` AS `brand`, `model`.`name` as `model`, `repair_item`.`id` AS `id`, `description`, `img_alt`, `released_at`, `os`, `display_size`, " .
    "`display_resolution`, `camera_pixels`, `ram`, `chipset`, `battery_size`, `battery_type`, `bluetooth`, `gps`, `sim`, `weight`, `dimensions` " .
    "FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` JOIN `repair_item` ON `model`.`id`=`repair_item`.`model` " .
    "WHERE `cost` IS NULL AND `expected_time` IS NULL";

if (isset($_GET["id"])) {
    $query .= " AND `repair_item`.`id`=?";
    return $connection->query($query, $_GET["id"]);
}
return $connection->query($query);

?>