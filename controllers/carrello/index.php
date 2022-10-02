<?php

use Utils\UtilityFunctions;

$description = "";
$keywords = "carrello";

if (isset($_SESSION["shoppingCartItems"])) {
    $items = $_SESSION["shoppingCartItems"];
    $itemsHTML = "";
    $amount = 0;
    foreach ($items as $id) {
        /// get item by id from db
        $itemsHTML .= UtilityFunctions::replace(
            [
                "%%IMAGE%%" => "<img src='{$item["imgSrc"]}' alt='' />",
                "%%NAME%%" => $item["name"],
                "%%DESCRIPTION%%" => $item["description"],
                "%%PRICE%%" => $item["price"]
            ],
            file_get_contents(ROOT . "/views/carrello/shopping-cart-item.html")
        );
        $amount += $item["price"];
    }
    $main = UtilityFunctions::replace(
        [
            "%%SHOPPINGCARTITEMS%%" => $itemsHTML,
            "%%AMOUNT%%" => "$amount&euro;"
        ],
        file_get_contents(ROOT . "/views/carrello/index.html")
    );
} else {
    $main = UtilityFunctions::replace(
        [
            "%%SHOPPINGCARTITEMS%%" => "<p>Nessun articolo è stato selezionato. Per visionare i nostri prodotti, clicca <a href='../acquisto'>qui</a>.</a></p>",
            "%%AMOUNT%%" => ""
        ],
        file_get_contents(ROOT . "/views/carrello/index.html")
    );
}

return [ $main, $description, $keywords ];

?>