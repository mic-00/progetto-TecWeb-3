<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT * FROM `DISPOSITIVI` WHERE `identificativo`=?";
$result = $connection->query($query, $_POST['identificativo']);

return $result;

?>
