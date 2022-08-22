<?php 
// author: Anthony Medugno
// date: 10-23-21
// editied 12-14-21 by Emma Glisko

include '../view/header.php';
session_start();
if($_SESSION["type"] == "admin") {
    ?>

<main>
	<h2>Technician List</h2>
	
	<!-- Table for list of technicians -->
	<table>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Password</th>
			<th></th>			
		</tr>
		
		<?php require('../model/database.php');
                    
        /* select list of technicians from db */
        
		try{
		
		$sql = "SELECT * FROM technicians";
		
		$result = $con->query($sql);
		}
		
		catch (Exception $e) {
		    // save message to session array and redirect user to error page
		    $_SESSION['errorMessage'] = $e->getMessage();
		    $_SESSION['errorCode'] = $e->getCode();
		    header("Location: ../errors/database_error.php");
		}
		// check num of records found
		if ($result->num_rows > 0) {
		    		    
		    // output data of each row
		    while($row = $result->fetch_assoc()) {		       
		        echo "<tr>
              <td>" . $row["firstName"]. "</td>
              <td>" . $row["lastName"]. "</td>
              <td>" . $row["email"]. "</td>
              <td>" . $row["phone"]. "</td>
              <td>" . $row["password"]. "</td>
              <td>"."
                <form onsubmit='return checkDelete(this);' method='post' action='deleteTech.php?techID={$row["techID"]}'>
                     <input type='submit' value='Delete'>
                </form>
              </td>
              </tr>";
		    }
		    
		} else {
		    echo "<tr><td>No records found.</td></tr>";
		}
        
        ?>
	
	</table>
	<br>
	<a href="addTechForm.php">Add Technician</a>

<script>
function checkDelete(first, last) {
	return confirm('Are you sure you want to delete this technician?');
}
</script>

</main>
<?php } else {
    header("location: ../no_permission.php");
}
include '../view/footer.php'?>