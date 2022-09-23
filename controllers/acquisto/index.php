<?php

use Utils\UtilityFunctions;

if (isset($_GET["itemId"])) {
    // ritorna la pagina corrispondente a quel prodotto
    //$id = $_GET["item-id"];
    //$item = $db->getItem($id);
    //$name = $item["name"];
    //...
    //...
    $name = "PS4";
    return [
        UtilityFunctions::replace(
            [
                "%%NAME%%" => $name,
                "%%DESCRIPTION%%" => "PlayStation 4 del 2018 usata.",
                "%%PRICE%%" => "199.99&euro;"
            ],
            file_get_contents(ROOT . "/views/acquisto/item-id/index.html")
        ),
        "Tutte le informazioni sull'articolo $name",
        $name
    ];
} else {
    // ritorna la pagina con tutti i prodotti
    //$items = $db->getItems();
    //...
    $items = [
        [ "name" => "PS4", "description" => "PlayStation 4 del 2018 usata.", "price" => "199.99&euro;" ]
    ];
    $itemsHTML = "";
    foreach ($items as $item) {
        $itemsHTML .= UtilityFunctions::replace(
            [
                "%%NAME%%" => $item["name"],
                "%%DESCRIPTION%%" => $item["description"],
                "%%PRICE%%" => $item["price"]
            ],
            file_get_contents("./views/acquisto/item.html")
        );
    }
    return [
        UtilityFunctions::replace(
            [ "%%ITEMS%%" => $itemsHTML ],
            file_get_contents(ROOT . "/views/acquisto/index.html")
        ),
        "Dispositivi elettronici usati come nuovi e a prezzi da urlo! Approfitta subito degli ultimi sconti in scadenza.",
        "acquisto, articoli"
    ];
}

?>