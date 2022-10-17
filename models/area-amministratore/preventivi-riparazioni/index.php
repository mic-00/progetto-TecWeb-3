<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT * FROM `repair_item` WHERE `cost` IS NULL AND `expected_time` IS NULL";

return $connection->query($query);

?>