<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "INSERT INTO `user` VALUES (?, ?, ?, ?)";

return $connection->query($query, $_POST["username"], $_POST["email"], $_POST["password"], 0);

?>