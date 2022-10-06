<?php

use Utils\UtilityFunctions;

if (isset($_GET["id"])) {
    $item = include ROOT . "/models/acquisto/id.php";
    $id = $item["id"];
    $name = "{$item["brand"]} {$item["device"]}";
    $price = "{$item["price"]}&euro;";
    $images = "";
    for ($i = 1; file_exists(ROOT . "/public/img/purchase/$id/$i.jpg"); ++$i) {
        $src = "/public/img/purchase/$id/$i.jpg";
        $images .= "<img src='$src' alt='' />";
        // TODO aggiungere alt!!!!!
    }
    $displaySize = $item["display_size"];
    $displayResolution = $item["display_resolution"];
    $cameraPixels = $item["camera_pixels"];
    $chipset = $item["chipset"];
    $batterySize = $item["battery_size"];
    $batteryType = $item["battery_type"];
    $link = isset($_SESSION["cart"]) && in_array($id, $_SESSION["cart"])
        ? "<a href='/carrello/rimuovi?id=$id'>Rimuovi dal carrello</a>"
        : "<a href='/carrello/aggiungi?id=$id'>Aggiungi al carrello</a>";
    return [
        UtilityFunctions::replace(
            [
                "%%NAME%%" => $name,
                "%%PRICE%%" => $price,
                "%%IMAGES%%" => $images,
                "%%DISPLAY_SIZE%%" => $displaySize,
                "%%DISPLAY_RESOLUTION%%" => $displayResolution,
                "%%CAMERA_PIXELS%%" => $cameraPixels,
                "%%CHIPSET%%" => $chipset,
                "%%BATTERY_SIZE%%" => $batterySize,
                "%%BATTERY_TYPE%%" => $batteryType,
                "%%LINK%%" => $link
            ],
            file_get_contents(ROOT . "/views/acquisto/id/index.html")
        ),
        "",
        ""
    ];
} else {
    $items = include ROOT . "/models/acquisto/index.php";
    $itemsHTML = "";
    foreach ($items as $item) {
        $id = $item["id"];
        $image = "";
        if (file_exists(ROOT . "/public/img/purchase/$id/1.jpg")) {
            $src = "/public/img/purchase/$id/1.jpg";
            $image = "<img src='$src' width='200' height='200' />";
        }
        $name = "<a href='/acquisto?id={$item["id"]}'>{$item["brand"]} {$item["device"]}</a>";
        $price = "{$item["price"]}&euro;";
        $itemsHTML .= UtilityFunctions::replace(
            [
                "%%IMAGE%%" => $image,
                "%%NAME%%" => $name,
                "%%PRICE%%" => $price
            ],
            file_get_contents("./views/acquisto/item.html")
        );
    }
    return [
        UtilityFunctions::replace(
            [ "%%ITEMS%%" => $itemsHTML ],
            file_get_contents(ROOT . "/views/acquisto/index.html")
        ),
        "Dispositivi elettronici usati come nuovi e a prezzi da urlo! Approfittane subito.",
        "acquisto, articoli"
    ];
}

?>