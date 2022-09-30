<?php

use Utils\UtilityFunctions;

return UtilityFunctions::replace(
    [ "%%SITENAME%%" => SITE_NAME ],
    file_get_contents(ROOT . "/views/header.html")
);

?>