<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    if ($_SESSION["admin"]) {
        return [
            UtilityFunctions::replace(
                [
                    "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-amministratore/sidebar.html"),
                    "%%EMAIL%%" => $_SESSION["email"],
                    "%%USERNAME%%" => $_SESSION["username"],
                    "%%PASSWORD%%" => $_SESSION["password"]
                ],
                file_get_contents(ROOT . "/views/area-amministratore/informazioni-personali/index.html")
            ),
            "Visualizza le informazioni relative al tuo account.",
            "area amministratore, account, informazioni personali, info"
        ];
    } else {
        header("Location: /area-utente/informazioni-personali");
    }
}

header("Location: /login");

?>