<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "UPDATE `repair_item` SET `cost`=?, `expected_time`=? WHERE `id`=?";
return $connection->query($query, $_POST["cost"], $_POST["time"], $_GET["id"]);

?>