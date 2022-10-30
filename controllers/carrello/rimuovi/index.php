<?php

if (isset($_GET["id"])) {
    if (isset($_SESSION["cart"]) && in_array($_GET["id"], $_SESSION["cart"])) {
        $key = array_search($_GET["id"], $_SESSION["cart"]);
        unset($_SESSION["cart"][$key]);
    }
    header("Location: " . SUBFOLDER . "/negozio?id={$_GET["id"]}");
} else {
    header("Location: " . SUBFOLDER . "/");
}

?>