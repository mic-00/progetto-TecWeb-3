<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `id` FROM `brand` WHERE `name`=?";
$brand = $connection->query(
    $query,
    $_POST["brand"]
)[0]["id"];

$query = "SELECT `id` FROM `model` WHERE `brand`=? AND `name`=?";
if (count($connection->query($query, $brand, $_POST["name"])))
    return false;

$query = "INSERT INTO `model` (`brand`, `name`, `released_at`, `os`, `display_resolution`, `camera_pixels`, `chipset`, `battery_size`, `battery_type`, `bluetooth`, `sim`, `gps`, `weight`, `dimensions`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
return $connection->query(
    $query,
    $brand,
    htmlentities($_POST["name"]),
    htmlentities($_POST["year"]),
    htmlentities($_POST["os"]),
    htmlentities($_POST["screen"]),
    htmlentities($_POST["camera"]),
    htmlentities($_POST["processor"]),
    htmlentities($_POST["battery-size"]),
    htmlentities($_POST["battery-type"]),
    htmlentities($_POST["bluetooth"]),
    htmlentities($_POST["sim"]),
    htmlentities($_POST["gps"]),
    htmlentities($_POST["weight"]),
    htmlentities($_POST["dimensions"])
);

?>