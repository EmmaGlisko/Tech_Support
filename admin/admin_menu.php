<?php
// author: Emma Glisko
// date: 12-14-21

session_start();
include '../view/header.php';

?>

<main>
	<h2>Admin Menu</h2>
	<?php require('../model/database.php'); 
  
	// Check if the username and password have been passed. If they have, set the session username and
	// password to the username and password and set the $username and $password variables. If not, do only the latter.
    	if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
    	    $username = $_REQUEST['username'];
    	    $password = $_REQUEST['password'];
    	    $_SESSION["username"] = $username;
    	    $_SESSION["password"] = $password;
    	    $_SESSION["type"] = "admin";
    	} else {
    	    $username = $_SESSION["username"];
    	    $password = $_SESSION["password"];
    	}
                    
       
    	// Get the admin name using the username and password and a query with a reversion back to the index if 
    	// there is no admin with that username and password.
    	try {
        $query = mysqli_prepare($con, "SELECT * FROM administrators WHERE username = ? AND password = ?");
        mysqli_stmt_bind_param($query,"ss", $username, $password);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        
    	}catch (Exception $e) {
            // save message to session array and redirect user to error page
            $_SESSION['errorMessage'] = $e->getMessage();
            $_SESSION['errorCode'] = $e->getCode();
            header("Location: ../errors/database_error.php");
        }
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <ul style="padding-left: 30px;">
                    <li><a href="../product_manager">Manage Products</a></li>
                    <li><a href="../technician_manager">Manage Technicians</a></li>
                    <li><a href="../customer_manager">Manage Customers</a></li>
                    <li><a href="../incident_create">Create Incident</a></li>
                    <li><a href="../under_construction.php">Assign Incident</a></li>
                    <li><a href="../under_construction.php">Display Incidents</a></li>
                </ul>
                
                
                <?php
                echo "<h2>Login Status</h2>";
                echo "You are logged in as : " . $row["username"];
                
            }
        } else {
                session_destroy();
                header("location:index.php");
            }
    
    ?>
   <form method="POST" action="logout.php" id="logoutform">
   <button type="submit" form="logoutform" value="Logout">Logout</button>
		
    
</main>
<?php include '../view/footer.php'; ?>