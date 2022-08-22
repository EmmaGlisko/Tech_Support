<?php
// author: Emma Glisko
// date: 11-14-21

session_start();
include '../view/header.php';
?>
<main>
	<h2>Register Product</h2>
	
	<?php require('../model/database.php'); 
	
	/* get the product code and relay it back to the user */
	
    $getProduct = $_POST['product'];
    $customer = $_SESSION['customerID'];
    $date = date('Y-m-d h:i:s');
    
    try{
    $query = mysqli_prepare($con, "INSERT INTO registrations VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($query,"sss", $customer, $getProduct, $date);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    } catch (Exception $e) {
        // save message to session array and redirect user to error page
        $_SESSION['errorMessage'] = $e->getMessage();
        $_SESSION['errorCode'] = $e->getCode();
        header("Location: ../errors/database_error.php");
    }
    
    echo "Product (".$getProduct.") was registered successfully.";
	?>
</main>
<?php include '../view/footer.php'; ?>