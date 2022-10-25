<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "INSERT INTO `user` VALUES (?, ?, ?, ?)";

return $connection->query(
    $query,
    htmlentities($_POST["username"]),
    htmlentities($_POST["email"]),
    htmlentities($_POST["password"]),
    0
);

?>