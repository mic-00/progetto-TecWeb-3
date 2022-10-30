<?php

require_once "config/config.php";
require_once "utils/UtilityFunctions.php";
require_once "utils/DBConnection.php";

use Utils\UtilityFunctions;

if (session_status() === PHP_SESSION_NONE)
    session_start();

$urlPath = UtilityFunctions::getPath();

$title = include ROOT . "/controllers/title.php";
$header = include ROOT . "/controllers/header.php";
$breadcrumb = include ROOT . "/controllers/breadcrumb.php";
$footer = include ROOT . "/controllers/footer.php";
$main = $description = $keywords = null;

if (file_exists(ROOT . "/controllers" . $urlPath . "/index.php")) {
    list($main, $description, $keywords) = include ROOT . "/controllers" . $urlPath . "/index.php";
} else {
    $main = file_get_contents(ROOT . "/views/page-404.html");
    $description = "La pagina richiesta non è stata trovata.";
    $keywords = "errore 404";
    header("{$_SERVER["SERVER_PROTOCOL"]} 404 Not Found");
}

$keywords = SITE_NAME . ", tablet, smartphone, " . $keywords;

echo preg_replace(
    '~>\s+<~',
    '><',
    UtilityFunctions::checkLinks(
        UtilityFunctions::replace(
            [
                "%%DESCRIPTION%%" =>$description,
                "%%KEYWORDS%%" => $keywords,
                "%%TITLE%%" => $title,
                "%%HEADER%%" => $header,
                "%%BREADCRUMB%%" => $breadcrumb,
                "%%MAIN%%" => $main,
                "%%FOOTER%%" => $footer
            ],
            file_get_contents("index.html")
        ))
);