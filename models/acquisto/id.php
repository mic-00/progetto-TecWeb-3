<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `brands`.`name` AS `brand`, `devices`.`name` AS `device`, `purchase_item`.`id` AS `id`, `display_size`, `display_resolution`, `camera_pixels`, `ram`, `chipset`, `battery_size`, `battery_type`, `specifications`, `price` " .
    "FROM `brands` JOIN `devices` ON `brands`.`id`=`devices`.`brand` " .
    "JOIN `purchase_item` ON `devices`.`id`=`purchase_item`.`device` " .
    "WHERE `purchase_item`.`id`=?";

return $connection->query($query, $_GET["id"])[0] ?? null;

?>