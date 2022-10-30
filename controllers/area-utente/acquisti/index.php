<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {

        $models = include ROOT . "/models/area-utente/acquisti/index.php";
        if (is_array($models)) {
            $modelsHTML = "";
            $caption = "<caption>Lista degli acquisti</caption>";
           $head = "<tr class='userItemsHead'>
                     <th scope='col' class='purchaseItemModel'>Modello Prodotto</th>
                     <th scope='col' class='purchaseItemDescription'>Descrizione</th>
                     <th scope='col' class='purchaseItemPrice'>Prezzo</th>
                   </tr>";
            foreach ($models as $model) {
                $name = "{$model["brand"]} {$model["model"]}";
                $price = $model["price"];
                $description = $model["description"];
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
                        "%%DESCRIPTION%%" => $description
                        //"%%IMAGE%%" => $image
                    ],
                    file_get_contents(ROOT . "/views/area-utente/acquisti/item.html")
                );
            }
            return [
                UtilityFunctions::replace(
                    [ "%%ITEM%%" => $modelsHTML,
                      "%%HEADER%%" => $head,
                      "%%CAPTION%%" => $caption,
                      "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-utente/sidebar.html")
                    ],
                    file_get_contents(ROOT . "/views/area-utente/acquisti/index.html")
                ),
                "Visualizza i tuoi Acquisti.",
                ""
            ];
        } else { //parte ancora da provare
            $alert = "<P>Non hai acquisti</p>";
            return [
                UtilityFunctions::replace(
                    [ "%%ITEM%%" => $alert],
                    file_get_contents(ROOT . "/views/area-utente/riparazioni/index.html")
                ),
                "Visualizza i tuoi acquisti.",
                ""
            ];
        }

}

header("Location: /login?redirect=/area-utente/acquisti");

?>
