<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    if ($_SESSION["admin"]) {
        $repairs = include ROOT . "/models/area-amministratore/gestione-riparazioni/index.php";
        if (isset($_GET["id"])) {
            $repair = $repairs[0];
            if (isset($repair)) {
                $id = $repair["id"];
                $name = "{$repair["brand"]} {$repair["model"]}";
                $description = $repair["description"];
                $releasedAt = $repair["released_at"];
                $os = $repair["os"];
                $displaySize = $repair["display_size"];
                $displayResolution = $repair["display_resolution"];
                $cameraPixels = $repair["camera_pixels"];
                $chipset = $repair["chipset"];
                $batterySize = $repair["battery_size"];
                $batteryType = $repair["battery_type"];
                $bluetooth = $repair["bluetooth"];
                $sim = $repair["sim"];
                $gps = $repair["gps"];
                $weight = $repair["weight"] . " gr";
                $dimensions = $repair["dimensions"] . " mm";
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
                            "%%DESCRIPTION%%" => $description,
                            "%%ID%%" => $id,
                            "%%SPECS%%" => $specs
                        ],
                        file_get_contents(ROOT . "/views/area-amministratore/gestione-riparazioni/id/index.html")
                    ),
                    "",
                    ""
                ];
            } else {
                header("Location: /area-amministratore/gestione-riparazioni");
            }
        } else {
            $repairsHTML = "";
            foreach ($repairs as $repair) {
                $id = $repair["id"];
                $repairsHTML .= UtilityFunctions::replace(
                    [ "%%ID%%" => $id ],
                    file_get_contents(ROOT . "/views/area-amministratore/gestione-riparazioni/repair.html")
                );
            }
            return [
                UtilityFunctions::replace(
                    [
                        "%%REPAIRS%%" => $repairsHTML,
                        "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-amministratore/sidebar.html")
                    ],
                    file_get_contents(ROOT . "/views/area-amministratore/gestione-riparazioni/index.html")
                ),
                "",
                "preventivo, riparazioni"
            ];
        }
    } else {
        header("Location: /area-utente/informazioni-personali");
    }
}

?>