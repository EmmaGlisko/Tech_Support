<?php 

// author: Emma Glisko
// date: 12-14-21
include 'view/header.php';
session_start();
?>
<main>
    <nav>
        
    <h2>No Permission</h2>
    You do not have permission to enter this page. Log out using the button below or return to home.
    
    <form method="POST" action="logout.php" id="logoutform">
	<button type="submit" form="logoutform" value="Logout">Logout</button>
		
    
    </nav>
</main>
<?php include 'view/footer.php'; ?>