<?php

use Utils\UtilityFunctions;

$urlPath = UtilityFunctions::getPath();
parse_str(
    parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY),
    $arr
);
unset($arr["redirect"]);
$urlQuery = http_build_query($arr);

return $urlPath === "/"
    ? SITE_NAME
    : ucfirst(
        UtilityFunctions::kebabCaseToText(
            !$urlQuery
                ? preg_replace("/[^ ]*\//", "", $urlPath)
                : urldecode(preg_replace("/[^ ]*&\w*=|\w*=/", "", $urlQuery))
        ))
    . " - "
    . SITE_NAME;

?>