<?php

if (isset($_POST[""])) {

} else {
    return [
        file_get_contents(ROOT . "/views/riparazione/index.html"),
        "Riparare dispositivi malfunzionanti o danneggiati è la nostra passione! Non buttare via il tuo vecchio computer, portalo da noi, e tornerà come nuovo!",
        "riparazione"
    ];
}
