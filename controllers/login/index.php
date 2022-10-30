<?php

use Utils\UtilityFunctions;

$error = "";
$redirect = $_GET["redirect"] ?? "";

if (isset($_SESSION["username"])) {
    if (!$_SESSION["admin"]) {
        header("Location: " . SUBFOLDER . "/area-utente/informazioni-personali");
    } else {
        header("Location: " . SUBFOLDER . "/area-amministratore");
    }
} else if (isset($_POST["username"], $_POST["password"])) {
    $user = include ROOT . "/models/login/index.php";
    if ($user) {
        unset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"]);
        $_SESSION["email"] = $user["email"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["password"] = $user["password"];
        $_SESSION["admin"] = $user["admin"];
        if (isset($_GET["redirect"]) && $_GET["redirect"]) {
            header("Location: " . SUBFOLDER . $_GET["redirect"]);
        } elseif (!$_SESSION["admin"]) {
            header("Location: " . SUBFOLDER . "/area-utente/informazioni-personali");
        } else {
            header("Location: " . SUBFOLDER . "/area-amministratore/informazioni-personali");
        }
    } else {
        $error = "Credenziali errate. Per favore riprovare con un nome utente o <span lang='en'>password</span> diversa.";
    }
} else {
    $error = "Inserisci il tuo nome utente e la tua <span lang='en'>password</span> per accedere e quindi usufruire di tutte le funzionalit&agrave; del sito.";
}

return [
    UtilityFunctions::replace(
        [
            "%%ERROR%%" => $error,
            "%%REDIRECT%%" => $redirect
        ],
        file_get_contents(ROOT . "/views/login/index.html")
    ),
    "Accedi per usufruire dei nostri servizi.",
    "login, accesso"
];