<?php

use Utils\UtilityFunctions;

$user = $login = $logout = "";
if (isset($_SESSION["username"], $_SESSION["email"], $_SESSION["password"], $_SESSION["admin"])) {
    $href = $_SESSION["admin"] ? "/area-amministratore/informazioni-personali" : "/area-utente/informazioni-personali";
    $user = "<span id='user-welcome'>Ciao {$_SESSION["username"]}!</span>";
    $logout = "<li><a href='/logout' lang='en'>Logout</a></li>";
    $logout = "<li><a href='/area-utente/informazioni-personali'>Area utente</a></li>" .
        ($_SESSION["admin"] ? "<li><a href='/area-amministratore/informazioni-personali'>Area amministratore</a></li>" : "") .
        $logout;
} else {
    $login = "<li><a href='/login' lang='en'>Login</a></li>";
}

return UtilityFunctions::replace(
    [
        "%%SITENAME%%" => SITE_NAME,
        "%%USER%%" => $user,
        "%%LOGIN%%" => $login,
        "%%LOGOUT%%" => $logout
    ],
    file_get_contents(ROOT . "/views/header.html")
);

?>