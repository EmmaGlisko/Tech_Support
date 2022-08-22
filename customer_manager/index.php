<?php
//author: Tommy O'Heir
//date: 11/9/21
//edited: 12/1/2021

include '../view/header.php';
session_start();
if($_SESSION["type"] == "admin") {
    ?>

<main>
	<h3>Customer Search</h3>
	<form method="post" action="index.php">
    	<label>Last Name</label>
    	<input type="text" name="last">
    	<input type="submit" name="submit">
	</form>
	
    <?php require('../model/database.php'); 
    
    $last = '';
    
    if (isset($_REQUEST['last'])){
        $last = $_REQUEST['last'];
    }
    
    try {
        // Select all customers with a given last name
        $query = mysqli_prepare($con, "SELECT customerID, firstName, lastName, city, email  FROM customers WHERE lastName=?;");
        mysqli_stmt_bind_param($query,"s", $last);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
    } catch (Exception $e) {
        // save message to session array and redirect user to error page
        $_SESSION['errorMessage'] = $e->getMessage();
        $_SESSION['errorCode'] = $e->getCode();
        header("Location: ../errors/database_error.php");
    }
    
    if ($result->num_rows > 0) {
        // if query resultset contains at least 1 row, do the following:
        echo "<h3>Results</h3>";
        echo "<table>";
        echo "<tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>City</th>
                <th>Email</th>
                <th></th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                      <td>" . $row["firstName"]. "</td>
                      <td>" . $row["lastName"]. "</td>
                      <td>" . $row["city"]. "</td>
                      <td>" . $row["email"]. "</td>
                      <td>".'<form method="post" action="viewCustomer.php?customerID='.$row["customerID"].'">
                             <button type="submit">Select</button></form>'."</td>
                  </tr>";
        }
        echo "</table>";
    }
    mysqli_close($con);
        
    ?>
    
    <br>
    <h3>Add a New Customer</h3>
    <button onclick="location.href='viewCustomer.php'">Add Customer</button>
    
</main>

<?php } else {
    header("location: ../no_permission.php");
}
include '../view/footer.php'?>
