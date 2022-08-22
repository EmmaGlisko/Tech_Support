<?php
// author: Emma Glisko
// date: 12-14-21
// edited: Tommy O'Heir worked on Part I

session_start();
include '../view/header.php';

?>

<main>
	<h2>Register Product</h2>
	<?php require('../model/database.php'); 
	
	try{
	    
	   // Check if variables passed, If so, set the session varibles and the $ variables. If not, do only the latter.
	    if(isset($_REQUEST['email']) && isset($_REQUEST['password'])){
	        $email = $_REQUEST['email'];
	        $password = $_REQUEST['password'];
	        $_SESSION["email"] = $email;
	        $_SESSION["password"] = $password;
	        $_SESSION["type"] = "customer";
    	} else {
    	    $email = $_SESSION["email"];
    	    $password = $_SESSION["password"];
    	}
                    
       
    	// Get the customer name using the email and password and end the session and loop the person back if the info is wrong.
        
        $query = mysqli_prepare($con, "SELECT * FROM customers WHERE email = ? AND password = ?");
        mysqli_stmt_bind_param($query,"ss", $email, $password);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION["customerID"] = $row["customerID"];
                echo "Customer Name: ";
                echo $row["firstName"];
                echo " ";
                echo $row["lastName"];
            }
        } else {
            session_destroy();
            header("location:index.php");
        }
        
	
        // select list of products from db using query within a query to get only products that can still be registered for the specific user
        $query = mysqli_prepare($con, "SELECT * FROM products WHERE productCode NOT IN (SELECT productCode FROM registrations WHERE customerID = ?)");
        mysqli_stmt_bind_param($query,"s", $_SESSION["customerID"]);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
		
		if ($result->num_rows > 0) {
		    
		    echo '<form method="POST" action="productRegistered.php"><select name="product"> ';
		    // put data in a dropdown, setting the productCode as the value and the name as the display information
		    while($row = $result->fetch_assoc()) {
		        echo '<option value="';
		        echo $row["productCode"];
		        echo '">';
                echo $row["name"];
		        echo "</option>";
		    }
		    // create Register Product button to move to productRegistered.php
		    echo '</select></br>
				<input type="submit" name="submit" value="Register Product">
            </form>';
		} else {
		    echo "<tr><td>No records found.</td></tr>";
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