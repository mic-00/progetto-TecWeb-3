<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    if ($_SESSION["admin"]) {
        if (isset($_GET["id"])) {
            $model = include ROOT . "/models/area-amministratore/gestione-modelli/id/index.php";
        } else {
            list($currentPage, $models) = include ROOT . "/models/area-amministratore/gestione-modelli/index.php";
            $modelsHTML = "";
            foreach ($models as $model) {
                $name = "{$model["brand"]} {$model["model"]}";
                $id = $model["id"];
                $modelsHTML .= UtilityFunctions::replace(
                    [
                        "%%NAME%%" => $name,
                        "%%ID%%" => $id
                    ],
                    file_get_contents(ROOT . "/views/area-amministratore/gestione-modelli/model.html")
                );
            }
            return [
                UtilityFunctions::replace(
                    [
                        "%%SIDEBAR%%" => file_get_contents(ROOT . "/views/area-amministratore/sidebar.html"),
                        "%%CURRENT_PAGE%%" => $currentPage,
                        "%%MODELS%%" => $modelsHTML
                    ],
                    file_get_contents(ROOT . "/views/area-amministratore/gestione-modelli/index.html")
                ),
                "Visualizza, aggiungi e rimuovi modelli.",
                ""
            ];
        }
    } else {
        header("Location: /area-utente/informazioni-personali");
    }
}

header("Location: /login");

?>