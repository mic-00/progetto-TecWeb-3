<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT dispositivi.identificativo , dispositivi.prezzo
		  FROM `DISPOSITIVI`";
$result = $connection->query($query);

return $result;

?>