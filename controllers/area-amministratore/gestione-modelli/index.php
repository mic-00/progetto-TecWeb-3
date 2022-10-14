<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    if (isset($_GET["id"])) {

    } else {
        $models = include ROOT . "/models/area-amministratore/gestione-modelli/index.php";
        if (is_array($models)) {
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
                    [ "%%MODELS%%" => $modelsHTML ],
                    file_get_contents(ROOT . "/views/area-amministratore/gestione-modelli/index.html")
                ),
                "Visualizza, aggiungi e rimuovi modelli.",
                ""
            ];
        }
    }
}

header("Location: /login");

?>