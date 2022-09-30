<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT * FROM `UTENTE` WHERE `email`=? AND `password`=?";
$result = $connection->query($query, $_POST["email"], $_POST["password"]);

return count($result);

?>