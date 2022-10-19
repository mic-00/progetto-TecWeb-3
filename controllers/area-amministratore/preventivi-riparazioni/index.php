<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    if ($_SESSION["admin"]) {
        if (isset($_GET["id"])) {
            $repairExists = include "";
            if ($repairExists) {
                return [
                    UtilityFunctions::replace(
                        [],
                        file_get_contents(ROOT . "/views/area-amministratore/preventivi-riparazioni/id/index.html")
                    ),
                    "",
                    ""
                ];
            } else {
                header("Location: /area-amministratore/preventivi-riparazioni");
            }
        } else {
            $repairs = include ROOT . "/models/area-amministratore/preventivi-riparazioni/index.php";
            $repairsHTML = "";
            foreach ($repairs as $repair) {
                $id = $repair["id"];
                $repairsHTML .= UtilityFunctions::replace(
                    [ "%%ID%%" => $id ],
                    file_get_contents(ROOT . "/views/area-amministratore/preventivi-riparazioni/repair.html")
                );
            }
            return [
                UtilityFunctions::replace(
                    [
                        "%%REPAIRS%%" => $repairsHTML,
                        "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-amministratore/sidebar.html")
                    ],
                    file_get_contents(ROOT . "/views/area-amministratore/preventivi-riparazioni/index.html")
                ),
                "",
                "preventivo, riparazioni"
            ];
        }
    } else {
        header("Location: /area-utente/informazioni-personali");
    }
}

?>