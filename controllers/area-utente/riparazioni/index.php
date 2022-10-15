<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {

        $models = include ROOT . "/models/area-utente/riparazioni/index.php";
        if (is_array($models)) {
            $modelsHTML = "";
            foreach ($models as $model) {
                $name = "{$model["brand"]} {$model["model"]}";
                $price = $model["cost"];
                $description = $model["description"];
                $date = $model["date"];
                if($model["repaired"] == "1")
                  $repaired = "Riparazione Completata";
                else
                  $repaired = "In attesa di riparazione";
                  $id = $model["id"];
                  if(file_exists(ROOT . "/public/img/purchase/$id/1.jpg")){
                    $src = "/public/img/purchase/$id/1.jpg";
                  } else {
                    $src = "/public/img/common.jpg";
                  }
                  $image = "<img src='$src' alt='' />";
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
                    [ "%%ITEM%%" => $modelsHTML ],
                    file_get_contents(ROOT . "/views/area-utente/riparazioni/index.html")
                ),
                "Visualizza le tue Riparazioni.",
                ""
            ];
        }

}

header("Location: /login");

?>
