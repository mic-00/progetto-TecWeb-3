<?php

if (isset($_GET["id"])) {
    if (!isset($_SESSION["cart"]))
        $_SESSION["cart"] = [];
    $_SESSION["cart"][] = $_GET["id"];
    header("Location: /acquisto?id={$_GET["id"]}");
} else {
    header("Location: /");
}

?>