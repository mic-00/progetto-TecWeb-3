<?php

require_once "../config/config.php";
require_once ROOT . "/utils/DBConnection.php";

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `name` FROM `brand` GROUP BY `name` ORDER BY `name`";

echo json_encode(
    array_map(
        function ($b) { return $b["name"]; },
        $connection->query($query)
    ));

?>