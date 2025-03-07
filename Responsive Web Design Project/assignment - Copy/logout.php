<?php
session_start();
session_unset();
session_destroy();
//redirect to homepage
header('Location: login.php');

?>