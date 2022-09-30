<?php

use Utils\UtilityFunctions;

if (isset($_POST["email"], $_POST["username"], $_POST["password"])) {
    $result = include ROOT . "/models/registrazione/index.php";
} else {
    return [
        UtilityFunctions::replace(
            [ "%%ERROR%%" => "" ],
            file_get_contents(ROOT . "/views/registrazione/index.html")
        ),
        "Registrazione per usufruire dei nostri servizi.",
        "registrazione"
    ];
}

?>