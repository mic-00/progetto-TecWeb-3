<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    $models = include ROOT . "/models/area-utente/riparazioni/index.php";
    if (is_array($models)) {
        $modelsHTML = "";
        foreach ($models as $model) {
            $name = "{$model["brand"]} {$model["model"]}";
            $description = $model["description"];
            $price = $repaired = "";
            if (!isset($model["cost"]))
                $price = "In attesa di valutazione";
            else
                $price = "{$model["cost"]}&euro;";
            if (!isset($model["expected_time"]))
                $repaired = "In attesa di valutazione";
            else
                $repaired = "{$model["expected_time"]} giorni";
            $id = $model["id"];
            $modelsHTML .= UtilityFunctions::replace(
                [
                    "%%NAME%%" => $name,
                    "%%PRICE%%" => $price,
                    "%%DESCRIPTION%%" => $description,
                    "%%REPAIRED%%" => $repaired
                ],
                file_get_contents(ROOT . "/views/area-utente/riparazioni/item.html")
            );
        }
        return [
            UtilityFunctions::replace(
                [
                    "%%ITEM%%" => $modelsHTML,
                    "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-utente/sidebar.html")
                ],
                file_get_contents(ROOT . "/views/area-utente/riparazioni/index.html")
            ),
            "Visualizza le tue riparazioni.",
            ""
        ];
    }
} else {
    header("Location: " . SUBFOLDER . "/login?redirect=/area-utente/riparazioni");
}

?>
