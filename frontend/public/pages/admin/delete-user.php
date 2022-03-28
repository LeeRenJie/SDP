<?php
  // start the session
	if(!isset($_SESSION)) {
		session_start();
	};

	// Restrict customer to access this page
  //!=
	//if ($_SESSION['privilege'] == 'participant' OR 'organizer') {
	//	header("Location: ../shared/home.php");
	//};

	// Connect to database
	include("../../../../backend/conn.php");

  // use query string to fetch data from previous page --> "home.php" 
  $user_id = '' ;
  //$user_id = intval($_GET['']);
  $user_id = $_SERVER['QUERY_STRING'];

	// Delete product from database
	$result = mysqli_query($con,"DELETE FROM user WHERE user_id=$user_id");
	// Show alert if product is deleted successfully and redirect to product list page
	if ($result) {
    echo("<script>alert('User is deleted successfully!')</script>");
    echo("<script>window.location = '../admin/users.php'</script>");
	}
	// Display Error
	else {
		die('Error: ' . mysqli_error($con));
	}
	//close database connection
	mysqli_close($con);
?>