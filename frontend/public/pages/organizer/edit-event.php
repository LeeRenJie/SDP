<?php
	// Connect to database
  include("../../../../backend/conn.php");
  if(!isset($_SESSION)){
    session_start();
  };
  if ($_SESSION['privilege'] != "admin" && $_SESSION['privilege'] != "organizer") {
    echo("<script>alert('You do not have access to this page')</script>");
    header("Location: ../shared/view-event.php");
    header("Location: ../customer/home.php");
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
  if ($event_pic == "" || $event_pic == NULL) {
    $event_pic = "../../images/default.jpg";
  }
  $type = $event_row['participant_type'];
  $max_member = $event_row['max_member'];
  $max_team = $event_row['max_team'];
  $active = $event_row['active'];

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
        <h1 class="py-2 inline-block"><b>Edit Event</b></h1>
      </div>
      <div class="text-center img-container ml-5">
        <label for=imageUpload>
          <img src="../../images/default.jpg" class="cursor-pointer mx-auto d-block img-size shadow-inset"
          data-toggle="tooltip" data-placement="bottom" title="Recommended image size is 1100 x 480" id="img" name="eventPic" alt="Event Image">
        </label>
      </div>
      <div class="h-0 overflow-hidden">
        <input id="imageUpload" type="file" name="eventPic" onchange="preimg(img)" capture/>
      </div>
      <label class="btn btn-primary ml-5 mt-3 mb-4 cursor-pointer" for="imageUpload">Choose An Image</label>
      <form class="row pl-5 mt-3 form-container">

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event">Event Name</label>
            <input type="text" class="form-control" id="event" placeholder="Enter your event name..." value="<?php echo $event_name ?>">
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
            <input type="time" class="form-control" id="event-time" name="event-time" placeholder="hh:mm" required="required" value="<?php echo $start_time ?>">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event-time">Event End Time</label>
            <input type="time" class="form-control" id="event-time" name="event-time" placeholder="hh:mm" required="required" value="<?php echo $end_time ?>">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="max-people">Max Teams / Participants</label>
            <input type="text" class="form-control" id="max-people" name="max-people" placeholder="Max number of participants or teams..." required="required" value="<?php echo $max_team ?>">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="participant-type">Participant Type</label>
            <select class="custom-select" id="particpant-type" placeholder="Choose...">
                <option value="solo" <?php if($type == "solo"){echo "selected";};?> >Solo</option>
                <option value="team" <?php if($type == "team"){echo "selected";};?> >Team</option>
            </select>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" >
            <label for="description">Max members</label>
            <input type="text" class="form-control input-disabled" id="max-member" name="max-member" placeholder="Maximum number of members per team..." required="required" disabled value="<?php echo $max_member; ?>">
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4">
            <label for="description">Event Description</label>
            <textarea class="form-control" id="description" rows="6" placeholder="Enter event description...">
              <?php echo $event_description ?>
            </textarea>
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
          <input class="btn btn-primary w-20 animate-up-2 mr-2" type="submit" name="editBtn" value="Edit">
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
  </script>
</body>
</html>
