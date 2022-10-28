<?php

use Utils\UtilityFunctions;

$items = include ROOT . "/models/negozio/index.php";

if (isset($_GET["id"])) {
    $name = $error = $price = $description = $image = $specs = $link = "";
    if (isset($items[0])) {
        $item = $items[0];
        $id = $item["id"];
        $name = "{$item["brand"]} {$item["model"]}";
        $price = "{$item["price"]}&euro;";
        $description = $item["description"];
        if (glob(ROOT . "/public/img/purchase/$id.*")) {
            $extension = pathinfo(glob(ROOT . "/public/img/purchase/$id.*")[0], PATHINFO_EXTENSION);
            $image = "<img src='/public/img/purchase/$id.$extension' alt='' />";
        }
        $releasedAt = $item["released_at"];
        $os = $item["os"];
        $displaySize = $item["display_size"] . " <abbr title='pollici'>in</abbr>";
        $displayResolution = $item["display_resolution"];
        $cameraPixels = $item["camera_pixels"] . " <abbr title='megapixel'>MP</abbr>";
        $chipset = $item["chipset"];
        $batterySize = $item["battery_size"] . " <abbr title='milliamperora'>mAh</abbr>";
        $batteryType = $item["battery_type"];
        $bluetooth = $item["bluetooth"];
        $sim = $item["sim"];
        $gps = $item["gps"];
        $weight = $item["weight"] . " <abbr title='grammi'>gr</abbr>";
        $dimensions = $item["dimensions"] . " <abbr title='millimetri'>mm</abbr>";
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
            ? "<a class='button danger' href='/carrello/rimuovi?id=$id'>Rimuovi dal carrello</a>"
            : "<a class='button' href='/carrello/aggiungi?id=$id'>Aggiungi al carrello</a>";
    } else {
        $error = "Il prodotto che stai cercando non esiste.";
    }
    return [
        UtilityFunctions::replace(
            [
                "%%NAME%%" => $name,
                "%%ERROR%%" => $error,
                "%%PRICE%%" => $price,
                "%%DESCRIPTION%%" => $description,
                "%%IMAGES%%" => $image,
                "%%SPECS%%" => $specs,
                "%%LINK%%" => $link
            ],
            file_get_contents(ROOT . "/views/negozio/id/index.html")
        ),
        "",
        ""
    ];
} else {
    $itemsHTML = "";
    foreach ($items as $item) {
        $id = $item["id"];
        $image = "";
        if (glob(ROOT . "/public/img/purchase/$id.*")) {
            $extension = pathinfo(glob(ROOT . "/public/img/purchase/$id.*")[0], PATHINFO_EXTENSION);
            $image = "<img src='/public/img/purchase/$id.$extension' alt='' aria-describedby='description-$id' />";
        } else {
            $image = "<img src='/public/img/common.jpg' alt='' aria-describedby='description-$id' />";
        }
        $name = "<a href='/negozio?id={$item["id"]}'>{$item["brand"]} {$item["model"]}</a>";
        $price = "{$item["price"]}&euro;";
        $description = $item["description"];
        $itemsHTML .= UtilityFunctions::replace(
            [
                "%%IMAGE%%" => $image,
                "%%NAME%%" => $name,
                "%%PRICE%%" => $price,
                "%%DESCRIPTION%%" => $description,
                "%%ID%%" => $id
            ],
            file_get_contents("./views/negozio/item.html")
        );
    }
    return [
        UtilityFunctions::replace(
            [
                "%%ITEMS%%" => $itemsHTML
            ],
            file_get_contents(ROOT . "/views/negozio/index.html")
        ),
        "Dispositivi elettronici usati come nuovi e a prezzi da urlo! Approfittane subito.",
        "negozio, articoli"
    ];
}

?>
