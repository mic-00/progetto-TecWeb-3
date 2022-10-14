<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `brand`.`name` AS `brand`, `model`.`name` AS `model`, `model`.`id` AS `id` FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand` ORDER BY `brand`.`name`, `model`.`name`";
return $connection->query($query);

?>