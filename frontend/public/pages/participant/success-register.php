<?php
  //Connection to Database
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");
  // start the session
  if(!isset($_SESSION)) {
    session_start();
  }

  //get user id from url
  $userid = $_SESSION['user_id'];
  //get event id from url
  $event_id = intval($_SERVER['QUERY_STRING']);

  //Query to get all event data
  $event_query = "SELECT * FROM event
                  INNER JOIN organizer ON event.organizer_id = event.organizer_id
                  INNER JOIN user ON organizer.user_id = user.user_id
                  WHERE event.event_id = $event_id ";
  $run_event_query = mysqli_query($con, $event_query);
  $event_data = mysqli_fetch_assoc($run_event_query);

  $user_query = "SELECT * FROM team_list
  INNER JOIN participant ON participant.participant_id = team_list.participant_id
  INNER JOIN user ON participant.user_id = user.user_id
  WHERE event_id =' $event_id'
  AND user.user_id = '$userid'";
  // Execute the query
  $user_query_run = mysqli_query($con, $user_query);
  // Fetch data
  $userdata = mysqli_fetch_assoc($user_query_run);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/participant-success-register.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Registered Event</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto back-shadow" style="border-radius:30px;">
      <div class="main-container">
        <div class ="btn-row">
          <div class="infront">
            <a href='../shared/view-event.php'>
              <button class="btn btn-primary animate-up-2 btn_cont fa-2xl m-5" type="button">
                <i class="fa-solid fa-house "></i>
              </button>
            <a>
          </div>
        </div>
        <div class="details-cont">
          <h2>Your Registration is Completed</h2>
          <div class="col-box">
            <div class="details-box"> <!--display registration details-->
              <div class="row">
                <label for="event-name" class="col-sm-6 col-form-label"> <!--showing event name-->
                  Event Name
                </label>
                <p class="col-sm-6 col-form-label" id="event-name" name="event-name">
                  <?php echo ($event_data['event_name'])?>
                </p>
              </div>
              <div class="row">
                <label for="event-date" class="col-sm-6 col-form-label"> <!--event date-->
                  Event Date
                </label>
                <p class="col-sm-6 col-form-label" id="event-date" name="event-date">
                  <?php echo ($event_data['event_date'])?>
                </p>
              </div>
              <div class="row">
                <label for="event-time" class="col-sm-6 col-form-label"> <!--event time-->
                  Event Time
                </label>
                <p class="col-sm-6 col-form-label" id="event-time" name="event-time">
                  <?php echo ($event_data['start_time'])?>
                </p>
              </div>
              <div class="row">
                <label for="orgn-email" class="col-sm-6 col-form-label"> <!--event email-->
                  Organizer Email
                </label>
                <p class="col-sm-6 col-form-label" id="orgn-email" name="orgn-email">
                  <?php echo ($event_data['email'])?>
                </p >
              </div>
              <div class="row">
                <label for="orgn-tel" class="col-sm-6 col-form-label"> <!--event tel, add href-->
                  Organizer Telephone
                </label>
                <p class="col-sm-6 col-form-label" id="orgn-tel" name="orgn-tel">
                  <?php echo ($event_data['telephone'])?>
                </p>
              </div>
            </div>
            <div class = "unique-cont">
              <div class="row">
                <label for="unq-code" class="col-sm-6 col-form-label"> <!--showing unique code-->
                  Unique Code
                </label>
                <div class="col-6">
                  <p class="col-sm col-form-label animate-up-2" id="unq-code" name="unq-code">
                    <?php echo ($userdata['unique_code'])?>
                  </p>
                </div>
              </div>
            </div>
          </div> <!--col-box-->
        </div>
        <div class = "hint-cont">
          <p>Hint: Unique Code is to check result and act as a referral code for your team members if it is a team event.</p>
        </div>
      </div> <!--main-container-->
    </div>
  </div>
</body>
</html>