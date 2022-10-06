<?php

use Utils\UtilityFunctions;

if (isset($_SESSION["username"], $_SESSION["cart"])) {
    $result = include ROOT . "/models/carrello/paga/index.php";
    $alert = "Pagamento andato a buon fine.";
    if ($result) {
        unset($_SESSION["cart"]);
    } else {
        $alert = "La transazione non è andata a buon fine.";
    }
    return [
        UtilityFunctions::replace(
            [ "%%ALERT%%" => $alert ],
            file_get_contents(ROOT . "/views/carrello/paga/index.html")
        ),
        "Procedi al pagamento degli elementi nel carrello.",
        "pagamento"
    ];
} else if (!isset($_SESSION["username"])) {
    header("Location: /login");
} else {
    header("Location: /carrello");
}

?>