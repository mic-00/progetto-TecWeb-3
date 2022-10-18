<?php

use DB\DBConnection;

$connection = new DBConnection();

$clause = "WHERE 1=1 ";
$brand = $model = "";

if (isset($_GET["brand"])) {
    $brand = $_GET["brand"];
    $model = $_GET["model"] ?? "";
}
if ($brand)
    $clause = "AND `brand`.`name`='$brand' ";
if ($model)
    $clause .= "AND `model`.`name`='$model' ";

$query = "SELECT COUNT(`model`.`id`) AS `count` FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` {$clause}";
$models = $connection->query($query)[0]["count"];
$pages = floor($models / 50) + 1;

$currentPage = 0;

if (isset($_POST["first"]) || isset($_POST["prev"]) || isset($_POST["next"]) || isset($_POST["last"])) {
    if (isset($_POST["first"])) $currentPage = 0;
    elseif (isset($_POST["prev"])) $currentPage = $_POST["current-page"] - 1;
    elseif (isset($_POST["next"])) $currentPage = $_POST["current-page"] + 1;
    elseif (isset($_POST["last"])) $currentPage = $pages - 1;
} else {
    $currentPage = $_POST["current-page"] ?? 0;
}
if ($currentPage < 0) $currentPage = 0;
if ($currentPage >= $pages) $currentPage = $pages - 1;

$query = "SELECT `model`.`id` AS `id`, `model`.`name` AS `model`, `model`.`brand` AS `brand` " .
    "FROM (" .
        "SELECT `model`.`id`, `model`.`name`, `brand`.`name` AS `brand` " .
        "FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` " .
        $clause .
        "ORDER BY `brand`.`name`, `model`.`name` LIMIT ?" .
    ") AS `model` LEFT JOIN (" .
        "SELECT `model`.`id` " .
        "FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` " .
        $clause .
        "ORDER BY `brand`.`name`, `model`.`name` LIMIT ?" .
    ") AS `model_2` " .
    "ON `model`.`id`=`model_2`.`id` " .
    "WHERE `model_2`.`id` IS NULL";

return [
    $currentPage,
    $connection->query($query, ($currentPage + 1) * 50, $currentPage * 50)
];

?>