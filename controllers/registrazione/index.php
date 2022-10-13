<?php

use Utils\UtilityFunctions;

$error = "";

if (isset($_POST["email"], $_POST["username"], $_POST["password"])
    && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
    && strlen($_POST["username"]) > 0
    && !preg_match("/\s+/", $_POST["username"])
    && strlen($_POST["password"]) >= 8
    && preg_match("/[0-9]+/", $_POST["password"])
    && preg_match("/[A-Z]+/", $_POST["password"])
    ) {
        $isRegistered = include ROOT . "/models/registrazione/index.php";
        if ($isRegistered) {
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
            header("Location: /area-utente/informazioni-personali");
        } else {
            $error = "Nome utente già in uso. Cortesemente riprovare con uno diverso.";
        }
    } else if (isset($_POST["email"], $_POST["username"], $_POST["password"])) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
            $error .= "Formato dell'indirizzo <span lang='en'>email</span> fornito non valido.";
        else if (!strlen($_POST["username"]) || preg_match("/\s+/", $_POST["username"]))
            $error .= "Il nome utente deve contenere almeno un carattere e non può contenere spazi.";
        else
            $error = "La password deve contenere almeno 8 caratteri, di cui un numero e una lettera maiuscola.";
    } else {
        $error = "Inserisci un nome utente, un indirizzo <span lang='en'>email</span> e una <span lang='en'>password</span> per registrarti.";
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