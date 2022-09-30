<?php

$result = include ROOT . "/models/login/index.php";

if (isset($_SESSION["email"], $_SESSION["password"]) || $result === 1) {
    header("Location: /area-utente/informazioni-personali");
} else {
    echo $result;
    return [
        file_get_contents(ROOT . "/views/login/index.html"),
        "Accedi al sito con il tuo account per usufruire dei nostri servizi.",
        "login, accesso"
    ];
}