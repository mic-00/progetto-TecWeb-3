<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "DELETE FROM `user` WHERE `username`=?";
return $connection->query($query, $_SESSION["username"]);

?>