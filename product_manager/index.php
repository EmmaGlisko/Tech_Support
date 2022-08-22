<?php
// author: Emma Glisko
// date: 12-14-21

include '../view/header.php';
session_start();
if($_SESSION["type"] == "admin") {
?>

<main>
	<h2>Product List</h2>
	
	<!-- table for list of products -->
	<table>
		<tr>
			<th>Product Code</th>
			<th>Name</th>
			<th>Version</th>
			<th>Release Date</th>
			<th></th>			
		</tr>
		
		<?php require('../model/database.php');
         
		try{
		
        /* select list of products from database */
           
		$sql = "SELECT * FROM products";
		
		$result = $con->query($sql);
		}
		catch (Exception $e) {
		    // save message to session array and redirect user to error page
		    $_SESSION['errorMessage'] = $e->getMessage();
		    $_SESSION['errorCode'] = $e->getCode();
		    header("Location: ../errors/database_error.php");
		}
		
		// check number of records found
		if ($result->num_rows > 0) {
		    		    
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<tr>
              <td>" . $row["productCode"]. "</td>
              <td>" . $row["name"]. "</td>
              <td>" . $row["version"]. "</td>
              <td>" . $row["releaseDate"]. "</td>
              <td>"."
                <form onsubmit='return checkDelete(this);' method='post' action='deleteProduct.php?productCode={$row["productCode"]}'>
                     <button type='submit'>Delete</button>
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
	<a href="addProductForm.php">Add Product</a>

<script>
function checkDelete(first, last) {
	return confirm('Are you sure you want to delete this product?');
}
</script>

</main>

<?php } else {
    header("location: ../no_permission.php");
}
include '../view/footer.php'?>