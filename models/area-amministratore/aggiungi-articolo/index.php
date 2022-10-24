<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `model`.`id` AS `id` " .
    "FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` " .
    "WHERE `brand`.`name`=? AND `model`.`name`=?";
$model = $connection->query($query, $_POST["brand"], $_POST["model"])[0] ?? false;

if ($model) {
    $query = "INSERT INTO `purchase_item` (`model`, `description`, `price`) VALUES (?, ?, ?)";
    $isInserted = $connection->query($query, $model["id"], $_POST["description"], $_POST["price"]);
    if ($isInserted) {
        $query = "SELECT LAST_INSERT_ID() as `id`";
        return $connection->query($query)[0]["id"] ?? false;
    }
}
return false;

?>