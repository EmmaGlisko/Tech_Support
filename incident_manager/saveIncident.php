<?php
// author: Emma Glisko
// date: 12-14-21
// edited: Tommy O'Heir worked on Part I

session_start();
require('../model/database.php');


// check if form vars have data in them before using them
if ( isset($_POST['incidentID']) AND isset($_POST['productCode']) AND isset($_POST['title']) AND isset($_POST['description'])) {
    
    $incidentID = $_POST['incidentID'];
    $productCode = $_POST['productCode'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    try{
    $query = mysqli_prepare($con, "UPDATE incidents SET productCode = ?, title = ?, description = ? WHERE incidentID = ?");
    mysqli_stmt_bind_param($query,"ssss", $productCode, $title, $description, $incidentID);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    } catch (Exception $e) {
        // save message to session array and redirect user to error page
        $_SESSION['errorMessage'] = $e->getMessage();
        $_SESSION['errorCode'] = $e->getCode();
        header("Location: ../errors/database_error.php");
    }
    header("Location: index.php");
    
} else {
    
    echo "Error Occurred. Incident not found.";
}

?>