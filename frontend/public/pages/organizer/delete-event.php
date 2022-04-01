<?php
 	// Connect to database
	include("../../../../backend/conn.php");
	// Get event id from url
	$event_id = intval($_SERVER['QUERY_STRING']);
	// get rule list id, judges list id and prizes list id
	$get_lists__sql = "SELECT prizes_list_id, rules_list_id, judges_list_id from event where event_id = '$event_id'";
	$get_lists__query = mysqli_query($con, $get_lists__sql);
	$get_lists__row = mysqli_fetch_array($get_lists__query);
	$prizes_list_id = $get_lists__row['prizes_list_id'];
	$rules_list_id = $get_lists__row['rules_list_id'];
	$judges_list_id = $get_lists__row['judges_list_id'];
	echo ($prizes_list_id);
	echo ($rules_list_id);
	echo ($judges_list_id);

	// Delete event
	$delete_event_result = mysqli_query($con,"DELETE FROM event WHERE event_id=$event_id");

	// Delete rules, prizes and judges
	if ($delete_event_result){
		$delete_prizes_sql=(
			"DELETE p
			FROM prize AS p
			RIGHT JOIN prizes_list as pl
			ON p.prize_id = pl.prize_id
			WHERE pl.prizes_list_id = '$prizes_list_id';
		");

		$delete_rules_sql=(
			"DELETE r
			FROM rule AS r
			RIGHT JOIN rules_list as rl
			ON r.rule_id = rl.rule_id
			WHERE rl.rules_list_id = '$rules_list_id';
		");

		$delete_judges_sql=(
			"DELETE j
			FROM judge AS j
			RIGHT JOIN judges_list as jl
			ON j.judge_id = jl.judge_id
			WHERE jl.judges_list_id = '$judges_list_id';
		");

		$delete_prizes_query = mysqli_query($con, $delete_prizes_sql);
		if ($delete_prizes_query){
			$delete_rules_query = mysqli_query($con, $delete_rules_sql);
			if ($delete_rules_query){
				$delete_judges_query = mysqli_query($con, $delete_judges_sql);
				if($delete_judges_query){
					echo("<script>alert('Event deleted successfully.');</script>");
				}
				else{
					die('Error delete judges: ' . mysqli_error($con));
				}
			}
			else{
				die('Error delete rules: ' . mysqli_error($con));
			}
		}
		else{
			die('Error delete prizes: ' . mysqli_error($con));
		}
	}
	else{
		die('Error delete event: ' . mysqli_error($con));
	}

	// Close connection
	mysqli_close($con);
	// Redirect to cart page
	// header('Location: ../organizer/my-event.php');
?>