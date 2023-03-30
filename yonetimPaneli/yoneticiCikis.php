<?php

unset($_SESSION["yonetici"]);
session_destroy();   // açık sessionları yok eder

header("Location: index.php");
exit();

?>