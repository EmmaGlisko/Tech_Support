<?php

// author: Emma Glisko
// date: 12-14-21

// Destroy the session and unset all the variables

session_start();

session_unset();

session_destroy();

header("location: index.php");

?>