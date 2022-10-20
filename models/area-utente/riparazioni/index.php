<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `modello`.`brand` AS `brand`,
          `modello`.`model` AS `model`,
          `modello`.`id` AS `id`,
          `repair_item`.`description`,
          `repair_item`.`start`,
          `repair_item`.`cost`,
          `repair_item`.`expected_time`,
          `repair_item`.`img_alt`
          FROM (SELECT `brand`.`name` AS `brand`,
                       `model`.`name` AS `model`,
                       `model`.`id` AS `id`
                       FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand`) AS `modello`
               JOIN `repair_item` ON `modello`.`id`=`repair_item`.`model`
          WHERE `user`=?";
return $connection->query($query,
  $_SESSION["username"]
);

?>
