<?php

use DB\DBConnection;

$connection = new DBConnection();

if (!isset($_POST["email"], $_POST["password"]))
    return false;

$query = "SELECT * FROM `UTENTE` WHERE `email`=? AND `password`=?";
$result = $connection->query($query, $_POST["email"], $_POST["password"]);

return count($result);

?>