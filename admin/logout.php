<?php
session_start();

session_unset();

session_destroy();

header("Location: /perpus_ukk/signin.php");
exit;
?>