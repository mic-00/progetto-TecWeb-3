<?php

use DB\DBConnection;

$connection = new DBConnection();

$id = $brand = $model = "";
if (isset($_GET["id"]))
    $id = "AND `purchase_item`.`id`={$_GET["id"]} ";
if (isset($_GET["brand"]))
    $brand = "AND `brand`.`name`='{$_GET["brand"]}' ";
if (isset($_GET["model"]))
    $model = "AND `model`.`name`='{$_GET["model"]}' ";

$query = "SELECT `brand`.`name` AS `brand`, `model`.`name` as `model`, `purchase_item`.`id` AS `id`, `description`, `released_at`, `os`, `display_size`, " .
    "`display_resolution`, `camera_pixels`, `ram`, `chipset`, `battery_size`, `battery_type`, `bluetooth`, `gps`, `sim`, `weight`, `dimensions`, `price` " .
    "FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` " .
    "JOIN `purchase_item` ON `model`.`id`=`purchase_item`.`model` " .
    "WHERE `user` IS NULL " . $id . $brand . $model;

return $connection->query($query);

?>