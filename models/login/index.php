<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT * FROM `UTENTE` WHERE `username`=? AND `password`=?";
$result = $connection->query($query, $_POST["username"], $_POST["password"])[0];

return $result;

?>