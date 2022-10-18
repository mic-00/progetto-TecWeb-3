<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT * FROM `model` WHERE `id`=?";

return $connection->query($query, $_GET["id"])[0];

?>