<?php

require_once "../config/config.php";
require_once ROOT . "/utils/DBConnection.php";

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `model`.`name` FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` WHERE `brand`.`name`=? " .
    "GROUP BY `model`.`name` ORDER BY `model`.`name`";

echo json_encode(
    array_map(
        function ($m) { return $m["name"]; },
        $connection->query($query, $_GET["brand"])
));

?>