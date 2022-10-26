<?php

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    $delete = include ROOT . "/models/area-utente/informazioni-personali/elimina/index.php";
    if ($delete) {
        unset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"]);
        header("Location: /");
    } else {
        header("Location: /area-utente/informazioni-personali");
    }
} else {
    header("Location: /login?redirect=/area-utente/informazioni-personali/elimina");
}

?>