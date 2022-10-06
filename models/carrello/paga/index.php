<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SET autocommit=0";
$connection->query($query);

foreach ($_SESSION["cart"] as $item) {
    $query = "UPDATE `purchase_item` SET `user`=? WHERE `id`=?";
    $result = $connection->query($query, $_SESSION["username"], $item);
    if ($result === false) {
        $query = "ROLLBACK; SET autocommit=ON";
        $connection->query($query);
        return false;
    }
}
$query = "COMMIT";
$connection->query($query);
$query = "SET autocommit=1";
$connection->query($query);
return true;

?>