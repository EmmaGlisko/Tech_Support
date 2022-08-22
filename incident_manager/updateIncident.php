<?php
// author: Emma Glisko
// date: 12-14-21

session_start();
include '../view/header.php';

?>

<main>
	<h2>Register Product</h2>
	<?php require('../model/database.php'); 
	
	try{
	    
	   // Check if the email and password have been passed. If so, set the session variables $ variables. If not, do only the latter.
	    if(isset($_REQUEST['email']) && isset($_REQUEST['password'])){
	        $email = $_REQUEST['email'];
	        $password = $_REQUEST['password'];
	        $_SESSION["email"] = $email;
	        $_SESSION["password"] = $password;
	        $_SESSION["type"] = "technician";
    	} else {
    	    $email = $_SESSION["email"];
    	    $password = $_SESSION["password"];
    	}
                    
       
    	
        $query = mysqli_prepare($con, "SELECT * FROM technicians WHERE email = ? AND password = ?");
        mysqli_stmt_bind_param($query,"ss", $email, $password);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
    	
    	
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION["techID"] = $row["techID"];
                echo "Customer Name: ";
                echo $row["firstName"];
                echo " ";
                echo $row["lastName"];
            }
        } else {
            session_destroy();
            header("location:index.php");
        }
        
	
        
        $query = mysqli_prepare($con, "SELECT * FROM incidents WHERE techID = ? ");
        mysqli_stmt_bind_param($query,"s", $_SESSION["techID"]);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        
		if ($result->num_rows > 0) {
		    echo "<table id='incidentTable' class = 'table table-bordered'> <thead> <tr> <th>Product Code</th> <th>Title</th> <th>Description</th> <th>Edit</th> </tr> </thead> <tbody>";
		    while($row = $result->fetch_assoc()) {
		        echo "<tr id=" . $row['incidentID'] . ">";
		        echo "<td>" . $row['productCode'] . "</td>";
		        echo "<td>" . $row['title'] . "</td>";
		        echo "<td>" . $row['description'] . "</td>";
		        echo "<td>" . '<form method="POST" action="editIncident.php"> <input type="hidden" name="incidentID" value="' . $row["incidentID"] . '"/> <input type="submit" value="Edit" /> </form>' . '</td> </tr>';
		    }
		    echo "</tbody> </table>";
		    
		    
		} else {
		    echo "</br>There are no open incidents for this technician. </br>";
		    echo '<a href="updateIncident.php">Refresh List of Incidents</a> </br>';
		}
		
		// Tell the user who they are logged in as and create a button to use logout.php to log out the user
		
		echo 'You are now logged in as ' . $email;
		echo '<form method="POST" action="logout.php" id="logoutform">';
		echo '<button type="submit" form="logoutform" value="Logout">Logout</button>';
		
		
		
	
	}
	catch (Exception $e) {
	    // save message to session array and redirect user to error page
	    $_SESSION['errorMessage'] = $e->getMessage();
	    $_SESSION['errorCode'] = $e->getCode();
	    header("Location: ../errors/database_error.php");
	}
		
?>
	
</main>

<?php include '../view/footer.php'; ?>