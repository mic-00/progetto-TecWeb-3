<?php

use Utils\UtilityFunctions;

$items = include ROOT . "/models/acquisto/index.php";

if (isset($_GET["id"])) {
    if (isset($items[0])) {
        $item = $items[0];
        $id = $item["id"];
        $name = "{$item["brand"]} {$item["model"]}";
        $price = $item["price"];
        $description = $item["description"];
        $images = "";
        for ($i = 1; file_exists(ROOT . "/public/img/purchase/$id/$i.jpg"); ++$i) {
            $src = "/public/img/purchase/$id/$i.jpg";
            $images .= "<img src='$src' alt='' />";
            // TODO aggiungere alt!!!!!
        }
        $releasedAt = $item["released_at"];
        $os = $item["os"];
        $displaySize = $item["display_size"];
        $displayResolution = $item["display_resolution"];
        $cameraPixels = $item["camera_pixels"];
        $chipset = $item["chipset"];
        $batterySize = $item["battery_size"];
        $batteryType = $item["battery_type"];
        $bluetooth = $item["bluetooth"];
        $sim = $item["sim"];
        $gps = $item["gps"];
        $weight = $item["weight"] . " gr";
        $dimensions = $item["dimensions"] . " mm";
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
        $link = isset($_SESSION["cart"]) && in_array($id, $_SESSION["cart"])
            ? "<a class='button' href='/carrello/rimuovi?id=$id'>Rimuovi dal carrello</a>"
            : "<a class='button' href='/carrello/aggiungi?id=$id'>Aggiungi al carrello</a>";
        return [
            UtilityFunctions::replace(
                [
                    "%%NAME%%" => $name,
                    "%%PRICE%%" => $price,
                    "%%DESCRIPTION%%" => $description,
                    "%%IMAGES%%" => $images,
                    "%%SPECS%%" => $specs,
                    "%%LINK%%" => $link
                ],
                file_get_contents(ROOT . "/views/acquisto/id/index.html")
            ),
            "",
            ""
        ];
    } else {
        // TODO
    }
} else {
    $itemsHTML = "";
    foreach ($items as $item) {
        $id = $item["id"];
        $image = "";
        if (file_exists(ROOT . "/public/img/purchase/$id/1.jpg")) {
            $src = "/public/img/purchase/$id/1.jpg";
            $image = "<img src='$src' width='200' height='200' />";
        }
        $name = "<a href='/acquisto?id={$item["id"]}'>{$item["brand"]} {$item["model"]}</a>";
        $price = "{$item["price"]}&euro;";
        $description = $item["description"];
        $itemsHTML .= UtilityFunctions::replace(
            [
                "%%IMAGE%%" => $image,
                "%%NAME%%" => $name,
                "%%PRICE%%" => $price,
                "%%DESCRIPTION%%" => $description
            ],
            file_get_contents("./views/acquisto/item.html")
        );
    }
    return [
        UtilityFunctions::replace(
            [
                "%%ITEMS%%" => $itemsHTML
            ],
            file_get_contents(ROOT . "/views/acquisto/index.html")
        ),
        "Dispositivi elettronici usati come nuovi e a prezzi da urlo! Approfittane subito.",
        "acquisto, articoli"
    ];
}

?>