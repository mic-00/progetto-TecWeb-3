<?php

use Utils\UtilityFunctions;

$urlPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
parse_str(
    parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY),
    $arr
);
unset($arr["redirect"]);
$urlQuery = http_build_query($arr);

$path = "<a href='/' lang='en'>Home</a> ";
if ($urlPath !== "/") {
    $href = "";
    $params = "?";
    $path .= " / "
        . ($urlPath
            ? (implode(
                " / ",
                array_map(function ($a) use (&$href) {
                    $href .= "/$a";
                    return "<a href='$href'>" . ucfirst(UtilityFunctions::kebabCaseToText($a)) . "</a>";
                }, explode(
                    "/",
                    substr($urlPath, 1)
                ))))
            : "");
    $path .= " / "
        . ($urlQuery
            ? (implode(
                " / ",
                array_map(function ($a, $k) use ($href, &$params) {
                    $params .= ($k ? "&" : "") . $a;
                    return "<a href='$href$params'>" . urldecode(preg_replace("/\w+=/", "", $a)) . "</a>";
                }, explode(
                    "&",
                    $urlQuery
                ), array_keys(explode(
                    "&",
                    $urlQuery
                )))))
            : "");
}
return UtilityFunctions::replace(
    [ "%%PATH%%" => $path ],
    file_get_contents(ROOT . "/views/breadcrumb.html")
);

?>