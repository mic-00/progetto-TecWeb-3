<?php

use Utils\UtilityFunctions;

$alert = "";

if (!isset($_SESSION["username"])) {
    header("Location: /login");
} else if (isset($_POST["brand"], $_POST["model"], $_POST["description"])) {
    $id = include ROOT . "/models/riparazione/index.php";
    if ($id) {
        $alert = "Richiesta di riparazione accettata.";
        if ($_FILES["image"]) {
            rename(
                $_FILES["image"]["tmp_name"],
                ROOT . "/public/img/repair/$id." . pathinfo($_FILES["image"]["name"])["extension"]
            );
        }
    } else {
        $alert = "Richiesta di riparazione rifiutata. Controllare la corrispondenza tra nome del marchio e nome del modello.";
    }
} else {
    $alert = "Cortesemente fornire il modello del dispositivo, una descrizione del danno e se possibile una immagine del danno.";
}

return [
    UtilityFunctions::replace(
        [ "%%ALERT%%" => $alert ],
        file_get_contents(ROOT . "/views/riparazione/index.html")
    ),
    "Riparare dispositivi malfunzionanti o danneggiati è la nostra passione! Non buttare via il tuo vecchio computer, portalo da noi, e tornerà come nuovo!",
    "riparazione"
];
