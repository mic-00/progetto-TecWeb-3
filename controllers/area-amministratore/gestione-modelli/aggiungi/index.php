<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    if ($_SESSION["admin"]) {
        $error = "";
        if (isset(
            $_POST["brand"], $_POST["name"], $_POST["year"], $_POST["os"], $_POST["screen"], $_POST["camera"], $_POST["processor"], $_POST["battery-size"],
            $_POST["battery-type"], $_POST["bluetooth"], $_POST["sim"], $_POST["gps"], $_POST["weight"], $_POST["dimensions"]
            ) && preg_match("/^.+$/", $_POST["brand"])
            && preg_match("/^.+$/", $_POST["name"])
            && preg_match("/^.+$/", $_POST["year"])
            && preg_match("/^.+$/", $_POST["os"])
            && preg_match("/^.+$/", $_POST["screen"])
            && preg_match("/^.+$/", $_POST["camera"])
            && preg_match("/^.+$/", $_POST["processor"])
            && preg_match("/^.+$/", $_POST["battery-size"])
            && preg_match("/^.+$/", $_POST["battery-type"])
            && preg_match("/^.+$/", $_POST["bluetooth"])
            && preg_match("/^.+$/", $_POST["sim"])
            && preg_match("/^.+$/", $_POST["gps"])
            && preg_match("/^.+$/", $_POST["weight"])
            && preg_match("/^.+$/", $_POST["dimensions"])
        ) {
            $insert = include ROOT . "/models/area-amministratore/gestione-modelli/aggiungi/index.php";
            if ($insert) {
                header("Location: /area-amministratore/gestione-modelli");
            } else {
                $error = "Inserimento non avvenuto correttamente. Per favore riprova più tardi.";
            }
        } elseif (!isset(
            $_POST["brand"], $_POST["name"], $_POST["year"], $_POST["os"], $_POST["screen"], $_POST["camera"], $_POST["processor"], $_POST["battery-size"],
            $_POST["battery-type"], $_POST["bluetooth"], $_POST["sim"], $_POST["gps"], $_POST["weight"], $_POST["dimensions"]
        )) {
            $error = "Inserisci i dati relativi al nuovo modello.";
        } else {
            $error = "I dati inseriti non sono corretti o sono mancanti.";
        }
        if ($error) {
            return [
                UtilityFunctions::replace(
                    [ "%%ERROR%%" => $error ],
                    file_get_contents(ROOT . "/views/area-amministratore/gestione-modelli/aggiungi/index.html")
                ),
                "",
                ""
            ];
        }
    } else {
        header("Location: /area-utente/informazioni-personali");
    }
} else {
    header("Location: /login");
}

?>