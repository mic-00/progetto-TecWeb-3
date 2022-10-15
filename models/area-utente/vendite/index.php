<?php

use DB\DBConnection;

$connection = new DBConnection();

$query = "SELECT `modello`.`brand` AS `brand`,
          `modello`.`model` AS `model`,
          `modello`.`id` AS `id`,
          `sell_item`.`price`
          FROM (SELECT `brand`.`name` AS `brand`,
                       `model`.`name` AS `model`,
                       `model`.`id`
                       FROM `brand` JOIN `model` ON `brand`.`id`=`model`.`brand`) AS `modello`
               JOIN `sell_item` ON `modello`.`id`=`sell_item`.`model`
          WHERE `user`=?";
return $connection->query($query,
  $_SESSION["username"]
);

?>
