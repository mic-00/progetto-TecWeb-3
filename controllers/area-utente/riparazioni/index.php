<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {

        $models = include ROOT . "/models/area-utente/riparazioni/index.php";
        if (is_array($models)) {
            $modelsHTML = "";
            $head = "<li class='userItemsHead'>
                      <p class='repairItemModel'>Modello Prodotto</p>
                      <p class='repairItemDescription'>Descrizione</p>
                      <p class='repairItemPrice'>Costo</p>
                      <p class='repairItemStart'>Data inizio</p>
                      <p class='repairItemEnd'>Data fine</p>
                    </li>";
            foreach ($models as $model) {
                $name = "{$model["brand"]} {$model["model"]}";
                $price = $model["cost"];
                $description = $model["description"];
                $date = $model["start"];
                if(!$model["expected_time"])
                  $repaired = "In attesa di riparazione";
                else
                  $repaired = "Riparazione Completata";
                $id = $model["id"];
                if(file_exists(ROOT . "/public/img/repair/$id/1.jpg")){
                  $src = "/public/img/purchase/$id/1.jpg";
                  $alt = $model["img_alt"];
                } else {
                  $src = "/public/img/common.jpg";
                  $alt = "computer con schermo acceso, mouse e tastiera";
                }
                $image = "<img src='$src' alt='$alt' />";
                $modelsHTML .= UtilityFunctions::replace(
                    [
                        "%%NAME%%" => $name,
                        "%%PRICE%%" => $price,
                        "%%DESCRIPTION%%" => $description,
                        "%%DATE%%" => $date,
                        "%%REPAIRED%%" => $repaired,
                        "%%IMAGE%%" => $image
                    ],
                    file_get_contents(ROOT . "/views/area-utente/riparazioni/item.html")
                );
            }
            return [
                UtilityFunctions::replace(
                    [ "%%ITEM%%" => $modelsHTML,
                      "%%HEADER%%" => $head,
                      "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-utente/sidebar.html")
                    ],
                    file_get_contents(ROOT . "/views/area-utente/riparazioni/index.html")
                ),
                "Visualizza le tue Riparazioni.",
                ""
            ];
        }else{//parte ancora da provare
          $alert = "<P>Non hai richiesto riparazioni</p>";
          UtilityFunctions::replace(
              [ "%%ITEM%%" => $alert],
              file_get_contents(ROOT . "/views/area-utente/riparazioni/index.html")
          ),
          "Visualizza le tue Riparazioni.",
          ""
        }

}

header("Location: /login");

?>
