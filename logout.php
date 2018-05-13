<?php
session_start();

unset($_SESSION['userSession']);
session_destroy();
header("Location: login.php");
?>