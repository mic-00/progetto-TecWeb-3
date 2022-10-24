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
        $description = $cartItem["description"];
        if(file_exists(ROOT . "/public/img/purchase/$id.jpg")) {
            $image = "<img src='/public/img/purchase/$id.jpg' alt='' />";
        } else {
            $image = "<img src='/public/img/common.jpg' alt='' />";
        }
        $cartItemsHTML .= UtilityFunctions::replace(
            [
                "%%NAME%%" => $name,
                "%%PRICE%%" => $price,
                "%%ID%%" => $id,
                "%%DESCRIPTION%%" => $description,
                "%%IMG%%" => $image
            ],
            file_get_contents(ROOT . "/views/carrello/cart-item.html")
        );
        $amount += $price;
    }
    $main = UtilityFunctions::replace(
        [
            "%%ERROR%%" => "",
            "%%SHOPPINGCARTITEMS%%" => $cartItemsHTML,
            "%%AMOUNT%%" => $amount
        ],
        file_get_contents(ROOT . "/views/carrello/index.html")
    );
} else {
    $main = UtilityFunctions::replace(
        [
            "%%ERROR%%" => "<p>Nessun articolo è stato selezionato. Per visionare i nostri prodotti, clicca <a href='/acquisto'>qui</a>.</a></p>",
            "%%SHOPPINGCARTITEMS%%" => "",
            "%%AMOUNT%%" => 0
        ],
        file_get_contents(ROOT . "/views/carrello/index.html")
    );
}

return [ $main, $description, $keywords ];

?>
