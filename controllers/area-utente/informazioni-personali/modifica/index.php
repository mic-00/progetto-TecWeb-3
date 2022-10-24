<?php

use Utils\UtilityFunctions;

$error = "";

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {

    if (isset($_POST["email"], $_POST["username"], $_POST["password"])
        && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
        && preg_match("/^(?=.{4,10}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9]+(?<![_.])$/", $_POST["username"])
        && preg_match("/^\w{8,}$/", $_POST["password"])
        && preg_match("/[0-9]+/", $_POST["password"])
        && preg_match("/[A-Z]+/", $_POST["password"])
    ) {
        $changesDone = include ROOT . "/models/area-utente/informazioni-personali/modifica/index.php";
        if ($changesDone) {
            $error = "Le modifiche sono state apportate correttamente.";
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
        } else {
            $error = "Nome utente già in uso. Per favore riprovare con uno diverso.";
        }
    } else if (isset($_POST["email"], $_POST["username"], $_POST["password"])) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
            $error .= "Formato dell'indirizzo <span lang='en'>email</span> fornito non valido.";
        else if (!preg_match("/^(?=.{4,10}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9]+(?<![_.])$/", $_POST["username"]))
            $error .= "Il nome utente deve contenere tra 4 e 10 caratteri (solo lettere minuscole e numeri ammessi).";
        else
            $error = "La password deve contenere tra gli 8 e i 40 caratteri, di cui almeno un numero e una lettera maiuscola.";
    } else {
        $error = "Inserisci un nome utente, una <span lang='en'>email</span> o una <span lang='en'>password</span> per apportare le modifiche.";
    }

    return [
        UtilityFunctions::replace(
            [
                "%%ERROR%%" => $error,
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