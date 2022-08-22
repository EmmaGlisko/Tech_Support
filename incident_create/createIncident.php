<?php
// author: Anthony Medugno
// date: 11-28-21
// edited: Tommy O'Heir worked on Part I
// edited 12-14-21 by Emma Glisko

include '../view/header.php';
session_start();
if($_SESSION["type"] == "admin") {
?>
<style>
    label {
      width: 150px;
      padding-right: 20px;
      padding: 5px;
      display: inline-block;
    }
</style>
<main>
	<h2>Create Incident</h2>
	<?php require('../model/database.php'); 
        
    	// check if form var has data in it before using it
    	if ( isset($_REQUEST['email']) ) {
    	    $custEmail = $_REQUEST['email'];
    	    
    	    try {
        	    // Prepare SQL query
        	    $query = mysqli_prepare($con, "SELECT * FROM customers WHERE email=?");
        	    mysqli_stmt_bind_param($query, "s", $custEmail);
        	    mysqli_stmt_execute($query);
        	    $result = mysqli_stmt_get_result($query);
        	    
    	    } catch (Exception $e) {
    	        // save message to session array and redirect user to error page
    	        $_SESSION['errorMessage'] = $e->getMessage();
    	        $_SESSION['errorCode'] = $e->getCode();
    	        header("Location: ../errors/database_error.php");
    	    }
    	// if query finds at least 1 record, execute the following
		if ($result->num_rows > 0) {
		    
		    echo '<form method="POST" action="incidentCreated.php">';

		    while($row = $result->fetch_assoc()) {
		        
		        echo "<input type='hidden' name='customerID' value='". $row["customerID"]."'><br>";
		        echo "		        
		        <!-- Form for creating an incident -->
		        <label>Customer:</label><span>" . $row['firstName'] . " " . $row['lastName'] . "</span><br>
		        <label>Product:</label>";
                                              
		        try {
		            // Prepare SQL query
            	    $query2 = mysqli_prepare($con, "SELECT name FROM products t1 INNER JOIN 
                        registrations t2 ON t1.productCode = t2.productCode WHERE customerID=?;");
            	    
            	    mysqli_stmt_bind_param($query2, "i", $row['customerID']);
            	    mysqli_stmt_execute($query2);
            	    $result2 = mysqli_stmt_get_result($query2);
            	    
            	    // Product Select-box -- needs to query for products that the selected customer has registered
            	    echo "<select id='productCode' name='productCode'>";
            	    while($row2 = $result2->fetch_assoc()) {
            	        echo "<option value=".$row2['productCode'].">".$row2['name']."</option>";
            	    }        	                           
                    echo "</select><br>";
		        
		        } catch (Exception $e) {
		            // save message to session array and redirect user to error page
		            $_SESSION['errorMessage'] = $e->getMessage();
		            $_SESSION['errorCode'] = $e->getCode();
		            header("Location: ../errors/database_error.php");
		        }

		        echo "<label>Title:</label><input type='text' id='title' name='title' value='' required='required'/><br>
		        <label>Description:</label><textarea id='description' name='description' rows='4' cols='50'></textarea><br>
                ";
		    }
		    
		    // end form with submit button
		    echo 
		    '<input type="submit" name="submit" value="Create Incident">
            </form>';
		    
		} else {
		    // display an error message if email was not found
		    echo "<p>No customer was found that matched that email!</p>";
		}
    }
    
    if (isset($_SESSION['successMessage'])) {
        echo $_SESSION['successMessage'];  
    }   
	
?>
	
</main>

<?php } else {
    header("location: ../no_permission.php");
}
include '../view/footer.php'?>