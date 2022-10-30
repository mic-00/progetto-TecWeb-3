<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {

        $models = include ROOT . "/models/area-utente/acquisti/index.php";
        if (is_array($models)) {
            $modelsHTML = "";
            foreach ($models as $model) {
                $name = "{$model["brand"]} {$model["model"]}";
                $price = $model["price"];
                $description = $model["description"];
                $id = $model["id"];
                $modelsHTML .= UtilityFunctions::replace(
                    [
                        "%%NAME%%" => $name,
                        "%%PRICE%%" => $price,
                        "%%DESCRIPTION%%" => $description
                    ],
                    file_get_contents(ROOT . "/views/area-utente/acquisti/item.html")
                );
            }
            return [
                UtilityFunctions::replace(
                    [ "%%ITEM%%" => $modelsHTML,
                      "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-utente/sidebar.html")
                    ],
                    file_get_contents(ROOT . "/views/area-utente/acquisti/index.html")
                ),
                "Visualizza i tuoi Acquisti.",
                ""
            ];
        }

} else {
    header("Location: " . SUBFOLDER . "/login?redirect=/area-utente/acquisti");
}

?>
