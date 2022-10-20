<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {

        $models = include ROOT . "/models/area-utente/vendite/index.php";
        if (is_array($models)) {
            $modelsHTML = "";
            foreach ($models as $model) {
                $name = "{$model["brand"]} {$model["model"]}";
                $price = $model["price"];
                $id = $model["id"];
                /*if(file_exists(ROOT . "/public/img/purchase/$id/1.jpg")){
                  $src = "/public/img/purchase/$id/1.jpg";
                } else {
                  $src = "/public/img/common.jpg";
                }
                $image = "<img src='$src' alt='' />";*/
                $modelsHTML .= UtilityFunctions::replace(
                    [
                        "%%NAME%%" => $name,
                        "%%PRICE%%" => $price,
                        //"%%IMAGE%%" => $image
                    ],
                    file_get_contents(ROOT . "/views/area-utente/vendite/item.html")
                );
            }
            return [
                UtilityFunctions::replace(
                    [ "%%ITEM%%" => $modelsHTML,
                      "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-utente/sidebar.html")
                    ],
                    file_get_contents(ROOT . "/views/area-utente/vendite/index.html")
                ),
                "Visualizza le tue Vendite.",
                ""
            ];
        }

}

header("Location: /login");

?>
