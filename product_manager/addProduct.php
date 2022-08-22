<?php
// author: Emma Glisko
// date: 12-14-21
// edited: Tommy O'Heir worked on Part I

include '../view/header.php';
session_start();
if($_SESSION["type"] == "admin") {
    


require('../model/database.php');

// add a product using addProductForm.php

// check if form vars have data in them before using them
if ( isset($_REQUEST['productCode']) and isset($_REQUEST['name']) and isset($_REQUEST['version']) and isset($_REQUEST['releaseDate'])) {
    
    $productCode = $_REQUEST['productCode'];
    $name = $_REQUEST['name'];
    $version = $_REQUEST['version'];
    $releaseDate = $_REQUEST['releaseDate'];
   
    
    try{
    // prepare insert statement
    
    $query = mysqli_prepare($con, "INSERT INTO products (productCode, name, version, releaseDate) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($query,"ssss", $productCode, $name, $version, $releaseDate);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    
    }
    catch (Exception $e) {
        // save message to session array and redirect user to error page
        $_SESSION['errorMessage'] = $e->getMessage();
        $_SESSION['errorCode'] = $e->getCode();
        header("Location: ../errors/database_error.php");
    }
    
    if(!$result) {
        mysqli_close($con); // Close connection
        header("location:addProductForm.php"); // redirects back to form
        exit;
    } else {
        echo "Error adding record. ". mysqli_errno($con); // display error message if could not insert
    }
    
}

 } else {
    header("location: ../no_permission.php");
}
include '../view/footer.php'?>