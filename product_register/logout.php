<?php

// Destroy the session and unset all the variables

session_start();

session_unset();

session_destroy();

header("location: index.php");

?>