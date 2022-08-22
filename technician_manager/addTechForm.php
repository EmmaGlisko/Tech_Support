<?php 
// author: Anthony Medugno
// date: 10-23-21
// editied 12-14-21 by Emma Glisko

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
	<h2>Add Technician</h2>
	
	<!-- Form for adding a technician -->
	<form method="post" action="addTech.php">
		<label>First Name:</label><input type="text" id="firstName" name="firstName" value="" required="required"/><br>
		<label>Last Name:</label><input type="text" id="lastName" name="lastName" value="" required="required"/><br>
		<label>Email:</label><input type="text" id="email" name="email" value="" required="required"/><br>
		<label>Phone:</label><input type="text" id="phone" name="phone" value="" required="required"/><br>
		<label>Password:</label><input type="text" id="password" name="password" value="" required="required"/><br>
		<label></label><input type="submit" value="Add Technician">
	</form>
		
	<br>
	<a href="index.php">View Technician List</a>
	
</main>
<?php } else {
    header("location: ../no_permission.php");
}
include '../view/footer.php'?>