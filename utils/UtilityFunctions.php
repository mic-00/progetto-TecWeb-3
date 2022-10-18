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
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $links = $dom->getElementsByTagName("a");
        foreach ($links as $link) {
            $href = $link->getAttribute("href");
            $path = parse_url($href, PHP_URL_PATH);
            if (!preg_match("/^mailto:/", $href) && !preg_match("/^tel:/", $href)) {
                if ($_SERVER["REQUEST_URI"] === $href
                    || !file_exists(ROOT . "/controllers" . $path . "/index.php"))
                    $link->removeAttribute("href");
            }
        }
        return $dom->saveHTML();
    }
}