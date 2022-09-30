<?php

require_once "config/config.php";
require_once "utils/UtilityFunctions.php";
require_once "utils/DBConnection.php";

use Utils\UtilityFunctions;

$urlPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if (file_exists(ROOT . "/controllers" . $urlPath . "/index.php")) {
    $title = include ROOT . "/controllers/title.php";
    $header = include ROOT . "/controllers/header.php";
    $breadcrumb = include ROOT . "/controllers/breadcrumb.php";
    $footer = include ROOT . "/controllers/footer.php";

    list($main, $description, $keywords) = include "controllers" . $urlPath . "/index.php";
    $keywords = SITE_NAME . ", computer, tablet, smartphone, console, " . $keywords;

    echo UtilityFunctions::checkLinks(
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
    ));
} else {
    header("HTTP/1.1 404 Not Found");
}