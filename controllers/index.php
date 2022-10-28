<?php

use Utils\UtilityFunctions;

$users = $items = "";
$stats = include ROOT . "/models/index.php";
if ($stats) {
    $users = "Utenti registrati: " . $stats["users"];
    $items = "Articoli venduti: " . $stats["items"];
}

return [
    UtilityFunctions::replace(
        [
            "%%USERS%%" => $users,
            "%%ITEMS%%" => $items
        ],
        file_get_contents(ROOT . "/views/index.html")
    ),
    "Ripariamo, acquistiamo e vendiamo vecchi dispositivi elettronici quali computer, tablet, smartphone, ecc. per ridar loro nuova vita.",
    ""
];

?>