<?php
  //Connection to Database
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");
  // start the session
  if(!isset($_SESSION)) {
    session_start();
  }

  //get user id from session
  $userid = $_SESSION['user_id'];
  //get event id from url
  $event_id = intval($_SERVER['QUERY_STRING']);

  // get the individual event details
  $evt_des = mysqli_query($con,
    "SELECT * FROM event
    WHERE event_id = $event_id");
  // get result 
  $event_des = mysqli_fetch_assoc($evt_des);
  
  //get rule details
  $evt_rules = "SELECT rule FROM rules_list
  INNER JOIN rule ON rule.rule_id = rules_list.rule_id
  INNER JOIN event on rules_list.rules_list_id = event.rules_list_id
  WHERE event_id = $event_id";
  // get result 
  $event_rules = mysqli_query($con,$evt_rules);
  
  //count rule
  $num_rules_query = mysqli_query($con,
    "SELECT COUNT(rule) FROM rules_list
    INNER JOIN rule ON rule.rule_id = rules_list.rule_id
    INNER JOIN event on rules_list.rules_list_id = event.rules_list_id
    WHERE event_id = $event_id");
  // get result 
  $num_rules = mysqli_fetch_assoc($num_rules_query);

  //user data
  $user_query = "SELECT * FROM user
  INNER JOIN participant ON user.user_id = participant.user_id
  WHERE user.user_id = $userid";
  // Execute the query
  $user_query_run = mysqli_query($con, $user_query);
  // Fetch data
  $userdata = mysqli_fetch_assoc($user_query_run);

  $participate = "SELECT * FROM team_list
                INNER JOIN participant ON participant.participant_id = team_list.participant_id
                INNER JOIN user ON participant.user_id = user.user_id
                WHERE event_id =' $event_id'
                AND user.user_id = '$userid'";
  $run_participated =  mysqli_query($con, $participate);
  //event query
  $evt_query = "SELECT * FROM event 
  WHERE event_id = $event_id";
  $event_query_run = mysqli_query($con, $evt_query);
  // Fetch data
  $event_query = mysqli_fetch_assoc($event_query_run);

  //if regsiter btn
  if (isset($_POST['registerBtn'])) {
    //random_bytes () function in PHP
    $length = random_bytes('3');
    //convert by binaryhexa
    $unique = bin2hex($length);
    $read_unique = "SELECT unique_code FROM team_list WHERE unique_code = '$unique'";
    // get result 
    $try_unique = mysqli_query($con,$read_unique);
    if(mysqli_num_rows($try_unique) == 0){
      //submit data
      if($event_query['participant_type'] == "team") {
        $participant_id = $userdata['participant_id'];
        $ipt_event = $event_id;
        $team_name = $_POST['team_name'];
        $ipt_uni_code = $unique;
        $sql = "INSERT INTO team_list (participant_id, event_id, team_name, unique_code)
                VALUES ('$participant_id', '$ipt_event', '$team_name', '$ipt_uni_code')";
        $result = mysqli_query($con, $sql);
        echo("<script>alert('Participated Successful');</script>");
        echo("<script>window.location = 'success-register.php'</script>");
      }
      elseif($event_query['participant_type'] == "solo") {
        $participant_id = $userdata['participant_id'];
        $ipt_event = $event_id;
        $team_name = $userdata['username'];
        $ipt_uni_code = $unique;
        $sql = "INSERT INTO team_list (participant_id, event_id, team_name, unique_code)
                VALUES ('$participant_id', '$ipt_event', '$team_name', '$ipt_uni_code')";
        $result = mysqli_query($con, $sql);
        echo("<script>alert('Participated Successful');</script>");
        echo("<script>window.location = 'success-register.php'</script>");
      }
      else{
        echo("<script>alert('Try Again');</script>");
      }
    }
    else{
      echo("<script>alert('Try Again');</script>");
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/participant-register-event.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Register Event</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto back-shadow" style="border-radius:30px;">
      <div class="main-container">
        <h2>Registration <?php echo ($event_query['event_name'])?></h2>
        <div class="event-details">
          <div class="left-cont">
            <div class="description">
              <span>
                <i class="fa-solid fa-message"></i>
                Event Description
              </span>
              <div class="details-cont">
                <p><?php echo ($event_des['event_description'])?>
                </p>
              </div>
            </div>
            <div class="rules">
              <span>
                <i class="fa-solid fa-scroll"></i>
                Rules
              </span>
              <div class="details-cont">
                <?php
                if(mysqli_num_rows($event_rules) > 0){
                  foreach($event_rules as $evt_rules){
                    echo "<p> • $evt_rules[rule] </p>";
                  }
                }
                ?>
              </div>
            </div>
          </div>
          <div class="right-cont">
            <div class="row py-2">
              <label for="username" class="col-sm-6 col-form-label"> <!--showing user default username details-->
                Username
              </label>
              <p class="col-sm-6 col-form-label" id="username" name="username">
              <?php echo ($userdata['username'])?>
              </p>
            </div>
            <div class="row py-2">
              <label for="name" class="col-sm-6 col-form-label"> <!--showing user default name details-->
                Name
              </label>
              <p class="col-sm-6 col-form-label" id="name" name="name">
              <?php echo ($userdata['name'])?>
              </p>
            </div>
            <div class="row py-2">
              <label for="email" class="col-sm-6 col-form-label"> <!--showing user default email details-->
                Email
              </label>
              <p class="col-sm-6 col-form-label" id="email" name="email">
              <?php echo ($userdata['email'])?>
              </p>
            </div>
            <div class="row py-2">
              <label for="telephone" class="col-sm-6 col-form-label"> <!--showing user default details-->
                Telephone
              </label>
              <p class="col-sm-6 col-form-label" id="telephone" name="telephone">
              <?php echo ($userdata['telephone'])?>
              </p>
            </div>
            <?php
            if($event_query['participant_type'] == "team") {
              echo '<div class="row py-2">';
                echo '<label for="team-role" class="col-sm-6 col-form-label">';
                  echo 'Team Role ';
                echo '</label>';
                  echo '<select class="custom-select col-sm-6 btn sel" onchange="disp_sec()" id="team_role">';
                    echo '<option class="al" disabled selected>Please Select</option>';
                    echo '<option class="al" value="leader" >Leader</option>';
                    echo '<option class="al" value="member" >Member</option>';
                  echo '</select>';
              echo '</div>';
              // team name for team leader
              echo '<div class="row py-2 d-none" id="div_team_name">';
                echo '<label for="team_name" class="col-sm-6 col-form-label">';
                  echo 'Team Name';
                  echo '</label>';
                echo '<input type="text" class="form-control col-sm-6" id="team_name" name="team_name" placeholder="Team name" required="required">';
              echo '</div>';
              // unique code for team member
              echo '<div class="row py-2 d-none" id="div_unique_code">';
                echo '<label for="unique-code" class="col-sm-6 col-form-label">';
                  echo 'Unique Code';
                echo '</label>';
                echo '<input type="text" class="form-control col-sm-6" id="unique-code" name="unique-code" placeholder="Unique Code" required="required">';
              echo '</div>';
            }
            ?>
          </div> <!--right-cont-->
        </div> <!--event-details-->
        <form method="post" class="btn-con">
          <?php
            if(mysqli_num_rows($run_participated) == 0){
              echo "<input class='btn btn_size' id='button' type='submit' value='Register' name='registerBtn'>";
            }
            else{
            ?>
            <a href='../shared/view-event.php'>
              <button class="btn btn-primary animate-up-2" type="button">
                <i class="fa-solid fa-house"></i>  &nbsp; Return 
              </button>
            <a>
            <?php
            }
          ?>
        </form>
      </div> <!--main-cont-->
    </div>
  </div>
  <script>
    function disp_sec() {
      var option_value = document.getElementById('team_role'); //get select id
      var opvalue = option_value.options[option_value.selectedIndex].value; //read value
      if (opvalue === "leader"){ //if value = leader remove class and add class
        document.getElementById('div_team_name').classList.remove("d-none");
        document.getElementById('div_unique_code').classList.add("d-none");
      }
      else if (opvalue === "member"){ //if value = member remove class and add class
        document.getElementById('div_team_name').classList.add("d-none");
        document.getElementById('div_unique_code').classList.remove("d-none");
      }
      else{
        document.getElementById('div_team_name').classList.add("d-none");
        document.getElementById('div_unique_code').classList.add("d-none");
      }
    }
  </script>
</body>
</html>