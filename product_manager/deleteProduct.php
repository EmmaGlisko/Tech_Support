<?php
// author: Emma Glisko
// date: 11-08-21
// edited: Tommy O'Heir worked on Part I

require('../model/database.php');

// delete a product using button on products list

$deletedID = $_GET['productCode']; // get id through query string

// Perform SQL query

$query = mysqli_prepare($con, "DELETE FROM products WHERE productCode = ?");
mysqli_stmt_bind_param($query,"s", $deletedID);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);


if(!$result) {
    mysqli_close($con); // Close connection 
    header("location:index.php"); // redirects to all records page
    exit;
} else {
    echo "Error deleting record. ". mysqli_errno($con); // display error message if could not delete
}

?>