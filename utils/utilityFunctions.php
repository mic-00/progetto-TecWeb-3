<?php

namespace Utils;

use DOMDocument;

class UtilityFunctions
{
    private $url;
    private $query;

    public function __construct() {
        $this->url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $this->query = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function getQuery(): ?string {
        return $this->query;
    }

    public function replace(array $array, string $string): string {
        foreach ($array as $key => $value) {
            $string = str_replace($key, $value, $string);
        }
        return $string;
    }

    public function kebabCaseToText(string $string): string {
        return str_replace("-", " ", $string);
    }

    public function checkLinks(string $html): string {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $links = $dom->getElementsByTagName("a");
        foreach ($links as $link) {
            if ($_SERVER["REQUEST_URI"] === $link->getAttribute("href"))
                $link->removeAttribute("href");
        }
        return $dom->saveHTML();
    }

    public function makePath(): string {
        $path = "<a href='/' lang='en'>Home</a> ";
        if ($this->url !== "/") {
            $href = "";
            $params = "?";
            $path .= " / "
                . implode(
                    " / ",
                    array_map(function ($a) use (&$href) {
                        $href .= "/$a";
                        return "<a href='$href'>" . ucfirst($this->kebabCaseToText($a)) . "</a>";
                    }, explode(
                        "/",
                        substr($this->url, 1))))
                . " / "
                . implode(
                    " / ",
                    array_map(function ($a, $k) use ($href, &$params) {
                        $params .= ($k ? "&" : "") . $a;
                        return "<a href='$href$params'>" . preg_replace("/\w+=/", "", $a) . "</a>";
                    }, explode(
                        "&",
                        $this->query
                    ), array_keys(explode(
                        "&",
                        $this->query
                    ))));
        }
        return $path;
    }

    public function makeTitle(): string {
        return $this->url === "/"
            ? SITE_NAME
            : ucfirst(
                $this->kebabCaseToText(
                    !$this->query
                        ? preg_replace("/[\/\w]*\//", "", $this->url)
                        : preg_replace("/[^ ]*&\w*=|\w*=/", "", $this->query)
            )) . " - " . SITE_NAME;
    }
}