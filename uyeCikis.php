<?php

unset($_SESSION["kullanici"]);
session_destroy();   // açık sessionları yok eder

header("Location: index.php");
exit();

?>