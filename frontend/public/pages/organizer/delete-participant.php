<?php
 	// Connect to database
	include("../../../../backend/conn.php");
	// Get event id from url
	$unique_code = intval($_SERVER['QUERY_STRING']);
	// get rule list id, judges list id and prizes list id
	$get_event_id = "SELECT * from team_list where unique_code = '$unique_code'";
	$event_id_query = mysqli_query($con, $get_event_id);
	$get_id_row = mysqli_fetch_array($event_id_query);
	$event_id = $get_id_row['event_id'];

	// Delete participant/team
	$delete_particiant_result = mysqli_query($con,"DELETE FROM team_list WHERE unique_code=$unique_code");

  if ($delete_particiant_result){
    echo("<script>alert('Participant deleted successfully.');</script>");
  }
  else{
    die('Error deleting participant: ' . mysqli_error($con));
  }


	// Close connection
	mysqli_close($con);
	// Redirect to cart page
	header('Location: ../organizer/event-details.php?'.$event_id);
?>