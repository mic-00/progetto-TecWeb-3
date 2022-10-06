<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "UPDATE `user` SET `email`=?, `username`=?, `password`=? WHERE `username`=?";
return $connection->query(
    $query,
    $_POST["email"],
    $_POST["username"],
    $_POST["password"],
    $_SESSION["username"]
);

?>