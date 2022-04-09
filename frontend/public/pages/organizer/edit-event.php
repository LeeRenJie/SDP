<?php
	// Connect to database
  include("../../../../backend/conn.php");
  if(!isset($_SESSION)){
    session_start();
  };

  if ($_SESSION['privilege'] != "admin" && $_SESSION['privilege'] != "organizer") {
    echo("<script>alert('You do not have access to this page')</script>");
    header("Location: ../shared/view-event.php");
  };

  // Get event id from url
  $event_id = intval($_SERVER['QUERY_STRING']);
  // get the individual event details
  $event_sql = ("SELECT * FROM event WHERE event_id = '$event_id'");
  $event_result = mysqli_query($con, $event_sql);
  $event_row=mysqli_fetch_array($event_result);
  $event_name = $event_row['event_name'];
  $event_description = $event_row['event_description'];
  $event_date = date("Y-m-d",strtotime($event_row["event_date"]));
  $start_time = date("H:i",strtotime($event_row["start_time"]));
  $end_time = date("H:i",strtotime($event_row["end_time"]));
  $event_pic = $event_row['event_picture'];
  if (is_null($event_pic) || $event_pic == "") {
    $event_pic = "../../images/default.jpg";
  }
  $type = $event_row['participant_type'];
  $max_member = $event_row['max_member'];
  $max_team = $event_row['max_team'];
  $active = $event_row['active'];
  $event_organizer_id = $event_row['organizer_id'];

  // Get organizer id
  $organizer_sql = "SELECT * FROM organizer WHERE user_id = '$_SESSION[user_id]'";
  $organizer_result = mysqli_query($con, $organizer_sql);
  if ($organizer_result){
    $organizer_row = mysqli_num_rows($organizer_result);
  }
  while($row = mysqli_fetch_assoc($organizer_result)){
    $organizer_id = $row["organizer_id"];
  }

  if ($event_organizer_id != $organizer_id) {
    echo("<script>alert('You do not have access to this page')</script>");
    header("Location: ../shared/view-event.php");
  }

  // get the judges' details
  $judge_sql = (
    "SELECT e.event_id, j.judge_name , j.unique_code
    FROM event AS e
    JOIN judges_list AS jl ON e.judges_list_id = jl.judges_list_id
    JOIN judge AS j ON jl.judge_id = j.judge_id
    WHERE e.event_id = '$event_id'"
  );
  $judge_result = mysqli_query($con, $judge_sql);
  $number_judge_row = mysqli_num_rows($judge_result);

   // get the rules
  $rules_sql = (
    "SELECT e.event_id, r.rule
    FROM event AS e
    JOIN rules_list AS rl ON e.rules_list_id = rl.rules_list_id
    JOIN rule AS r ON rl.rule_id = r.rule_id
    WHERE e.event_id = '$event_id'"
  );
  $rules_result = mysqli_query($con, $rules_sql);
  $number_rules_row = mysqli_num_rows($rules_result);

  // get the prizes
  $prize_sql = (
    "SELECT e.event_id, p.prize
    FROM event AS e
    JOIN prizes_list AS pl ON e.prizes_list_id = pl.prizes_list_id
    JOIN prize AS p ON pl.prize_id = p.prize_id
    WHERE e.event_id = '$event_id'"
  );
  $prize_result = mysqli_query($con, $prize_sql);

  // get criteria
  $criteria_sql = "SELECT * FROM criteria where event_id = '$event_id'";
  $criteria_result = mysqli_query($con, $criteria_sql);
  $number_criteria_row = mysqli_num_rows($criteria_result);

  // If event edit execute update sql
  if(isset($_POST["editBtn"])){
    $validated = TRUE;
    // get the data from the form
    // get event picture name
    //if image uploaded
    $uploaded_event_pic = $_FILES['file']['tmp_name'];
    if ($_FILES['file']['size'] > 0){
      $imageFileType = strtolower(pathinfo($uploaded_event_pic,PATHINFO_EXTENSION)); //(Newbedev, 2021)
      //Encode image into base 64
      $base64 = base64_encode(file_get_contents($uploaded_event_pic));
      //create a format of blob image (base64)
      $image = 'data:image/'.$imageFileType.';base64,'.$base64;
    }
    else{
      $image = $event_pic;
    }

    // get event date
    $eventDate = $_POST["event-date"];
    // validation if event date is after today's date
    $today = strtotime(date("m/d/Y"));
    if (strtotime($eventDate) < $today) {
      $validated = FALSE;
      echo('
          <div class="position-absolute bottom-2.5 right-2.5 z-10">
            <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header text-dark">
                <strong class="mr-auto ml-2">Validation Warning</strong>
                <button type="button" class="ml-2 mb-1 close" data-bs-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="toast-body">
                Please select a date that is after today\'s date.
              </div>
            </div>
          </div>
      ');
    };

    // get event start time
    $eventStartTime = $_POST["event-start-time"];
    // get event end time
    $eventEndTime = $_POST["event-end-time"];
    // Validation to check if end time is after start time
    if (strtotime($eventEndTime) < strtotime($eventStartTime)) {
      $validated = FALSE;
      echo('
          <div class="position-absolute bottom-2.5 right-2.5 z-10">
            <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header text-dark">
                <strong class="mr-auto ml-2">Validation Warning</strong>
                <small class="text-gray">now</small>
                <button type="button" class="ml-2 mb-1 close" data-bs-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="toast-body">
                Please select an end time that is after the start time.
              </div>
            </div>
          </div>
      ');
    };

    // get event max participant/team
    $maxPeople = $_POST["max-people"];
    if(!preg_match("/^[0-9]*$/", $maxPeople)){
      $validated = FALSE;
      echo('
        <div class="position-absolute bottom-2.5 right-2.5 z-10">
          <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header text-dark">
              <strong class="mr-auto ml-2">Validation Warning</strong>
              <small class="text-gray">now</small>
              <button type="button" class="ml-2 mb-1 close" data-bs-dismiss="toast" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="toast-body">
              Please only type numeric value for max participants or team.
            </div>
          </div>
        </div>
      ');
    };

    // get event participant type
    $participantType = $_POST['participant-type'];
    $participantType == "solo" ? $participantType="solo" : $participantType="team";
    // if solo max member per team is one, if team get max member per team
    if (isset($_POST['max-members'])) {
      $maxMembers = $_POST["max-members"];
    }
    else{
      $maxMembers = 1;
    };
    if(!preg_match("/^[0-9]*$/", $maxMembers)){
      $validated = FALSE;
      echo('
        <div class="position-absolute bottom-2.5 right-2.5 z-10">
          <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header text-dark">
              <strong class="mr-auto ml-2">Validation Warning</strong>
              <small class="text-gray">now</small>
              <button type="button" class="ml-2 mb-1 close" data-bs-dismiss="toast" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="toast-body">
              Please only type numeric value for max members per team.
            </div>
          </div>
        </div>
      ');
    };

    $prizes = $_POST["prize"];
    foreach($prizes as $key => $prize){
      if($key == 0){
        $first_prize = $prize;
      }
      elseif($key == 1){
        $second_prize = $prize;
      }
      elseif($key == 2){
        $third_prize = $prize;
      }
    }
    // check if prizes are from biggest to smallest
    if(($first_prize <=$second_prize) OR ($first_prize < $third_prize) OR ($second_prize < $third_prize)){
      echo('
        <div class="position-absolute bottom-2.5 right-2.5 z-10">
          <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header text-dark">
              <strong class="mr-auto ml-2">Validation Warning</strong>
              <small class="text-gray">now</small>
              <button type="button" class="ml-2 mb-1 close" data-bs-dismiss="toast" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="toast-body">
              Please enter prizes amount from largest to smallest
            </div>
          </div>
        </div>
      ');
      $validated = FALSE;
    };

    // Create event SQL statement
    if($validated){
      if ($_SESSION['privilege'] == 'admin')
      {
        $getorganizer = "SELECT organizer_id FROM event WHERE event_id = '$event_id'";
        $getorganizer_run = mysqli_query($con, $getorganizer);
        if ($getorganizer_run){
          $getorganizer_row = mysqli_num_rows($getorganizer_run);
        };
        while($row = mysqli_fetch_assoc($getorganizer_run)){
          $organizer_id = $row["organizer_id"];
          var_dump($organizer_id);
        };
      }
      else
      {
        // Get organizer id
        $organizer_sql = "SELECT * FROM organizer WHERE user_id = '$_SESSION[user_id]'";
        $organizer_result = mysqli_query($con, $organizer_sql);
        if ($organizer_result){
          $organizer_row = mysqli_num_rows($organizer_result);
        };
        while($row = mysqli_fetch_assoc($organizer_result)){
          $organizer_id = $row["organizer_id"];
        };
      }

      // get rule list id, judges list id and prizes list id
      $get_lists__sql = "SELECT prizes_list_id, rules_list_id, judges_list_id from event where event_id = '$event_id'";
      $get_lists__query = mysqli_query($con, $get_lists__sql);
      $get_lists__row = mysqli_fetch_array($get_lists__query);
      $get_prizes_list_id = $get_lists__row['prizes_list_id'];
      $get_rules_list_id = $get_lists__row['rules_list_id'];
      $get_judges_list_id = $get_lists__row['judges_list_id'];

      $delete_prizes_sql=(
        "DELETE p
        FROM prize AS p
        RIGHT JOIN prizes_list as pl
        ON p.prize_id = pl.prize_id
        WHERE pl.prizes_list_id = '$get_prizes_list_id';
      ");

      $delete_rules_sql=(
        "DELETE r
        FROM rule AS r
        RIGHT JOIN rules_list as rl
        ON r.rule_id = rl.rule_id
        WHERE rl.rules_list_id = '$get_rules_list_id';
      ");

      $delete_judges_sql=(
        "DELETE j
        FROM judge AS j
        RIGHT JOIN judges_list as jl
        ON j.judge_id = jl.judge_id
        WHERE jl.judges_list_id = '$get_judges_list_id';
      ");

      $delete_prizes_query = mysqli_query($con, $delete_prizes_sql);
      if ($delete_prizes_query){
        $delete_rules_query = mysqli_query($con, $delete_rules_sql);
        if ($delete_rules_query){
          $delete_judges_query = mysqli_query($con, $delete_judges_sql);
          if(!$delete_judges_query){
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

       // loop through event rules array to input same input name into database
      $rules = $_POST["rule"];
      $number_rules = count($_POST["rule"]);

      // get max id of rule list in database
      $max_rule_list_sql = "SELECT MAX(rules_list_id) as max_rule_list_id FROM rules_list";
      $max_rule_list_result = mysqli_query($con, $max_rule_list_sql);
      $max_id_row=mysqli_fetch_array($max_rule_list_result);
      $max_rl_id = $max_id_row['max_rule_list_id'] + 1;
      if ($number_rules > 0) {
        // loop through the array
        foreach ($rules as $rule) {
          // insert the rule into the database
          $rule_sql = "INSERT INTO rule (rule) VALUES ('$rule')";
          // get result
          $rule_result = mysqli_query($con, $rule_sql);
          // check if the query is successful
          if($rule_result){
            // get last inserted rule id
            $last_rule_id = mysqli_insert_id($con);
            // insert the rule id into the rule list
            $rule_list_sql = "INSERT INTO rules_list (rules_list_id, rule_id) VALUES ('$max_rl_id', '$last_rule_id')";
            // get result
            $rule_list_result = mysqli_query($con, $rule_list_sql);
          }
          else{
            die('Error rule: ' . mysqli_error($con));
          }
        };
      }
      else{
        $rule_sql = "INSERT INTO rule (rule) VALUES ('$rules[0]')";
        $rule_result = mysqli_query($con, $rule_sql);
        // check if the query is successful
        if($rule_result){
          // get last inserted rule id
          $last_rule_id = mysqli_insert_id($con);
          // insert the rule id into the rule list
          $rule_list_sql = "INSERT INTO rules_list (rule_id) VALUES ('$last_rule_id')";
          // get result
          $rule_list_result = mysqli_query($con, $rule_list_sql);
        }
        else{
          die('Error rule: ' . mysqli_error($con));
        }
      };
      // get last inserted rules_list_id
      if($rule_list_result){
        $rules_list_id = mysqli_insert_id($con);
        $rules_entered = TRUE;
      }//If the sql fail, notify user
      else{
        $rules_entered = FALSE;
        die('Error rules list: ' . mysqli_error($con));
      };


      // loop through event judges array to input same input name into database
      $judges = $_POST["judge"];
      $number_judges = count($_POST["judge"]);
      // get max id of judges list in database
      $max_judge_list_sql = "SELECT MAX(judges_list_id) as max_judge_list_id FROM judges_list";
      $max_judge_list_result = mysqli_query($con, $max_judge_list_sql);
      $max_id_row= mysqli_fetch_array($max_judge_list_result);
      $max_jl_id = $max_id_row['max_judge_list_id'] + 1;
      if ($number_judges > 0) {
        // loop through the array
        foreach ($judges as $judge) {
          // insert the judge into the database
          // generate unique code
          //random_bytes function in PHP
          $length = random_bytes('5');
          //convert by binaryhexa
          $unique = bin2hex($length);
          $read_unique = "SELECT unique_code FROM judge WHERE unique_code = '$unique'";
          // get result
          $try_unique = mysqli_query($con,$read_unique);
          while(mysqli_num_rows($try_unique) > 0){
            $unique = str_shuffle($unique);
          }
          $judge_sql = "INSERT INTO judge (judge_name, unique_code) VALUES ('$judge', '$unique')";
          // get result
          $judge_result = mysqli_query($con, $judge_sql);
          // check if the query is successful
          if($judge_result){
            // get last inserted judge id
            $last_judge_id = mysqli_insert_id($con);
            // insert the judge id into the judge list
            $judge_list_sql = "INSERT INTO judges_list (judges_list_id, judge_id) VALUES ('$max_jl_id','$last_judge_id')";
            // get result
            $judge_list_result = mysqli_query($con, $judge_list_sql);
          }
          else{
            die('Error judge: ' . mysqli_error($con));
          }
        };
      }
      else{
        $judge_sql = "INSERT INTO judge (judge_name) VALUES ('$judges[0]')";
        $judge_result = mysqli_query($con, $judge_sql);
        // check if the query is successful
        if($judge_result){
          // get last inserted judge id
          $last_judge_id = mysqli_insert_id($con);
          // insert the judge id into the judge list
          $judge_list_sql = "INSERT INTO judges_list (judge_id) VALUES ('$last_judge_id')";
          // get result
          $judge_list_result = mysqli_query($con, $judge_list_sql);
        }
        else{
          die('Error judge: ' . mysqli_error($con));
        }
      };
      // get last inserted judges_list_id
      if($judge_list_result){
        $judges_list_id = mysqli_insert_id($con);
        $judges_entered = TRUE;
      }//If the sql fail, notify user
      else{
        $judges_entered = FALSE;
        die('Error judges list: ' . mysqli_error($con));
      };

      // loop through event prizes array to input same input name into database
      $prizes = $_POST["prize"];
      foreach($prizes as $key => $prize){
        if($key == 0){
          $first_prize = $prize;
        }
        elseif($key == 1){
          $second_prize = $prize;
        }
        elseif($key == 2){
          $third_prize = $prize;
        }
      }
      // check if prizes are from biggest to smallest
      if(($first_prize <=$second_prize) OR ($first_prize < $third_prize) OR ($second_prize < $third_prize)){
        echo('
          <div class="position-absolute bottom-2.5 right-2.5 z-10">
            <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header text-dark">
                <strong class="mr-auto ml-2">Validation Warning</strong>
                <small class="text-gray">now</small>
                <button type="button" class="ml-2 mb-1 close" data-bs-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="toast-body">
                Please enter prizes amount from largest to smallest
              </div>
            </div>
          </div>
        ');
        $prizes_entered = FALSE;
      }
      else{
        // if pass validation insert each prize into database
        // get max id of prizes list in database
        $max_prize_list_sql = "SELECT MAX(prizes_list_id) as max_prize_list_id FROM prizes_list";
        $max_prize_list_result = mysqli_query($con, $max_prize_list_sql);
        $max_id_row=mysqli_fetch_array($max_prize_list_result);
        $max_pl_id = $max_id_row['max_prize_list_id'] + 1;
        foreach ($prizes as $prize) {
          $prize_sql = ("INSERT INTO prize (prize) VALUES ('$prize');");
          $prize_sql .= ("SET @last_prize_id = LAST_INSERT_ID();");
          $prize_sql .= ("INSERT INTO prizes_list (prizes_list_id, prize_id) VALUES ('$max_pl_id', @last_prize_id)");
          if (mysqli_multi_query($con, $prize_sql)) {
            do{} while(mysqli_more_results($con) && mysqli_next_result($con));
          }
        };
        // check if query is successful
        $check_max_prize_list_sql = "SELECT MAX(prizes_list_id) as check_max_prize_list_id FROM prizes_list";
        $check_max_prize_list_result = mysqli_query($con, $check_max_prize_list_sql);
        $check_max_id_row=mysqli_fetch_array($check_max_prize_list_result);
        $check_max_pl_id = $check_max_id_row['check_max_prize_list_id'] + 1;
        if($check_max_pl_id - $max_pl_id == 1){
          $prizes_entered = TRUE;
        }
        else{
          $prizes_entered = FALSE;
          die('Error prizes list: did not insert');
        };
      };

      // get event name
      $eventName = $_POST["event-name"];
      // get event description
      $eventDescription = $_POST["event-description"];

      if($rules_entered && $judges_entered && $prizes_entered){
        $event_sql = (
          "UPDATE event SET
          rules_list_id = '$rules_list_id',
          prizes_list_id = '$max_pl_id',
          judges_list_id = '$judges_list_id',
          organizer_id = '$organizer_id',
          event_name = '$eventName',
          start_time = '$eventStartTime',
          end_time = '$eventEndTime',
          event_description ='$eventDescription',
          event_date = '$eventDate',
          event_picture = '$image',
          participant_type = '$participantType',
          max_member =  '$maxMembers',
          max_team = '$maxPeople',
          active = '1'
          WHERE event_id = '$event_id';"
        );

        // get result
        $event_result = mysqli_query($con, $event_sql);
        if ($event_result){
          // loop through event criteria array to input same input name into database
          $criteria = $_POST["criteria"];
          // Delete criteria that matches event id
          $delete_criteria_sql = "DELETE FROM criteria WHERE event_id = '$event_id'";
          $delete_criteria_result = mysqli_query($con, $delete_criteria_sql);
          $number_criteria = count($_POST["criteria"]);
          if ($number_criteria > 0) {
            foreach ($criteria as $criterion) {
              // Insert SQL statement for criterion to enter one by one
              $criterion_sql = "INSERT INTO criteria (event_id, criteria_name) VALUES ('$event_id', '$criterion')";
              $criterion_result = mysqli_query($con, $criterion_sql);
            };
          };
          // check if the query is successful
          if($criterion_result){
            echo('<script>alert("Event successfully updated")</script>');
            header("Location: ../organizer/event-details.php?$event_id");
          }
          //If the sql fail, notify user
          else
          {
            die('Error: ' . mysqli_error($con));
          }
        }
        //If the sql fail, notify user
        else
        {
          die('Error: ' . mysqli_error($con));
        }
      }
    };
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/create-event.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>Edit Event</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 bg-shadow overflow-auto" style="border-radius:30px;">
      <div class="flex flex-row">
        <span onclick="history.back()" class="pl-5 pt-4 pr-3">
          <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
        </span>
        <h1 class="py-2 inline-block"><b>Edit Event</b></h1>
      </div>
      <form class="row pl-5 mt-3 form-container" method="post" enctype='multipart/form-data' >

        <div class="text-center img-container ml-3">
          <label for=imageUpload>
            <img class="mx-auto d-block img-size shadow-inset" alt="Event Image" id="img" name="img" src="<?php echo $event_pic;?>" />
          </label>
        </div>

        <div class="h-0 overflow-hidden">
          <input id="imageUpload" type="file" name="file" onchange="preimg(img)" capture/>
        </div>
        <label class="btn btn-primary ml-3 mt-3 mb-4 cursor-pointer" for="imageUpload">Choose An Image</label>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event">Event Name</label>
            <input type="text" class="form-control" id="event" name="event-name" placeholder="Enter your event name..." value="<?php echo $event_name ?>">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event-date">Event Date</label>
            <input type="date" class="form-control" id="event-date" name="event-date" placeholder="dd/mm/yy" required="required" value="<?php echo $event_date ?>">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event-time">Event Start Time</label>
            <input type="time" class="form-control" id="event-time" name="event-start-time" placeholder="hh:mm" required="required" value="<?php echo $start_time ?>">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event-time">Event End Time</label>
            <input type="time" class="form-control" id="event-time" name="event-end-time" placeholder="hh:mm" required="required" value="<?php echo $end_time ?>">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="max-people">Max Teams / Participants</label>
            <input type="text" class="form-control" id="max-people" name="max-people" placeholder="Max number of participants or teams..." required="required" value="<?php echo $max_team ?>">
          </div>
        </div>

        <div class="col-6" id="participant-type">
          <div class="form-group mb-4">
            <label for="participant-type">Participant Type</label>
            <select class="custom-select" id="participant-select" name="participant-type" placeholder="Choose..." onchange="disp_sec()">
                <option value="solo" <?php if($type == "solo"){echo "selected";};?> >Solo</option>
                <option value="team" <?php if($type == "team"){echo "selected";};?> >Team</option>
            </select>
          </div>
        </div>

        <div class="col-12 d-none" id="max-member-input">
          <div class="form-group mb-4" >
            <label for="description">Max members</label>
            <input type="text" class="form-control input-disabled" id="max-member" name="max-members" placeholder="Maximum number of members per team..." disabled>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4">
            <label for="description">Event Description</label>
            <textarea class="form-control" id="description" name="event-description" rows="6" placeholder="Enter event description..."><?php echo $event_description ?></textarea>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" id="dynamic_rule">
            <label for="rule">Event Rules</label>
            <?php
              if($number_rules_row > 0 ){
                foreach($rules_result as $i => $rules_row){
                  if ($i==0){
                    echo '<div class="input-group mb-2">';
                      echo '<input type="text" class="form-control" id="rule" name="rule[]" placeholder="Enter rules of the event..."
                      aria-label="Input group" required="required" '.'value="'.$rules_row['rule'].'">';
                      echo '<div class="input-group-append cursor-pointer" id="add_rule" >';
                        echo '<span class="input-group-text">';
                          echo'<button class="fa-solid fa-plus" name="add_rule" type="button"></button>';
                        echo'</span>';
                      echo'</div>';
                    echo'</div>';
                  }
                  elseif ($i > 0)
                  {
                    echo '<div class="input-group mb-2" id="row'.$i.'">';
                      echo'<input type="text" class="form-control" id="rule" name="rule[]" placeholder="Enter rules of the event..."
                      aria-label="Input group" required="required" '.'value="'.$rules_row['rule'].'">';
                      echo'<div class="input-group-append cursor-pointer btn_remove" id="'.$i.'">';
                        echo'<span class="input-group-text">';
                          echo'<button class="fa-solid fa-trash-can" type="button"></button>';
                        echo'</span>';
                      echo'</div>';
                    echo'</div>';
                  };
                };
              };
            ?>
          </div>
        </div>
        <!-- <button class="fa-solid fa-trash-can" type="button"> -->
        <div class="col-12">
          <div class="form-group mb-4">
            <label for="prizes">Event Prizes</label>
            <?php
              if(mysqli_num_rows($prize_result) > 0 ){
                foreach($prize_result as $i => $prizes_row){
                  echo '<div class="input-group mb-1">';
                    echo '<span class="input-group-text">RM</span>';
                    echo '<input type="text" class="form-control mb-1"';
                    echo 'placeholder="';
                    echo $i+1;
                    if ($i == 0) {
                      echo 'st';
                    }elseif ($i == 1) {
                      echo 'nd';
                    }else {
                      echo 'rd';
                    }
                    echo ' Prize"';
                    echo 'required="required" name="prize[]"'.'value="'.$prizes_row['prize'].'">';
                  echo'</div>';
                }
              }
            ?>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" id="dynamic_judge">
            <label for="judge">Judges Name</label>
            <?php
              if($number_judge_row > 0 ){
                foreach($judge_result as $i => $judge_row){
                  if ($i==0){
                    echo '<div class="input-group mb-2">';
                      echo '<input type="text" class="form-control" id="judge" name="judge[]" placeholder="Enter the judge\'s name..."
                      aria-label="Input group" required="required" '.'value="'.$judge_row['judge_name'].'">';
                      echo '<div class="input-group-append cursor-pointer" id="add_judge" >';
                        echo '<span class="input-group-text">';
                          echo'<button class="fa-solid fa-plus" name="add_judge" type="button"></button>';
                        echo'</span>';
                      echo'</div>';
                    echo'</div>';
                  }
                  elseif ($i > 0)
                  {
                    echo '<div class="input-group mb-2" id="row'.$i.'">';
                      echo'<input type="text" class="form-control" id="judge" name="judge[]" placeholder="Enter the judge\'s name..."
                      aria-label="Input group" required="required" '.'value="'.$judge_row['judge_name'].'">';
                      echo'<div class="input-group-append cursor-pointer btn_remove" id="'.$i.'">';
                        echo'<span class="input-group-text">';
                          echo'<button class="fa-solid fa-trash-can" type="button"></button>';
                        echo'</span>';
                      echo'</div>';
                    echo'</div>';
                  };
                };
              };
            ?>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" id="dynamic_criteria">
            <label for="criteria">Criteria</label>
            <?php
              if($number_criteria_row > 0 ){
                foreach($criteria_result as $i => $criteria_row){
                  if ($i==0){
                    echo '<div class="input-group mb-2">';
                      echo '<input type="text" class="form-control" id="criteria" name="criteria[]" placeholder="Enter criteria of the event to judge..."
                      aria-label="Input group" required="required" '.'value="'.$criteria_row['criteria_name'].'">';
                      echo '<div class="input-group-append cursor-pointer" id="add_criteria" >';
                        echo '<span class="input-group-text">';
                          echo'<button class="fa-solid fa-plus" name="add_criteria" type="button"></button>';
                        echo'</span>';
                      echo'</div>';
                    echo'</div>';
                  }
                  elseif ($i > 0)
                  {
                    echo '<div class="input-group mb-2" id="row'.$i.'">';
                      echo'<input type="text" class="form-control" id="criteria" name="criteria[]" placeholder="Enter criteria of the event to judge..."
                      aria-label="Input group" required="required" '.'value="'.$criteria_row['criteria_name'].'">';
                      echo'<div class="input-group-append cursor-pointer btn_remove" id="'.$i.'">';
                        echo'<span class="input-group-text">';
                          echo'<button class="fa-solid fa-trash-can" type="button"></button>';
                        echo'</span>';
                      echo'</div>';
                    echo'</div>';
                  };
                };
              };
            ?>
          </div>
        </div>

        <div class="d-flex justify-content-end mt-2">
          <input class="btn btn-primary w-20 animate-up-2 mr-2" type="submit" name="editBtn" value="Save">
        </div>
      </form>
    </div>
  </div>
  <script>
    function chooseFile(){
      document.getElementById("fileInput").click();
    }

    $(document).ready(function() {
      var i = <?php echo $number_rules_row; ?>;
      var i = i - 1;
      $('#add_rule').click(function() {
        i++;
        $('#dynamic_rule').append('<div class="input-group mb-2" id="row' + i + '"><input type="text" class="form-control" id="rule" name="rule[]" placeholder="Enter rules of the event..." aria-label="Input group" required="required"><div class="input-group-append cursor-pointer btn_remove" id="' + i + '"><span class="input-group-text"><button class="fa-solid fa-trash-can" type="button"></button></span></div></div>')
      });

      $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
        i--;
      });
    });

    $(document).ready(function() {
      var a = <?php echo $number_judge_row;?>;
      var a = a - 1;
      $('#add_judge').click(function() {
        a++;
        $('#dynamic_judge').append('<div class="input-group mb-2" id="row' + a + '"><input type="text" class="form-control" id="judge" name="judge[]" placeholder="Enter judge name..." aria-label="Input group" required="required"><div class="input-group-append cursor-pointer btn_remove_judge" id="' + a + '"><span class="input-group-text"><button class="fa-solid fa-trash-can" type="button"></button></span></div></div>')
      });

      $(document).on('click', '.btn_remove_judge', function() {
        var button_id_judge = $(this).attr("id");
        $('#row'+button_id_judge+'').remove();
        a--;
      });
    });

    $(document).ready(function() {
      var b = <?php echo $number_criteria_row; ?>;
      var b = b - 1;
      $('#add_criteria').click(function() {
        b++;
        $('#dynamic_criteria').append('<div class="input-group mb-2" id="row' + b + '"><input type="text" class="form-control" id="criteria" name="criteria[]" placeholder="Enter criteria of the event to judge..." aria-label="Input group" required="required"><div class="input-group-append cursor-pointer btn_remove_criteria" id="' + b + '"><span class="input-group-text"><button class="fa-solid fa-trash-can" type="button"></button></span></div></div>')
      });

      $(document).on('click', '.btn_remove_criteria', function() {
        var button_id_criteria = $(this).attr("id");
        $('#row'+button_id_criteria+'').remove();
        b--;
      });
    });

    $('select').change(function() {
      if($('select option:selected').text() == "Team") {
        $('.input-disabled').prop("disabled", false);
      }
      else {
        $('.input-disabled').prop("disabled", true);
      };
    });

    //this script use to preview image before upload
    // Nkron, 2014
    function preimg(img) {
      document.getElementById('img').src="../../images/default.jpg";
      var picture = new FileReader();
      if (picture) {
        picture.onload = function(){
          var imgpreview = document.getElementById('img');
          imgpreview.src = picture.result;
        };
        picture.readAsDataURL(event.target.files[0]);
      };
    };

    function disp_sec() {
      var option_value = document.getElementById('participant-select'); //get select id
      var opvalue = option_value.options[option_value.selectedIndex].value; //read value
      if (opvalue === "team"){ //if value = team remove class and add class
        document.getElementById('max-member-input').classList.remove("d-none");
        document.getElementById('max-member').setAttribute('required', 'required');
        document.getElementById('max-member').setAttribute('value', '<?php echo $max_member; ?>');
      }
      else if (opvalue === "solo"){ //if value = solo remove class and add class
        document.getElementById('max-member-input').classList.add("d-none");
        document.getElementById('max-member').setAttribute('required', '');
        document.getElementById('max-member').setAttribute('value', '1');
      }
    }
  </script>
</body>
</html>
