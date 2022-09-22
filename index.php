<?php

require_once "config/config.php";
require_once "utils/utilityFunctions.php";

use Utils\UtilityFunctions;

$utils = new UtilityFunctions();

if (file_exists("controllers" . $utils->getUrl() . "/index.php")) {
    $title = $utils->makeTitle();
    $header = $utils->replace(
        [ "%%SITENAME%%" => SITE_NAME ],
        file_get_contents("views/header.html")
    );
    $breadcrumb = $utils->replace(
        [ "%%PATH%%" => $utils->makePath() ],
        file_get_contents("views/breadcrumb.html")
    );
    $footer = file_get_contents("views/footer.html");

    $arr = include "controllers" . $utils->getUrl() . "/index.php";
    $main = $arr[0];
    $description = $arr[1];
    $keywords = SITE_NAME . ", computer, tablet, smartphone, console, " . $arr[2];

    echo $utils->checkLinks(
        $utils->replace(
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