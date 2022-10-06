<?php

if (isset($_GET["id"])) {
    if (!isset($_SESSION["cart"]))
        $_SESSION["cart"] = [];
    $itemExists = include ROOT . "models/carrello/aggiungi/index.php";
    if ($itemExists) {
        $_SESSION["cart"][] = $_GET["id"];
        header("Location: /acquisto?id={$_GET["id"]}");
    } else {
        // TODO
    }
} else {
    header("Location: /");
}

?>