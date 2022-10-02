<?php

unset($_SESSION["email"], $_SESSION["username"], $_SESSION["password"]);
header("Location: /");

?>