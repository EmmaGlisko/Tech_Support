<?php 

// author: Emma Glisko
// date: 12-14-21

session_start();
include '../view/header.php';

require('../model/database.php'); 

?>
<main>
	<h2>Admin Login</h2>
		
		<!-- Check if the session is set, if not give the form to set username and password. If it is, send user to the admin menu page -->
        <?php if(!isset($_SESSION["type"])) { ?>
            <!-- create box for email input and connect it to registerProduct.php -->
            <form method="post" action="admin_menu.php">
			<label>Username:</label><input type="text" id="username" name="username" value="" required="required"/></br>
			<label>Password:</label><input type="text" id="password" name="password" value="" required="required"/></br>
			<input type="submit" value="Login">
			</form>
        <?php } else if($_SESSION["type"] == "admin"){ 
            header("location:admin_menu.php");
        } else {
            header("location:../no_permission.php");
        }?>
	<br>
	
		
</main>

<?php include '../view/footer.php'; ?>

