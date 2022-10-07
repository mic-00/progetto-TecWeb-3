<?php

use Utils\UtilityFunctions;

$error = "";

if (isset($_POST["email"], $_POST["username"], $_POST["password"])
    && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
    && strlen($_POST["username"]) > 0
    && strlen($_POST["password"]) >= 8
    && preg_match("/[0-9]+/", $_POST["password"])
    && preg_match("/[A-Z]+/", $_POST["password"])
    ) {
        $isRegistered = include ROOT . "/models/registrazione/index.php";
        if ($isRegistered) {
            header("Location: /area-utente");
        } else {
            $error = "Nome utente già in uso. Cortesemente riprovare con uno diverso.";
        }
    } else if (isset($_POST["email"], $_POST["username"], $_POST["password"])) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
            $error .= "Formato dell'indirizzo <span lang='en'>email</span> fornito non valido.";
        if (!strlen($_POST["username"]))
            $error .= "Il nome utente deve contenere almeno un carattere.";
        if (strlen($_POST["password"]) < 8)
            $error = "La password deve contenere almeno 8 caratteri, un numero e una lettera maiuscola.";
    }


return [
    UtilityFunctions::replace(
        [ "%%ERROR%%" => $error ],
        file_get_contents(ROOT . "/views/registrazione/index.html")
    ),
    "Registrazione per usufruire dei nostri servizi.",
    "registrazione"
];

?>