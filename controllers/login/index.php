<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["password"])) {
    header("Location: /area-utente/informazioni-personali");
} else if (isset($_POST["email"], $_POST["password"])) {
    $result = include ROOT . "/models/login/index.php";
    if ($result) {
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["password"] = $_POST["password"];
        header("Location: /area-utente/informazioni-personali");
    } else {
        $error = "<p>Credenziali errate. Per favore riprovare con una <span lang='en'>email</span> o <span lang='en'>password</span> diversa.</p>";
        return [
            UtilityFunctions::replace(
                [ "%%ERROR%%" => $error ],
                file_get_contents(ROOT . "/views/login/index.html")
            ),
            "Accedi per usufruire dei nostri servizi.",
            "login, accesso"
        ];
    }
} else {
    return [
        UtilityFunctions::replace(
            [ "%%ERROR%%" => "" ],
            file_get_contents(ROOT . "/views/login/index.html")
        ),
        "Accedi per usufruire dei nostri servizi.",
        "login, accesso"
    ];
}