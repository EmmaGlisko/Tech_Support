<?php
// author: Emma Glisko
// date: 12-14-21

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
	<h2>Add Product</h2>
	
	<!-- Form for adding a product -->
	<form method="post" action="addProduct.php">
		<label>Product Code:</label><input type="text" id="productCode" name="productCode" value="" required="required"/><br>
		<label>Name:</label><input type="text" id="name" name="name" value="" required="required"/><br>
		<label>Version:</label><input type="text" id="version" name="version" value="" required="required"/><br>
		<label>Release Date:</label><input type="text" id="releaseDate" name="releaseDate" value="" required="required"/><label>Use 'yyyy-mm-dd' format</label><br>
		<label></label><input type="submit" value="Add Product">
	</form>
		
	<br>
	<a href="index.php">View Product List</a>
	
</main>
<?php } else {
    header("location: ../no_permission.php");
}
include '../view/footer.php'?>