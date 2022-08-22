<?php
// author: Anthony Medugno
// date: 11-17-21
// edited 12-14-21 by Emma Glisko

include '../view/header.php';
session_start();
if($_SESSION["type"] == "admin") {
    ?>
<style>
    label, input {
        margin-right: 10px;
    }

</style>
<main>
	<h2>Get Customer</h2>
		<p>You must enter the customer's email address to select the customer.</p>
		
        <form method="post" action="createIncident.php">
			<label>Email:</label><input type="text" id="email" name="email" value="" required="required"/>
			<input type="submit" value="Get Customer">
		</form>

	<br>		
</main>


<?php } else {
    header("location: ../no_permission.php");
}
include '../view/footer.php'?>