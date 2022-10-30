<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    if ($_SESSION["admin"]) {
        if (isset($_GET["id"])) {
            $model = include ROOT . "/models/area-amministratore/gestione-modelli/id/index.php";
            $id = $model["id"];
            $name = "{$model["brand"]} {$model["model"]}";
            $releasedAt = $model["released_at"];
            $os = $model["os"];
            $displaySize = $model["display_size"];
            $displayResolution = $model["display_resolution"];
            $cameraPixels = $model["camera_pixels"];
            $chipset = $model["chipset"];
            $batterySize = $model["battery_size"];
            $batteryType = $model["battery_type"];
            $bluetooth = $model["bluetooth"];
            $sim = $model["sim"];
            $gps = $model["gps"];
            $weight = $model["weight"] . " gr";
            $dimensions = $model["dimensions"] . " mm";
            $specs = UtilityFunctions::replace(
                [
                    "%%RELEASED_AT%%" => $releasedAt,
                    "%%OS%%" => $os,
                    "%%DISPLAY_SIZE%%" => $displaySize,
                    "%%DISPLAY_RESOLUTION%%" => $displayResolution,
                    "%%CAMERA_PIXELS%%" => $cameraPixels,
                    "%%CHIPSET%%" => $chipset,
                    "%%BATTERY_SIZE%%" => $batterySize,
                    "%%BATTERY_TYPE%%" => $batteryType,
                    "%%BLUETOOTH%%" => $bluetooth,
                    "%%SIM%%" => $sim,
                    "%%GPS%%" => $gps,
                    "%%WEIGHT%%" => $weight,
                    "%%DIMENSIONS%%" => $dimensions,
                ],
                file_get_contents(ROOT . "/views/device-specs.html")
            );
            return [
                UtilityFunctions::replace(
                    [
                        "%%NAME%%" => $name,
                        "%%SPECS%%" => $specs,
                        "%%ID%%" => $id
                    ],
                    file_get_contents(ROOT . "/views/area-amministratore/gestione-modelli/id/index.html")
                ),
                "",
                ""
            ];
        } else {
            list($currentPage, $models) = include ROOT . "/models/area-amministratore/gestione-modelli/index.php";
            $modelsHTML = "";
            foreach ($models as $model) {
                $name = "{$model["brand"]} {$model["model"]}";
                $id = $model["id"];
                $modelsHTML .= UtilityFunctions::replace(
                    [
                        "%%NAME%%" => $name,
                        "%%ID%%" => $id
                    ],
                    file_get_contents(ROOT . "/views/area-amministratore/gestione-modelli/model.html")
                );
            }
            return [
                UtilityFunctions::replace(
                    [
                        "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-amministratore/sidebar.html"),
                        "%%CURRENT_PAGE%%" => $currentPage,
                        "%%MODELS%%" => $modelsHTML
                    ],
                    file_get_contents(ROOT . "/views/area-amministratore/gestione-modelli/index.html")
                ),
                "Visualizza, aggiungi e rimuovi modelli.",
                ""
            ];
        }
    } else {
        header("Location: " . SUBFOLDER . "/area-utente/informazioni-personali");
    }
} else {
    header("Location: " . SUBFOLDER . "/login?redirect=/area-amministratore/gestione-modelli");
}

?>