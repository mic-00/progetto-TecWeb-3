<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `modello`.`brand` AS `brand`,
          `modello`.`model` AS `model`,
          `modello`.`id` AS `id`,
          `purchase_item`.`description`,
          `purchase_item`.`price`
          FROM (SELECT `brand`.`name` AS `brand`,
                       `model`.`name` AS `model`,
                       `model`.`id`
                       FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand`) AS `modello`
               JOIN `purchase_item` ON `modello`.`id`=`purchase_item`.`model`
          WHERE `user`=?";
return $connection->query($query,
  $_SESSION["username"]
);
?>
