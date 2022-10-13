<?php

use Utils\UtilityFunctions;

$user = $login = $logout = "";
if (isset($_SESSION["username"], $_SESSION["email"], $_SESSION["password"])) {
    $user = "<span id='user-welcome'>Ciao <a href='/area-utente/informazioni-personali'>{$_SESSION["username"]}</a>!</span>";
    $logout = "<li><a href='/logout' lang='en'>Logout</a></li>";
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