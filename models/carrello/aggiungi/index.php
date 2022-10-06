<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `id` FROM `purchase_item` WHERE `id`=?";
return $connection->query($query, $_GET["id"])[0] ?? null;

?>