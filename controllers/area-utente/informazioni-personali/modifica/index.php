<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"])) {

    $alert = "";

    if (isset($_POST["email"], $_POST["username"], $_POST["password"])
        && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
        && strlen($_POST["username"]) > 0
        && strlen($_POST["password"]) >= 8
        && preg_match("/[0-9]+/", $_POST["password"])
        && preg_match("/[A-Z]+/", $_POST["password"])
    ) {
        $changesDone = include ROOT . "/models/area-utente/informazioni-personali/modifica/index.php";
        if ($changesDone) {
            $alert = "Le modifiche sono state apportate correttamente.";
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
        } else {
            $alert = "Nome utente già in uso. Per favore riprovare con uno diverso.";
        }
    } else if (isset($_POST["email"], $_POST["username"], $_POST["password"])) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
            $alert .= "Formato dell'indirizzo <span lang='en'>email</span> fornito non valido.";
        if (!strlen($_POST["username"]))
            $alert .= "Il nome utente deve contenere almeno un carattere.";
        if (strlen($_POST["password"]) < 8)
            $alert = "La password deve contenere almeno 8 caratteri, un numero e una lettera maiuscola.";
    }
    return [
        UtilityFunctions::replace(
            [
                "%%ALERT%%" => $alert,
                "%%EMAIL%%" => $_SESSION["email"],
                "%%USERNAME%%" => $_SESSION["username"],
                "%%PASSWORD%%" => $_SESSION["password"]
            ],
            file_get_contents(ROOT . "/views/area-utente/informazioni-personali/modifica/index.html")
        ),
        "Modifica i dati relativi al tuo account.",
        "informazioni personali, info, modifica"
    ];
}

header("Location: /login");

?>