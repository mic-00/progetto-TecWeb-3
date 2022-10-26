<?php

use Utils\UtilityFunctions;

$user = $login = $logout = $signup = "";
if (isset($_SESSION["username"], $_SESSION["email"], $_SESSION["password"], $_SESSION["admin"])) {
    $user = "Ciao " . ($_SESSION["admin"]
        ? "<a href='/area-amministratore/informazioni-personali'>"
        : "<a href='/area-utente/informazioni-personali'>") .
        $_SESSION["username"] . "</a>!";
    $login = "<li><a href='/logout' lang='en'>Logout</a></li>";
} else {
    $login = "<li><a href='/login' lang='en'>Login</a></li>";
    $signup = "<li><a href='/registrazione'>Registrazione</a></li>";
}

return UtilityFunctions::replace(
    [
        "%%SITENAME%%" => SITE_NAME,
        "%%USER%%" => $user,
        "%%LOGIN%%" => $login,
        "%%LOGOUT%%" => $logout,
        "%%SIGNUP%%" => $signup
    ],
    file_get_contents(ROOT . "/views/header.html")
);

?>