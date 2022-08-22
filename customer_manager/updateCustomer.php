<?php
// author: Tommy O'Heir
// date: 11/9/21
// edited: 12/1/2021

require('../model/database.php');
require("../errors/testInput.php");

// Script to Add or Update Customer

// check if form vars have data in them before using them
if (isset($_REQUEST['firstName']) and isset($_REQUEST['lastName']) and isset($_REQUEST['address']) and isset($_REQUEST['city']) and isset($_REQUEST['state']) and isset($_REQUEST['postalCode']) and isset($_REQUEST['countryCode']) and isset($_REQUEST['phone']) and isset($_REQUEST['email']) and isset($_REQUEST['password'])) {
    
    $firstName = test_input($_REQUEST['firstName']);
    $lastName = test_input($_REQUEST['lastName']);
    $address = test_input($_REQUEST['address']);
    $city = test_input($_REQUEST['city']);
    $state = test_input($_REQUEST['state']);
    $postalcode = test_input($_REQUEST['postalCode']);
    $countrycode = test_input($_REQUEST['countryCode']);
    $phone = test_input($_REQUEST['phone']);
    $email = test_input($_REQUEST['email']);
    $password = test_input($_REQUEST['password']);
    
    // check if customerID is set
    if (isset($_REQUEST['customerID'])) {
        // if customerID is set, then update the customer's data
        $customerID = test_input($_REQUEST['customerID']);
        
        // make update statement
        $query = mysqli_prepare($con, "UPDATE customers SET firstName = ?, lastName = ?, address = ?, city = ?, state = ?, postalCode = ?, countryCode = ?, phone = ?, email = ?, password = ? WHERE customerID = ?");
        mysqli_stmt_bind_param($query, "ssssssssssi", $firstName, $lastName, $address, $city, $state, $postalcode, $countrycode, $phone, $email, $password, $customerID);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        
        // error handling
        if(!$result) {
            mysqli_close($con); // Close connection
            header("location:index.php"); // redirects back to form
            exit;
        } else {
            echo "Error updating customer. ". mysqli_errno($con); // display error message if could not insert
        }
        
    } else {
        // if customerID not set, then add the new customer
        
        // make update statement
        $query = mysqli_prepare($con, "INSERT INTO customers (firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password) VALUES (?,?,?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($query, "ssssssssss", $firstName, $lastName, $address, $city, $state, $postalcode, $countrycode, $phone, $email, $password);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        
        // error handling
        if(!$result) {
            mysqli_close($con); // Close connection
            header("location:index.php"); // redirects back to form
            exit;
        } else {
            echo "Error adding customer. ". mysqli_errno($con); // display error message if could not insert
        }
        
    }
    
}

?>
