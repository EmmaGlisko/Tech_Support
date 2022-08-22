<?php
// author: Emma Glisko
// date: 12-14-21

session_start();

include '../view/header.php';

?>

<main>
	<h2>Technician Login</h2>
		
		<!-- Check if the session is set, if not give the form to set email and password. If it is, send user to the register product page -->
        <?php if(!isset($_SESSION["type"])) { ?>
            <!-- create box for email input and connect it to registerProduct.php -->
            <form method="post" action="updateIncident.php">
			<label>Email:</label><input type="text" id="email" name="email" value="" required="required"/></br>
			<label>Password:</label><input type="text" id="password" name="password" value="" required="required"/></br>
			<input type="submit" value="Login">
			</form>
        <?php } else if($_SESSION["type"] == "technician"){ 
            header("location:updateIncident.php");
        } else {
            header("location:../no_permission.php");
        }?>
	<br>
	
		
</main>


<?php include '../view/footer.php'; ?>