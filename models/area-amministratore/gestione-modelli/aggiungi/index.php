<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `id` FROM `brand` WHERE `name`=?";
$brand = $connection->query($query, $_POST["brand"])[0]["id"];

$query = "INSERT INTO `model` (`brand`, `name`, `released_at`, `os`, `display_resolution`, `camera_pixels`, `chipset`, `battery_size`, `battery_type`, `bluetooth`, `sim`, `gps`, `weight`, `dimensions`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
return $connection->query(
    $query,
    $brand, $_POST["name"], $_POST["year"], $_POST["os"], $_POST["screen"], $_POST["camera"], $_POST["processor"], $_POST["battery-size"],
    $_POST["battery-type"], $_POST["bluetooth"], $_POST["sim"], $_POST["gps"], $_POST["weight"], $_POST["dimensions"]
);

?>