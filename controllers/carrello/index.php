<?php

use Utils\UtilityFunctions;

$description = "";
$keywords = "carrello";

if (isset($_SESSION["cart"]) && count($_SESSION["cart"])) {
    $cartItems = include ROOT . "/models/carrello/index.php";
    $cartItemsHTML = "";
    $amount = 0;
    foreach ($cartItems as $cartItem) {
        $name = "<a href='/acquisto?id={$cartItem["id"]}'>{$cartItem["brand"]} {$cartItem["model"]}</a>";
        $price = $cartItem["price"];
        $id = $cartItem["id"];
        $cartItemsHTML .= UtilityFunctions::replace(
            [
                "%%NAME%%" => $name,
                "%%PRICE%%" => $price,
                "%%ID%%" => $id
            ],
            file_get_contents(ROOT . "/views/carrello/cart-item.html")
        );
        $amount += $price;
    }
    $cartItemsHTML = "<ul>$cartItemsHTML</ul>";
    $main = UtilityFunctions::replace(
        [
            "%%SHOPPINGCARTITEMS%%" => $cartItemsHTML,
            "%%AMOUNT%%" => $amount
        ],
        file_get_contents(ROOT . "/views/carrello/index.html")
    );
} else {
    $main = UtilityFunctions::replace(
        [
            "%%SHOPPINGCARTITEMS%%" => "<p>Nessun articolo è stato selezionato. Per visionare i nostri prodotti, clicca <a href='../acquisto'>qui</a>.</a></p>",
            "%%AMOUNT%%" => 0
        ],
        file_get_contents(ROOT . "/views/carrello/index.html")
    );
}

return [ $main, $description, $keywords ];

?>