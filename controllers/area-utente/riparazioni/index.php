<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {

        $models = include ROOT . "/models/area-utente/riparazioni/index.php";
        if (is_array($models)) {
            $modelsHTML = "";
            $caption = "<caption>Lista delle riparazioni</caption>";
            $head = "<tr class='userItemsHead'>
                      <th scope='col' class='repairItemModel'>Modello Prodotto</th>
                      <th scope='col' class='repairItemDescription'>Descrizione</th>
                      <th scope='col' class='repairItemPrice'>Costo</th>
                      <th scope='col' class='repairItemStart'>Data inizio</th>
                      <th scope='col' class='repairItemEnd'>Data fine</th>
                    </tr>";
            foreach ($models as $model) {
                $name = "{$model["brand"]} {$model["model"]}";
                $price = $model["cost"];
                $description = $model["description"];
                $date = $model["start"];
                if (!$model["expected_time"])
                    $repaired = "In attesa di riparazione";
                else
                    $repaired = "Riparazione Completata";
                $id = $model["id"];
                if ((glob(ROOT . "/public/img/purchase/$id.*"))) {
                    $extension = pathinfo(glob(ROOT . "/public/img/purchase/$id.*")[0], PATHINFO_EXTENSION);
                    $image = "<img src='/public/img/purchase/$id.$extension' alt='{$model["img_alt"]}' />";
                } else {
                    $image = "<img src='/public/img/common.jpg' alt='Immagine generica di smartphone.' />";
                }
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
                      "%%CAPTION%%" => $caption,
                      "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-utente/sidebar.html")
                    ],
                    file_get_contents(ROOT . "/views/area-utente/riparazioni/index.html")
                ),
                "Visualizza le tue Riparazioni.",
                ""
            ];
        } else {//parte ancora da provare
            $alert = "<P>Non hai richiesto riparazioni</p>";
            return [
                UtilityFunctions::replace(
                    [ "%%ITEM%%" => $alert],
                    file_get_contents(ROOT . "/views/area-utente/riparazioni/index.html")
                ),
                "Visualizza le tue riparazioni.",
                ""
            ];
        }
}

header("Location: " . SUBFOLDER . "/login?redirect=/area-utente/riparazioni");

?>
