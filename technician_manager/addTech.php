<?php
// author: Anthony Medugno
// date: 10-23-21
// edited: Tommy O'Heir worked on Part I

require('../model/database.php');

// Add a Technician using form on addTechForm.php

// check if form vars have data in them before using them
if ( isset($_REQUEST['firstName']) and isset($_REQUEST['lastName']) and isset($_REQUEST['email']) and isset($_REQUEST['phone']) and isset($_REQUEST['password'])) {
       
    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $password = $_REQUEST['password'];
   

    
    // make insert statement
    
    $query = mysqli_prepare($con, "INSERT INTO technicians (firstName, lastName, email, phone, password) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($query,"sssss", $firstName, $lastName, $email, $phone, $password);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    
   
    if(!$result) {
        mysqli_close($con); // Close connection
        header("location:addTechForm.php"); // redirects back to form
        exit;
    } else {
        echo "Error adding record. ". mysqli_errno($con); // display error message if could not insert
    }
    
}

?>