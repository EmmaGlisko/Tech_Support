<?php
// author: Anthony Medugno
// date: 10-23-21
// edited: Tommy O'Heir worked on Part I

require('../model/database.php');

// Delete a Technician using button on Technicians list

$deletedID = $_GET['techID']; // get id through query string

// Perform SQL query

$query = mysqli_prepare($con, "DELETE FROM technicians WHERE techID = ?");
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