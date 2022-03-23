<link rel="stylesheet" href="../../../src/stylesheets/admin-delete-user.css">
<link rel="stylesheet" href="../../../src/stylesheets/neumorphism.css">
<?php
  // start the session
	if(!isset($_SESSION)) {
		session_start();
	};

	// Restrict customer to access this page
  //!=
	//if ($_SESSION['privilege'] == "participant" OR "organizer") {
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
    header('Refresh:2; url=http://localhost:8080/SDP/frontend/public/pages/admin/users.php');
		//start of toast message
    ?>
    <div class="toast_css">
      <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header text-dark">
            <strong class="mr-auto ml-2">Toast Message</strong>
            <small>1 mins ago</small>
            <button type="button" class="ml-2 mb-1 close" data-bs-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="toast-body">
          User is successfully deleted!
        </div>
      </div>
    </div>
    <?php
    //end of toast message
	}
	// Display Error
	else {
		die('Error: ' . mysqli_error($con));
	}
	//close database connection
	mysqli_close($con);
?>