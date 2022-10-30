<?php

unset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"], $_SESSION["admin"]);
header("Location: " . SUBFOLDER . "/");

?>