<?php
// author: Anthony Medugno
// date: 11-17-21
// edited: Tommy O'Heir worked on Part I

require('../model/database.php');
session_start();
// Add a Technician using form on addTechForm.php

// check if form vars have data in them before using them
if ( isset($_REQUEST['productCode']) and isset($_REQUEST['title']) and isset($_REQUEST['description']) and isset($_REQUEST['customerID'])) {
    
    $customerID = $_REQUEST['customerID'];
    $productCode = $_REQUEST['productCode'];
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    
    // make insert statement
    try {
    $query = mysqli_prepare($con, "INSERT INTO incidents (customerID, productCode, title, description) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($query,"ssss", $customerID, $productCode, $title, $description);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    
    } catch (Exception $e) {
        // save message to session array and redirect user to error page
        $_SESSION['errorMessage'] = $e->getMessage();
        $_SESSION['errorCode'] = $e->getCode();
        header("Location: ../errors/database_error.php");
    }
    // Perform SQL query
    try {
        $insert = mysqli_query($con, $statement);
      
        mysqli_close($con); // Close connection
        header("location: createIncident.php"); 
        $_SESSION['successMessage'] = "The incident was added to our database.";
        exit;
        
    } catch (Exception $e) {
        // save message to session array and redirect user to error page
        $_SESSION['errorMessage'] = $e->getMessage();
        $_SESSION['errorCode'] = $e->getCode();
        header("Location: ../errors/database_error.php");
    }
    
}

?>