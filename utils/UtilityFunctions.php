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

    public static function getPath(): string {
        return preg_replace(
            "/^" . preg_quote(SUBFOLDER, "/") . "/",
            "",
            parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)
        );
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
            if (
                !preg_match("/^mailto:/", $href)
                && !preg_match("/^tel:/", $href)
                && !preg_match("/^#/", $href)
            ) {
                $link->setAttribute("href", SUBFOLDER . $href);
                $href = $link->getAttribute("href");
                if ($_SERVER["REQUEST_URI"] === $href
                    || !file_exists(ROOT . "/controllers" . $path . "/index.php"))
                    $link->removeAttribute("href");
            }
        }
        $links = $dom->getElementsByTagName("link");
        foreach ($links as $link)
            $link->setAttribute("href", SUBFOLDER . $link->getAttribute("href"));
        $links = $dom->getElementsByTagName("img");
        foreach ($links as $link)
            $link->setAttribute("src", SUBFOLDER . $link->getAttribute("src"));
        $links = $dom->getElementsByTagName("script");
        foreach ($links as $link)
            $link->setAttribute("src", SUBFOLDER . $link->getAttribute("src"));
        return $dom->saveHTML();
    }
}