<?php
session_start();

session_unset();
session_destroy();
header(header: "refresh:2; url=login.php");
exit;
?>