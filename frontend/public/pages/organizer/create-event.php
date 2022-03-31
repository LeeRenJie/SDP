<?php
	// Connect to database
  include("../../../../backend/conn.php");

  // start the session
  if(!isset($_SESSION)) {
    session_start();
  };

  // Restrict customer to access this page
  if ($_SESSION['privilege'] != "organizer") {
    echo("<script>alert('You do not have access to this page')</script>");
    header("Location: ../shared/view-event.php");
  };


  if(isset($_POST["createBtn"])){
    $validated = TRUE;
    // get the data from the form
    // get event picture name
    if(isset($_FILES['eventPic'])){
      $eventPicture = $_FILES['eventPic']['tmp_name'];
      if ($_FILES['eventPic']['size'] > 0){
        //get image type
        $imageFileType = strtolower(pathinfo($eventPicture,PATHINFO_EXTENSION)); //(Newbedev, 2021)
        //encode image into base64
        $base64_Img = base64_encode(file_get_contents($eventPicture));
        //set image content with type and base64
        $image = 'data:image/'.$imageFileType.';base64,'.$base64_Img;
      }
    }
    else {
      // event pic is null if no image is uploaded
      //Set default image
      $defaultPic = "../../images/default.jpg";
      //Read default image file type (as jpg)
      $imageFileType = strtolower(pathinfo($defaultPic,PATHINFO_EXTENSION)); //(Newbedev, 2021)
      //Encode default image into base 64
      $defaultImg = base64_encode(file_get_contents($defaultPic));
      //create a format of blob image (base64)
      $image = 'data:image/'.$imageFileType.';base64,'.$defaultImg;
    }

    // get event date
    $eventDate = $_POST["event-date"];
    // validation if event date is after today's date
    $today = strtotime(date("d/m/Y"));
    if (strtotime($eventDate) < $today) {
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
    if (isset($_POST['name'])) {
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

    // Create event SQL statement
    if($validated){
      // Get organizer id
      $organizer_sql = "SELECT * FROM organizer WHERE user_id = '$_SESSION[user_id]'";
      $organizer_result = mysqli_query($con, $organizer_sql);
      if ($organizer_result){
        $organizer_row = mysqli_num_rows($organizer_result);
      };
      while($row = mysqli_fetch_assoc($organizer_result)){
        $organizer_id = $row["organizer_id"];
      };

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
          "INSERT INTO event (rules_list_id, prizes_list_id, judges_list_id,
          organizer_id, event_name, start_time, end_time, event_description,
          event_date, event_picture, participant_type, max_member, max_team, active)
          VALUES ('$rules_list_id', '$max_pl_id', '$judges_list_id', '$organizer_id',
          '$eventName', '$eventStartTime', '$eventEndTime', '$eventDescription', '$eventDate',
          '$image', '$participantType', '$maxMembers', '$maxPeople', '1')"
        );

        // get result
        $event_result = mysqli_query($con, $event_sql);
        if ($event_result){
          // get last inserted event id
          echo('<script>alert("judges added successfully"</script>');
          $event_id = mysqli_insert_id($con);
          // loop through event criteria array to input same input name into database
          $criteria = $_POST["criteria"];
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
            echo('<script>alert("criteria successfully created"</script>');
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
  };
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/create-event.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>Create Event</title>
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
        <h1 class="py-2 inline-block"><b>Tell Us About Your Event</b></h1>
      </div>
      <form method="post" class="row pl-5 mt-3 form-container">
        <div class="col-12">
          <div class="text-center img-container">
            <label for=imageUpload>
              <img src="../../images/default.jpg" class="cursor-pointer mx-auto d-block img-size shadow-inset"  id="img" name="img" alt="Event Image">
            </label>
          </div>

          <div class="h-0 overflow-hidden">
            <input id="imageUpload" type="file" name="eventPic" onchange="preimg(img)" capture/>
          </div>
          <label class="btn btn-primary mt-3 mb-4 cursor-pointer" for="imageUpload">Choose An Image</label>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event">Event Name</label>
            <input type="text" class="form-control" id="event" name="event-name"  placeholder="Enter your event name..." maxlength="100">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event-date">Event Date</label>
            <input type="date" class="form-control" id="event-date" name="event-date" placeholder="dd/mm/yy" required="required">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event-time">Event Start Time</label>
            <input type="time" class="form-control" id="event-start-time" name="event-start-time" placeholder="hh:mm" required="required">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event-time">Event End Time</label>
            <input type="time" class="form-control" id="event-end-time" name="event-end-time" placeholder="hh:mm" required="required">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="max-people">Max Teams / Participants</label>
            <input type="text" class="form-control" id="max-people" name="max-people" placeholder="Maximum number of participants or teams..." required="required">
          </div>
        </div>

        <div class="col-6" id="participant-type">
          <div class="form-group mb-4">
            <label for="participant-type">Participant Type</label>
            <select class="custom-select" id="particpant-type" name="participant-type" placeholder="Choose...">
                <option value="solo">Solo</option>
                <option value="team">Team</option>
            </select>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" >
            <label for="description">Max members</label>
            <input type="text" class="form-control input-disabled" id="max-member" name="max-members" placeholder="Maximum number of members per team..." disabled>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4">
            <label for="description">Event Description</label>
            <textarea class="form-control" id="description" rows="6" name="event-description" placeholder="Enter event description..." maxlength="1000"></textarea>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" id="dynamic_rule">
            <label for="rule">Event Rules</label>
            <div class="input-group mb-2">
              <input type="text" class="form-control" id="rule" name="rule[]" placeholder="Enter rules of the event..." aria-label="Input group" required="required">
              <div class="input-group-append cursor-pointer" id="add_rule" >
                <span class="input-group-text">
                  <button class="fa-solid fa-plus" name="add_rule" type="button"></button>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4">
            <label for="prizes">Event Prizes</label>
            <div class="input-group mb-1">
              <span class="input-group-text">RM</span>
              <input type="text" class="form-control mb-1" name="prize[]" placeholder="1st Prize" required="required">
            </div>
            <div class="input-group mb-1">
              <span class="input-group-text">RM</span>
              <input type="text" class="form-control mb-1" name="prize[]" placeholder="2nd Prize" required="required">
            </div>
            <div class="input-group mb-1">
              <span class="input-group-text">RM</span>
              <input type="text" class="form-control mb-1" name="prize[]" placeholder="3rd Prize" required="required">
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" id="dynamic_judge">
            <label for="judge">Judges Name</label>
            <div class="input-group mb-2">
              <input type="text" class="form-control" id="judge" name="judge[]" placeholder="Enter the judge's name..." aria-label="Input group" required="required">
              <div class="input-group-append cursor-pointer" id="add_judge">
                <span class="input-group-text">
                  <button class="fa-solid fa-plus" name="add_judge" type="button"></button>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" id="dynamic_criteria">
            <label for="criteria">Criteria</label>
            <div class="input-group mb-2">
              <input type="text" class="form-control" id="criteria" name="criteria[]" placeholder="Enter criteria of the event to judge..." aria-label="Input group" required="required">
              <div class="input-group-append cursor-pointer" id="add_criteria">
                <span class="input-group-text">
                <button class="fa-solid fa-plus" name="add_criteria" type="button"></button>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-end mt-2">
          <input class="btn btn-primary animate-up-2 mr-2" type="submit" name="createBtn" value="Create">
        </div>
      </form>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      var i = 1;
      $('#add_rule').click(function() {
        i++;
        $('#dynamic_rule').append('<div class="input-group mb-2" id="row' + i + '"><input type="text" class="form-control" id="rule" name="rule[]" placeholder="Enter rules of the event..." aria-label="Input group" required="required"><div class="input-group-append cursor-pointer btn_remove" id="button'+i+'"><span class="input-group-text"><button class="fa-solid fa-trash-can" type="button"></button></span></div></div>')
      });

      $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        var id = button_id.replace('button','');
        $('#row'+id+'').remove();
        i--;
      });
    });

    $(document).ready(function() {
      var a = 1;
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
      var b = 1;
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
  </script>
</body>
</html>
