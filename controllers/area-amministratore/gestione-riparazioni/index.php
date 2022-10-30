<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    if ($_SESSION["admin"]) {
        $repairs = include ROOT . "/models/area-amministratore/gestione-riparazioni/index.php";
        if (isset($_GET["id"])) {
            $repair = $repairs[0];
            if (isset($repair)) {
                if (isset($_POST["cost"], $_POST["time"])) {
                    $update = include ROOT . "/models/area-amministratore/gestione-riparazioni/update.php";
                    header("Location: " . SUBFOLDER . "/area-amministratore/gestione-riparazioni");
                } else {
                    $id = $repair["id"];
                    $image = "";
                    if (glob( ROOT . "/public/img/repair/$id.*")) {
                        $extension = pathinfo(glob( ROOT . "/public/img/repair/$id.*")[0], PATHINFO_EXTENSION);
                        $image = "<img src='/public/img/repair/$id.$extension' alt='{$repair["img_alt"]}' />";
                    }
                    $name = "{$repair["brand"]} {$repair["model"]}";
                    $description = $repair["description"];
                    $releasedAt = $repair["released_at"];
                    $os = "<span lang='en'>{$repair["os"]}</span>";
                    $displaySize = $repair["display_size"] . " <abbr title='pollici'>in</abbr>";
                    $displayResolution = $repair["display_resolution"];
                    $cameraPixels = $repair["camera_pixels"] . " <abbr title='megapixel'>MP</abbr>";
                    $chipset = "<span lang='en'>{$repair["chipset"]}</span>";
                    $batterySize = $repair["battery_size"] . " <abbr title='milliamperora'>mAh</abbr>";
                    $batteryType = $repair["battery_type"];
                    $bluetooth = $repair["bluetooth"];
                    $sim = $repair["sim"];
                    $gps = $repair["gps"];
                    $weight = $repair["weight"] . " <abbr title='grammi'>gr</abbr>";
                    $dimensions = $repair["dimensions"] . " <abbr title='millimetri'>mm</abbr>";
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
                                "%%ID%%" => $id,
                                "%%NAME%%" => $name,
                                "%%DESCRIPTION%%" => $description,
                                "%%IMAGE%%" => $image,
                                "%%SPECS%%" => $specs
                            ],
                            file_get_contents(ROOT . "/views/area-amministratore/gestione-riparazioni/id/index.html")
                        ),
                        "",
                        ""
                    ];
                }
            } else {
                header("Location: " . SUBFOLDER . "/area-amministratore/gestione-riparazioni");
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
        header("Location: " . SUBFOLDER . "/area-utente/informazioni-personali");
    }
} else {
    header("Location: " . SUBFOLDER . "/login?redirect=/area-amministratore/gestione-riparazioni");
}

?>