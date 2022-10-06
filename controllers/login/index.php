<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["username"])) {
    if (!$_SESSION["admin"]) {
        header("Location: /area-utente/informazioni-personali");
    } else {
        header("Location: /area-amministratore");
    }
} else if (isset($_POST["username"], $_POST["password"])) {
    $user = include ROOT . "/models/login/index.php";
    if ($user) {
        $_SESSION["email"] = $user["email"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["password"] = $user["password"];
        $_SESSION["admin"] = $user["admin"];
        if (!$user["admin"]) {
            header("Location: /area-utente/informazioni-personali");
        } else {
            header("Location: /area-amministratore");
        }
    } else {
        $error = "<p>Credenziali errate. Per favore riprovare con un nome utente o <span lang='en'>password</span> diversa.</p>";
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