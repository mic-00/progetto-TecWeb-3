<?php

namespace Utils;

use DOMDocument;

class UtilityFunctions
{
    public static function replace(array $array, string $string): string {
        foreach ($array as $key => $value) {
            $string = str_replace($key, $value, $string);
        }
        return $string;
    }

    public static function kebabCaseToText(string $string): string {
        return str_replace("-", " ", $string);
    }

    public static function checkLinks(string $html): string {
        $urlPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $links = $dom->getElementsByTagName("a");
        foreach ($links as $link) {
            if ($_SERVER["REQUEST_URI"] === $link->getAttribute("href")
            || !file_exists(ROOT . "/controllers" . $urlPath . "/index.php"))
                $link->removeAttribute("href");
        }
        return $dom->saveHTML();
    }
}