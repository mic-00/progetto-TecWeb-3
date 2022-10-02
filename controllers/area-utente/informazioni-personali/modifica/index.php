<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"])) {

    $alert = "";

    if (isset($_POST["email"], $_POST["username"], $_POST["password"])
        && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
        && strlen($_POST["username"]) > 0
        && strlen($_POST["password"]) >= 8) {
        $result = include ROOT . "/models/area-utente/informazioni-personali/modifica/index.php";
        if ($result) {
            $alert = "<p>Le modifiche sono state apportate correttamente.</p>";
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
        } else {
            $alert = "<p>Nome utente già in uso. Per favore riprovare con uno diverso.</p>";
        }
    } else if (isset($_POST["email"], $_POST["username"], $_POST["password"])) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
            $alert .= "<p>Formato dell'indirizzo <span lang='en'>email</span> fornito non valido.</p>";
        if (!strlen($_POST["username"]))
            $alert .= "<p>Il nome utente deve contenere almeno un carattere.</p>";
        if (strlen($_POST["password"]) < 8)
            $alert = "<p>La password deve contenere almeno otto caratteri.</p>";
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