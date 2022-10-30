<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    return [
        UtilityFunctions::replace(
            [
                "%%EMAIL%%" => $_SESSION["email"],
                "%%USERNAME%%" => $_SESSION["username"],
                "%%PASSWORD%%" => $_SESSION["password"],
                "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-utente/sidebar.html")
            ],
            file_get_contents(ROOT . "/views/area-utente/informazioni-personali/index.html")
        ),
        "Visualizza le informazioni relative al tuo account.",
        "area utente, account, informazioni personali, info"
    ];
}

header("Location: " . SUBFOLDER . "/login?redirect=/area-utente/informazioni-personali");

?>
