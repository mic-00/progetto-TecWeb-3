<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"])) {
    if ($_SESSION["admin"]) {
        $error = "";
        if (isset($_POST["brand"], $_POST["model"], $_POST["description"], $_POST["price"])
            && preg_match("/^.+$/", $_POST["brand"])
            && preg_match("/^.+$/", $_POST["model"])
            && preg_match("/^.+$/", $_POST["description"])
            && preg_match("/^[0-9]+.[0-9]{2}$|^[0-9]+$/", $_POST["price"])
        ) {
            $id = include ROOT . "/models/area-amministratore/aggiungi-articolo/index.php";
            if ($id) {
                $error = "Inserimento avvenuto correttamente.";
                if ($_FILES["image"]["size"]) {
                    rename(
                        $_FILES["image"]["tmp_name"],
                        ROOT . "/public/img/purchase/$id." . pathinfo($_FILES["image"]["name"])["extension"]
                    );
                }
            } else {
                $error = "L'inserimento non &egrave; andato a buon fine. Verificare la corrispondenza tra nome del marchio e nome del modello.";
            }
        } elseif (!isset($_POST["brand"], $_POST["model"], $_POST["description"], $_POST["price"])) {
            $error = "Aggiungi un nuovo articolo al negozio fornendo il modello, una descrizione, il prezzo di vendita e in aggiunta un'immagine.";
        } else {
            $error = "L'inserimento non &egrave; andato a buon fine. Verificare la correttezza dei dati inseriti.";
        }
        return [
            UtilityFunctions::replace(
                [ "%%ERROR%%" => $error ],
                file_get_contents(ROOT . "/views/area-amministratore/aggiungi-articolo/index.html")
            ),
            "",
            ""
        ];
    } else {
        header("Location: /area-utente/informazioni-personali");
    }
} else {
    header("Location: /login?redirect=/area-amministratore/aggiungi-articolo");
}

?>