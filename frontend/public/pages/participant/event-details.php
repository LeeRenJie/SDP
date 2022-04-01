<?php
  // start the session
  if(!isset($_SESSION)) {
  session_start();
  }

  // include the database connections
  include("../../../../backend/conn.php");
  include("../../../../backend/session.php");

  //get user id from session
  $userid = $_SESSION['user_id'];
  //get event id from url
  $event_id = intval($_SERVER['QUERY_STRING']);

  //if no event id
  if($event_id == 0){
    echo("<script>window.location = '../shared/view-event.php'</script>");
  }

  // get the individual event details
  $event_sql = ("SELECT * FROM event WHERE event_id = '$event_id'");
  $event_result = mysqli_query($con, $event_sql);
  $event_query=mysqli_fetch_array($event_result);
  $event_name = $event_query['event_name'];
  $event_description = $event_query['event_description'];
  $event_date = date("d-m-Y",strtotime($event_query["event_date"]));
  $start_time = date("H:i",strtotime($event_query["start_time"]));
  $end_time = date("H:i",strtotime($event_query["end_time"]));
  $event_pic = $event_query['event_picture'];
  if ($event_pic == "" || $event_pic == NULL) {
    $event_pic = "../../images/default.jpg";
  }
  $type = $event_query['participant_type'];
  $max_member = $event_query['max_member'];
  $max_team = $event_query['max_team'];
  $active = $event_query['active'];

  // count number of participants
  $count_participant_sql= ("SELECT COUNT(participant_id) AS num_participant FROM team_list WHERE event_id = '$event_id'");
  $count_participant_result = mysqli_query($con, $count_participant_sql);
  while($count_participant_row=mysqli_fetch_array($count_participant_result)){
    $num_participant = $count_participant_row["num_participant"];
  };

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
  

  // get the rules
  $rules_sql = (
    "SELECT e.event_id, r.rule
    FROM event AS e
    JOIN rules_list AS rl ON e.rules_list_id = rl.rules_list_id
    JOIN rule AS r ON rl.rule_id = r.rule_id
    WHERE e.event_id = '$event_id'"
  );
  $rules_result = mysqli_query($con, $rules_sql);

  // get the prizes
  $prize_sql = (
    "SELECT e.event_id, p.prize
    FROM event AS e
    JOIN prizes_list AS pl ON e.prizes_list_id = pl.prizes_list_id
    JOIN prize AS p ON pl.prize_id = p.prize_id
    WHERE e.event_id = '$event_id'"
  );
  $prize_result = mysqli_query($con, $prize_sql);
  
  //get organizer details
  $oganizer_sql = "SELECT * FROM organizer
  INNER JOIN event ON event.organizer_id = organizer.organizer_id
  INNER JOIN user ON organizer.user_id = user.user_id
  WHERE event_id = '$event_id'";
  $run_organizer_result = mysqli_query($con, $oganizer_sql);
  $oganizer_result=mysqli_fetch_array($run_organizer_result);
  $organizer_name = $oganizer_result['name'];
  $organizer_email = $oganizer_result['email'];
  $organizer_phone = $oganizer_result['telephone'];

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

  if (isset($_POST['participate'])) {
    echo("<script>window.location = 'register-event.php?$event_id'</script>");
  };
  //close database connection
  mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/participant-event-details.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Event Details</title>
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
        <!-- Event name and status -->
        <h1><?php echo ucwords($event_name)?></h1>
        <!-- Image of event -->
        <div class="img-container">
          <img src="<?php echo $event_pic?>" class="mx-auto d-block img-size shadow-inset" alt="Event Image">
        </div>
        <!-- Details of event -->
        <div class="row detail-container">
          <div class="col-4"> <!--left details-->
            <div class="row py-3">  <!--row for date and time-->
              <div class="col-6 text-center">
                <div class="inline-block details pt-3">
                  <span class="h5">
                    <i class="fa-solid fa-calendar-day"></i>
                    Date
                  </span>
                  <p class="pt-3">
                    <?php echo "$event_date"?>
                  </p>
                </div>
              </div>
              <div class="col-6 text-center">
                <div class="inline-block details pt-3">
                  <span class="h5">
                    <i class="fa-solid fa-clock"></i>
                    Time
                    </span>
                  <p class="pt-3">
                    <?php echo "$start_time ~ $end_time";?>
                  </p>
                </div>
              </div>
            </div> <!--row for date and time-->
            <div class="row"> <!--row for max person and type-->
              <div class="col-6 text-center">
                <div class="inline-block details pt-3">
                  <span class="h5">
                    <?php
                      if($type == "team"){
                        echo "<i class='fa-solid fa-people-group'></i>";
                      }
                      else{
                        echo "<i class='fa-solid fa-person'></i>";
                      }
                    ?>
                    Max
                  </span>
                  <p class="pt-3 card-text">
                    <?php echo $max_team?>
                    <?php
                      if($type == "team"){
                        echo "Teams ($max_member in <i class='fa-solid fa-people-group'></i>)";
                      }
                      else{
                        echo "Person <i class='fa-solid fa-person'></i>";
                      }
                    ?>
                </div>
              </div>
              <div class="col-6 text-center">
                <div class="inline-block details pt-3">
                  <span class="h5">
                    <i class="fa-solid fa-question"></i>
                    Type
                  </span>
                  <p class="pt-3">
                    <?php
                    if($type == "team"){
                      echo "Team <i class='fa-solid fa-people-group'></i>";
                    }
                    else{
                      echo "Person <i class='fa-solid fa-person'></i>";
                    }
                    ?>
                  </p>
                </div>
              </div>
            </div> <!--row for max person and type-->
          </div> <!--left details-->
          <div class="col-2 text-center py-3"> <!--middle details description-->
            <div class="participated pt-3">
              <span class="h5">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Participated
              </span>
              <p class="px-5 text-center">
                <?php
                  if($type == "team"){
                    echo "$num_team <i class='fa-solid fa-people-group'></i>";
                  }
                  else{
                    echo "$num_participant <i class='fa-solid fa-person'></i>";
                  }
                ?>
              </p>
            </div>
          </div> <!--middle details description-->
          <div class="col-6 text-center py-3"> <!--right details description-->
            <div class="description pt-3">
              <span class="h5">
                <i class="fa-solid fa-message"></i>
                Description
              </span>
              <p class="px-5 pt-3 text-justify">
                <?php echo $event_description?>
              </p>
            </div>
          </div> <!--right details description-->
          <div class="row py-3">
            <div class="col-4 text-center"> <!--Prizes-->
              <div class="prizes pt-3">
                <span class="h5">
                  <i class="fa-solid fa-trophy"></i>
                  Prizes
                </span>
                <div  style="text-align: center;">
                  <div class="pt-3">
                  <?php
                    if(mysqli_num_rows($prize_result) > 0 ){
                      foreach($prize_result as $i => $prizes_row){
                        echo'<p>';
                          echo $i+1;
                          if ($i == 0) {
                            echo "st";
                          }elseif ($i == 1) {
                            echo "nd";
                          }elseif ($i == 2) {
                            echo "rd";
                          }else{
                            echo "th";
                          }
                          echo " prize: ";
                          echo $prizes_row['prize'];
                        echo'</p>';
                      }
                    }
                  ?>
                  </div>
                </div>
              </div>
            </div> <!--Prizes-->
            <div class="col-8 text-center"> <!--Rules-->
              <div class="rules pt-3 ml-2.5">
                <span class="h5">
                  <i class="fa-solid fa-scroll"></i>
                  Rules
                </span>
                <?php
                  if(mysqli_num_rows($rules_result) > 0 ){
                    foreach($rules_result as $rules_row){
                      echo (
                        "<p class='px-5 pt-3 text-justify'>
                          • $rules_row[rule]
                        </p>"
                      );
                    };
                  };
                ?>
              </div>
            </div> <!--Rules-->
          </div>
          <div class="row py-1 mb-3">
            <div class="contact text-center py-3">
              <span class="h5">
                <i class="fa-solid fa-address-book"></i>
                Contact Information
              </span>
              <div class="row py-3 ml-1">
                <span class="col-4">
                  <i class="fa-solid fa-user"></i> Organizer: <?php echo $organizer_name?>
                </span>
                <span class="col-4">
                  <i class="fa-solid fa-envelope"></i> Email: <?php echo $organizer_email?>
                </span>
                <span class="col-4">
                  <i class="fa-solid fa-phone"></i> Phone: <?php echo $organizer_phone?>
                </span>
              </div>
            </div>
          </div>
        </div> <!-- Details of event -->
        <form method="post" class="btn-con">
          <?php
            if($type == "team"){
              if($participated == 1){
                echo"<a href='success-register.php?$event_id'>";
                  echo'<button class="btn btn_size animate-up-2" type="button">';
                    echo '<i class="fa-solid fa-clone"></i>  &nbsp; Registered Details ';
                  echo'</button>';
                echo '</a>';
              }
              elseif($num_team == $max_team){
                if($result_participated <= $maximum_participant) {
                  echo("<script>alert('You can only join as team member');</script>");
                  echo '<input class="btn btn_size animate-up-2" id="button" type="submit" value="Participate" name="participate">';
                }
                else {
                  echo("<script>alert('Fully Participated');</script>");
                  echo"<a href='../shared/view-event.php'>";
                    echo'<button class="btn btn_size animate-up-2" type="button">';
                      echo '<i class="fa-solid fa-house"></i>  &nbsp; Return ';
                    echo'</button>';
                  echo '</a>';
                };
              }
              else {
                echo '<input class="btn btn_size animate-up-2" id="button" type="submit" value="Participate" name="participate">';
              };
            }
            else{
              if($participated == 1){
                echo"<a href='success-register.php?$event_id'>";
                  echo'<button class="btn btn_size animate-up-2" type="button">';
                    echo '<i class="fa-solid fa-clone"></i>  &nbsp; Registered Details ';
                  echo'</button>';
                echo '</a>';
              }
              elseif($num_participant == $max_team){
                echo("<script>alert('Fully Participated');</script>");
                echo"<a href='../shared/view-event.php'>";
                  echo'<button class="btn btn_size animate-up-2" type="button">';
                    echo '<i class="fa-solid fa-house"></i>  &nbsp; Return ';
                  echo'</button>';
                echo '</a>';
              }
              else {
                echo '<input class="btn btn_size animate-up-2" id="button" type="submit" value="Participate" name="participate">';
              }
            }
          ?>
          <!-- <input class="btn btn_size" id="button" type="submit" value="Participate" name="participate"> -->
        </form>
      </div> <!--Main Container-->
    </div>
  </div>
</body>
</html>