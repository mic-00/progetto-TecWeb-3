<?php

use Utils\UtilityFunctions;

$urlPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$urlQuery = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);

return $urlPath === "/"
    ? SITE_NAME
    : ucfirst(
        UtilityFunctions::kebabCaseToText(
            !$urlQuery
                ? preg_replace("/[^ ]*\//", "", $urlPath)
                : preg_replace("/[^ ]*&\w*=|\w*=/", "", $urlQuery)
        ))
    . " - "
    . SITE_NAME;

?>