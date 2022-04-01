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

  //if no event id
  if($event_id == 0){
    echo("<script>window.location = '../shared/view-event.php'</script>");
  }
  
  //event query
  $evt_query = "SELECT * FROM event 
  WHERE event_id = '$event_id'";
  $event_query_run = mysqli_query($con, $evt_query);
  // Fetch data
  $event_query = mysqli_fetch_assoc($event_query_run);

  //get value to calculate
  $max_member = $event_query['max_member'];
  $max_team = $event_query['max_team'];

  // count number of participants
  $count_participant_sql= ("SELECT COUNT(participant_id) AS num_participant FROM team_list WHERE event_id = '$event_id'");
  $count_participant_result = mysqli_query($con, $count_participant_sql);
  while($count_participant_row=mysqli_fetch_array($count_participant_result)){
    $num_participant = $count_participant_row["num_participant"];
  };

  // count number of participant in teams
  $count_participated_sql= ("SELECT COUNT(distinct team_list_id) AS num_team FROM team_list WHERE event_id = '$event_id'");
  $count_participated_result = mysqli_query($con, $count_participated_sql);
  while($count_team_row=mysqli_fetch_array($count_participated_result)){
    $result_participated = $count_team_row["num_team"];
  };
  $maximum_participant = intval($max_team) * intval($max_member);

  // count number of teams
  $count_team_sql= ("SELECT * FROM team_list WHERE event_id = '$event_id' GROUP BY team_list.unique_code");
  $count_team_result = mysqli_query($con, $count_team_sql);
  $num_team = mysqli_num_rows($count_team_result);

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

  $participate = "SELECT COUNT(team_list.participant_id) AS num FROM team_list
                INNER JOIN participant ON participant.participant_id = team_list.participant_id
                INNER JOIN user ON participant.user_id = user.user_id
                WHERE event_id =' $event_id'
                AND user.user_id = '$userid'";
  $run_participated =  mysqli_query($con, $participate);
  //get row of participated
  while($sql0=mysqli_fetch_array($run_participated)){
    $run_sql0 = $sql0["num"];
  };
  $participated = intval($run_sql0);

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
      if($event_query['participant_type'] == "team") {
        if ($_POST['option_value'] == 'leader'){
          $participant_id = $userdata['participant_id'];
          $ipt_event = $event_id;
          $team_name = $_POST['team_name'];
          $ipt_uni_code = $unique;
          $sql = "INSERT INTO team_list (participant_id, event_id, team_name, unique_code)
                  VALUES ('$participant_id', '$ipt_event', '$team_name', '$ipt_uni_code')";
          $result = mysqli_query($con, $sql);
          echo("<script>alert('Participated Successful team leader');</script>");
          echo("<script>window.location = 'success-register.php?$event_id'</script>");
        }
        elseif ($_POST['option_value'] == 'member') {
          $sql1 = "SELECT * FROM team_list WHERE unique_code = '$_POST[unique_code]'";
          $runsql = mysqli_query($con, $sql1);
          $gorunsql = mysqli_fetch_assoc($runsql);
          
          $participant_id = $userdata['participant_id'];
          $ipt_event = $event_id;
          $team_name = $gorunsql['team_name'];
          $ipt_uni_code = $_POST['unique_code'];
          $sql2 = "INSERT INTO team_list (participant_id, event_id, team_name, unique_code)
                  VALUES ('$participant_id', '$ipt_event', '$team_name', '$ipt_uni_code')";
          $result = mysqli_query($con, $sql2);
          echo("<script>alert('Participated Successful');</script>");
          echo("<script>window.location = 'success-register.php?$event_id'</script>");
        }
        else {
          echo("<script>alert('Try Again');</script>");
        }
      }
      elseif($event_query['participant_type'] == "solo") {
        $participant_id = $userdata['participant_id'];
        $ipt_event = $event_id;
        $team_name = $userdata['username'];
        $ipt_uni_code = $unique;
        $sql3 = "INSERT INTO team_list (participant_id, event_id, team_name, unique_code)
                VALUES ('$participant_id', '$ipt_event', '$team_name', '$ipt_uni_code')";
        $result = mysqli_query($con, $sql3);
        echo("<script>alert('Participated Successful');</script>");
        echo("<script>window.location = 'success-register.php?$event_id'</script>");
      }
      else{
        echo("<script>alert('Try Again');</script>");
      }
    }
    else{
      echo("<script>alert('Try Again');</script>");
    }
  };
  //close connection
  mysqli_close($con);
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
        <div class ="btn-row">
          <div class="infront">
            <a onclick="history.back()">
              <i class="fa-solid fa-circle-arrow-left fa-2xl m-5"></i>
            </a>
          </div>
        </div>
        <h2>Registration <?php echo ($event_query['event_name'])?></h2>
        <div class="event-details">
          <div class="left-cont">
            <div class="description">
              <span>
                <i class="fa-solid fa-message"></i>
                Event Description
              </span>
              <div class="details-cont">
                <p><?php echo ($event_query['event_description'])?>
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
            //if not participated
            if($participated == 0){
              if($event_query['participant_type'] == "team") {
                echo '<form method="post">';
                  if($participated == 0){ //if never participated
                    if($num_team == $max_team) { //if team full
                      if($result_participated <= $maximum_participant) { //but member not full
                        echo '<div class="row py-2">';
                          echo '<label for="team-role" class="col-sm-6 col-form-label">';
                            echo 'Team Role ';
                          echo '</label>';
                          echo '<select name="option_value" class="custom-select col-sm-6 btn sel" id="team_role">';
                            echo '<option class="al" value="" disabled >Please Select</option>';
                            echo '<option class="al" value="leader" disabled>Leader</option>';
                            echo '<option class="al" value="member" selected>Member</option>';
                          echo '</select>';
                        echo '</div>';
                        // team name for team leader
                        echo '<div class="row py-2 d-none" id="div_team_name">';
                          echo '<label for="team_name" class="col-sm-6 col-form-label">';
                            echo 'Team Name';
                          echo '</label>';
                          echo '<input type="text" class="form-control col-sm-6" id="team_name" value="" name="team_name" placeholder="Team name">';
                        echo '</div>';
                        // unique code for team member
                        echo '<div class="row py-2 d-none" id="div_unique_code">';
                          echo '<label for="unique-code" class="col-sm-6 col-form-label">';
                            echo 'Unique Code';
                          echo '</label>';
                          echo '<input type="text" class="form-control col-sm-6" id="unique-code" value="" name="unique_code" placeholder="Unique Code">';
                        echo '</div>';
                        echo '<div class="btn-con">';
                        echo("<script>alert('You can only join as team member');</script>");
                        echo "<input class='btn btn_size animate-up-2' id='button' type='submit' value='Register' name='registerBtn'>";
                      }
                      else { //member full
                        echo("<script>alert('Fully Participated');</script>");
                        echo"<a href='../shared/view-event.php'>";
                          echo'<button class="btn btn_size btn-primary animate-up-2" type="button">';
                            echo '<i class="fa-solid fa-house"></i>  &nbsp; Return ';
                          echo'</button>';
                        echo '</a>';
                      };
                    }
                    else { //if team not full
                      echo '<div class="row py-2">';
                        echo '<label for="team-role" class="col-sm-6 col-form-label">';
                          echo 'Team Role ';
                        echo '</label>';
                        echo '<select name="option_value" class="custom-select col-sm-6 btn sel" onchange="disp_sec()" id="team_role">';
                          echo '<option class="al" value="" disabled selected>Please Select</option>';
                          echo '<option class="al" value="leader">Leader</option>';
                          echo '<option class="al" value="member">Member</option>';
                        echo '</select>';
                      echo '</div>';
                      // team name for team leader
                      echo '<div class="row py-2 d-none" id="div_team_name">';
                        echo '<label for="team_name" class="col-sm-6 col-form-label">';
                          echo 'Team Name';
                        echo '</label>';
                        echo '<input type="text" class="form-control col-sm-6" id="team_name" value="" name="team_name" placeholder="Team name">';
                      echo '</div>';
                      // unique code for team member
                      echo '<div class="row py-2 d-none" id="div_unique_code">';
                        echo '<label for="unique-code" class="col-sm-6 col-form-label">';
                          echo 'Unique Code';
                        echo '</label>';
                        echo '<input type="text" class="form-control col-sm-6" id="unique-code" value="" name="unique_code" placeholder="Unique Code">';
                      echo '</div>';
                      echo '<div class="btn-con">';
                      echo "<input class='btn btn_size animate-up-2' id='button' type='submit' value='Register' name='registerBtn'>";
                    }
                  }
                  else{ //participated
                    echo"<a href='success-register.php?$event_id'>";
                      echo'<button class="btn btn_size animate-up-2" type="button">';
                        echo '<i class="fa-solid fa-clone"></i>  &nbsp; Registered Details ';
                      echo'</button>';
                    echo '</a>';
                  }
                  echo '</div>';
                echo'</form>';
              }
              //for solo event
              elseif($event_query['participant_type'] == "solo") {
                echo '<form method="post">';
                  echo '<div class="btn-con">';
                  if($participated == 0){ //if not participated
                    if ($num_participant == $max_team) { //if fully participated
                      echo("<script>alert('Fully Participated');</script>");
                      echo"<a href='../shared/view-event.php'>";
                        echo'<button class="btn btn_size btn-primary animate-up-2" type="button">';
                          echo '<i class="fa-solid fa-house"></i>  &nbsp; Return ';
                        echo'</button>';
                      echo '</a>';
                    }
                    else {
                      echo "<input class='btn btn_size animate-up-2' id='button' type='submit' value='Register' name='registerBtn'>";
                    }
                  }
                  else{
                    echo"<a href='../shared/view-event.php'>";
                      echo'<button class="btn btn_size btn-primary animate-up-2" type="button">';
                        echo '<i class="fa-solid fa-house"></i>  &nbsp; Return ';
                      echo'</button>';
                    echo '</a>';
                  }
                  echo '</div>';
                echo'</form>';
              }
            }
            else {
              echo '<div class="btn-con">';
                echo"<a href='../shared/view-event.php'>";
                  echo'<button class="btn btn_size btn-primary animate-up-2" type="button">';
                    echo '<i class="fa-solid fa-house"></i>  &nbsp; Return ';
                  echo'</button>';
                echo '</a>';
              echo '</div>';
            }
            ?>
          </div> <!--right-cont-->
        </div>
      </div> <!--main-cont-->
    </div>
  </div>
  <?php
    //close connection
    mysqli_close($con);
  ?>
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
    var option_value = document.getElementById('team_role'); //get select id
    var opvalue = option_value.options[option_value.selectedIndex].value; //read value
    if (opvalue === "leader"){ //if value = leader remove class and add class
      document.getElementById('div_team_name').classList.remove("d-none");
      document.getElementById('div_unique_code').classList.add("d-none");
      document.getElementById('team_name').setAttribute('required', 'required');
    }
    else if (opvalue === "member"){ //if value = member remove class and add class
      document.getElementById('div_team_name').classList.add("d-none");
      document.getElementById('div_unique_code').classList.remove("d-none");
      document.getElementById('unique-code').setAttribute('required', 'required');
    }
    else{
      document.getElementById('div_team_name').classList.add("d-none");
      document.getElementById('div_unique_code').classList.add("d-none");
    }
  </script>
</body>
</html>