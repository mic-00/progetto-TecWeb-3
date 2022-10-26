<?php

use Utils\UtilityFunctions;

$alert = "";

if (!isset($_SESSION["username"])) {
    header("Location: /login?redirect=/riparazione");
} else if (isset($_POST["brand"], $_POST["model"], $_POST["description"])
    && preg_match("/\w+/", $_POST["description"])
    && (!$_FILES["image"]["size"] || (isset($_POST["alt"]) && preg_match("/\w+/", $_POST["alt"])))
) {
    $id = include ROOT . "/models/riparazione/index.php";
    if ($id) {
        $alert = "Richiesta di riparazione accettata.";
        if ($_FILES["image"]["size"]) {
            rename(
                $_FILES["image"]["tmp_name"],
                ROOT . "/public/img/repair/$id." . pathinfo($_FILES["image"]["name"])["extension"]
            );
        }
    } else {
        $alert = "L'inserimento non &egrave; andato a buon fine. Controllare la corrispondenza tra nome del marchio e nome del modello.";
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
