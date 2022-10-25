<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `model`.`id` AS `id` " .
    "FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` " .
    "WHERE `brand`.`name`=? AND `model`.`name`=?";
$model = $connection->query($query, $_POST["brand"], $_POST["model"])[0] ?? false;

if ($model) {
    $isInserted = false;
    if (isset($_POST["alt"])) {
        $query = "INSERT INTO `repair_item` (`model`, `user`, `description`, `img_alt`) VALUES (?, ?, ?, ?)";
        $isInserted = $connection->query(
            $query,
            $model["id"],
            htmlentities($_SESSION["username"]),
            htmlentities($_POST["description"]),
            htmlentities($_POST["alt"])
        );
    } else {
        $query = "INSERT INTO `repair_item` (`model`, `user`, `description`) VALUES (?, ?, ?)";
        $isInserted = $connection->query(
            $query,
            $model["id"],
            htmlentities($_SESSION["username"]),
            htmlentities($_POST["description"])
        );
    }
    if ($isInserted) {
        $query = "SELECT LAST_INSERT_ID() as `id`";
        return $connection->query($query)[0]["id"] ?? false;
    }
}
return false;

?>
