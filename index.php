<?php include 'view/header.php'; 


// Create the session and make sure the session is reset if the browser has been closed

session_set_cookie_params(0);
session_start();
?>
<main>
    <nav>
        
    <h2>Main Menu</h2>
    <ul>
        <li><a href="admin">Administrators</a></li>
        <li><a href="incident_manager">Technicians</a></li>
        <li><a href="product_register">Customers</a></li>
    </ul>
    
    </nav>
</main>
<?php include 'view/footer.php'; ?>