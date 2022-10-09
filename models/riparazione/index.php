<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `model`.`id` AS `id` " .
    "FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` " .
    "WHERE `brand`.`name`=? AND `model`.`name`=?";
$model = $connection->query($query, $_POST["brand"], $_POST["model"])[0] ?? null;

if ($model) {
    if (isset($_POST["alt"])) {
        $query = "INSERT INTO `repair_item` (`model`, `user`, `description`, `alt`) VALUES (?, ?, ?, ?)";
        return $connection->query($query, $model["id"], $_SESSION["username"], $_POST["description"], $_POST["alt"]);
    } else {
        $query = "INSERT INTO `repair_item` (`model`, `user`, `description`) VALUES (?, ?, ?)";
        return $connection->query($query, $model["id"], $_SESSION["username"], $_POST["description"]);
    }
}
return null;

?>
