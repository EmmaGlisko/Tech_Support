<?php
// author: Emma Glisko
// date: 12-14-21
// edited: Tommy O'Heir worked on Part I

session_start();
require('../model/database.php');


// check if form vars have data in them before using them
if ( isset($_POST['incidentID'])) {
    
    $incidentID = $_POST['incidentID'];
    try{
    $query = mysqli_prepare($con, "SELECT * FROM incidents WHERE incidentID = ? ");
    mysqli_stmt_bind_param($query,"s", $incidentID);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    } catch (Exception $e) {
        // save message to session array and redirect user to error page
        $_SESSION['errorMessage'] = $e->getMessage();
        $_SESSION['errorCode'] = $e->getCode();
        header("Location: ../errors/database_error.php");
    }
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
           $productCode = $row['productCode'];
           $title = $row['title'];
           $description = $row['description'];
           
       }
        
    } else {
        echo "<tr><td>No records found.</td></tr>";
    }
    
    
    ?>
    <form method="post" action="saveIncident.php">
        <label>Product Code:</label><input type="text" id="productCode" name="productCode" value="<?php echo $productCode?>" required="required"/><br>
        <label>Title:</label><input type="text" id="title" name="title" value="<?php echo $title?>" required="required"/><br>
        <label>Decription:</label><textarea id='description' name='description' rows='4' cols='50' required="required"><?php echo $description?></textarea><br>
        <label></label><input type="submit" value="Update Incident">
        <input type="hidden" name="incidentID" value="<?php echo $incidentID?>">
    </form>
    <?php 
    
} else {
    
    echo "Error Occurred. Incident not found.";
}

?>