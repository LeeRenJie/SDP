<?php
  // start the session
  if(!isset($_SESSION)) {
    session_start();
  }

  if ($_SESSION['privilege'] != "admin" && $_SESSION['privilege'] != "organizer") {
    echo("<script>alert('You do not have access to this page')</script>");
    header("Location: ../shared/view-event.php");
  };

  // include the database connections
  include("../../../../backend/conn.php");

  //get event id from url
  $event_id = intval($_SERVER['QUERY_STRING']);

  // Change event to ended
  $end_event_sql = "UPDATE event SET active = 0 WHERE event_id = $event_id";
  $end_event_result = mysqli_query($con, $end_event_sql);

  // get the individual event details
  $event_sql = ("SELECT * FROM event WHERE event_id = '$event_id'");

  $event_result = mysqli_query($con, $event_sql);
  $event_row=mysqli_fetch_array($event_result);

  $event_name = $event_row['event_name'];
  $event_description = $event_row['event_description'];
  $event_date = date("d-m-Y",strtotime($event_row["event_date"]));
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

  // count number of judges
  $count_judge_sql = (
    "SELECT e.event_id, COUNT(j.judge_name) AS num_judges
    FROM event AS e
    JOIN judges_list AS jl ON e.judges_list_id = jl.judges_list_id
    JOIN judge AS j ON jl.judge_id = j.judge_id
    WHERE e.event_id = '$event_id'"
  );
  $count_judge_result = mysqli_query($con, $count_judge_sql);
  while($count_judge_row = mysqli_fetch_assoc($count_judge_result)){
    $num_judges = $count_judge_row["num_judges"];
  };


  // count number of participants
  $count_participant_sql= ("SELECT COUNT(participant_id) AS num_participant FROM team_list WHERE event_id = '$event_id'");
  $count_participant_result = mysqli_query($con, $count_participant_sql);
  while($count_participant_row=mysqli_fetch_array($count_participant_result)){
    $num_participant = $count_participant_row["num_participant"];
  };

  // count number of teams
  $count_team_sql= ("SELECT COUNT(distinct team_list_id) AS num_team FROM team_list WHERE event_id = '$event_id'");
  $count_team_result = mysqli_query($con, $count_team_sql);
  while($count_team_row=mysqli_fetch_array($count_team_result)){
    $num_team = $count_team_row["num_team"];
  };

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


  // get the participants
  $participant_sql = (
    "SELECT tl.team_list_id, tl.team_name, SUM(sc.score) AS total_score, u.name
    FROM judgement_list AS jl INNER JOIN score_list AS sl ON jl.score_list_id = sl.score_list_id
    INNER JOIN score AS sc ON sl.score_id = sc.score_id
    INNER JOIN team_list AS tl ON jl.team_list_id = tl.team_list_id
    JOIN participant AS p ON tl.participant_id = p.participant_id
    JOIN user AS u ON p.user_id = u.user_id
    INNER JOIN event AS ev ON tl.event_id = ev.event_id
    WHERE ev.event_id = '$event_id'
    GROUP BY tl.team_list_id
    ORDER BY total_score DESC;"
  );
  $participant_result = mysqli_query($con, $participant_sql);

  // get the teams
  $team_rank_sql = (
    "SELECT tl.team_list_id, tl.team_name, SUM(sc.score) AS total_score, GROUP_CONCAT(DISTINCT u.name) AS team_members
    FROM judgement_list AS jl INNER JOIN score_list AS sl ON jl.score_list_id = sl.score_list_id
    INNER JOIN score AS sc ON sl.score_id = sc.score_id
    INNER JOIN team_list AS tl ON jl.team_list_id = tl.team_list_id
    JOIN participant AS p ON tl.participant_id = p.participant_id
    JOIN user AS u ON p.user_id = u.user_id
    INNER JOIN event AS ev ON tl.event_id = ev.event_id
    WHERE ev.event_id = '$event_id'
    GROUP BY tl.team_list_id
    ORDER BY total_score DESC;"
  );
  $team_result = mysqli_query($con, $team_rank_sql);

  //close database connection
  mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/event-summary.css" />
  <title>Event Summary</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 bg-shadow overflow-auto" style="border-radius:30px;">
      <div class="pt-4">
        <span onclick="history.back()" class="pl-5 cursor-pointer">
          <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
        </span>
      </div>
      <div class="row pt-4 pl-5">
        <!-- Event name and status -->
        <div class="col-9">
          <h1 class="inline-block"><b>Event Summary for <?php echo ucwords($event_name)?></b></h1>
        </div>
        <!-- Button actions for the event -->
        <div class="col-3">
          <a href="../organizer/generate-pdf.php?<?php echo $event_id?>" target="_blank" class="btn btn-primary ml-5 cursor-pointer">View As PDF</a>
        </div>
      </div>
      <!-- Image of event -->
      <div class="text-center img-container ml-5">
        <img src="<?php echo $event_pic ?>" class="mx-auto d-block img-size shadow-inset" alt="Event Image">
      </div>
      <!-- Details of event -->
      <div class="row pl-5 pt-4">
        <h3 class="block"><b>Details</b></h3>
      </div>
      <div class="row ml-5 pt-2 detail-container">
        <div class="col-4">
          <div class="row py-2">
            <div class="col-6 text-center">
              <div class="inline-block details pt-3">
                <span class="h5">
                  <i class="fa-solid fa-calendar-day"></i>
                  Date
                </span>
                <p class="pt-4"><?php echo $event_date?></p>
              </div>
            </div>
            <div class="col-6 text-center">
              <div class="inline-block details pt-3">
                <span class="h5">
                  <i class="fa-solid fa-clock"></i>
                  Time
                  </span>
                <p class="pt-4"><?php echo $start_time?> ~ <?php echo $end_time?></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6 text-center">
              <div class="inline-block details pt-3">
                <span class="h5">
                  <i class="fa-solid fa-person"></i>
                  Max
                </span>
                <?php if($type == "team"){
                  echo '<p class="pt-3 card-text">';
                }else{
                  echo '<p class="pt-4 card-text">';
                }?>
                  <?php echo $max_team?>
                  <?php
                    if($type == "team"){
                      echo "Teams";
                      echo "<small class='block'>$max_member per team</small>";
                    }
                    else{
                      echo "Person";
                    }
                  ?>
                  </p>
              </div>
            </div>
            <div class="col-6 text-center">
              <div class="inline-block details pt-3">
                <span class="h5">
                  <i class="fa-solid fa-question"></i>
                  Type
                </span>
                <p class="pt-4"><?php echo ucwords($type)?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-8 text-center pt-2">
          <div class="inline-block overflow-y-auto description pt-3">
            <span class="h5">
              <i class="fa-solid fa-message"></i>
              Description
            </span>
            <p class="px-5 pt-3 text-justify">
              <?php echo $event_description?>
            </p>
          </div>
        </div>
        <div class="row py-3">
          <div class="col-4 text-center">
            <div class="inline-block prizes overflow-y-auto pt-3 ml-1">
              <span class="h5">
                <i class="fa-solid fa-trophy"></i>
                Prizes
              </span>
              <div  style="text-align: center;">
                <div style="display: inline-block; text-align: left;" class="pt-5">
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
                          echo " prize: RM ";
                          echo $prizes_row['prize'];
                        echo'</p>';
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-8 text-center">
            <div class="inline-block overflow-y-auto rules pt-3">
              <span class="h5">
                <i class="fa-solid fa-scroll"></i>
                Rules
              </span>
              <?php
                if(mysqli_num_rows($rules_result) > 0 ){
                  foreach($rules_result as $rules_row){
                    echo (
                      "<p class='px-5 pt-3 text-justify'>
                        ??? $rules_row[rule]
                      </p>"
                    );
                  };
                };
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row ml-5 pt-4 width">
        <!-- Judges Info -->
        <div class="col-3 pl-0">
          <h3 class="float-start"><b>Judges</b></h3>
          <h5 class="float-end opacity-50">Total:  <?php echo $num_judges?></h5>
          <table class="table judge-table overflow-y-auto text-center align-middle">
            <tr>
              <th class="border-0" scope="col" id="name" width="268px">Name</th>
            </tr>
            <?php
              if(mysqli_num_rows($judge_result) > 0 ){
                foreach($judge_result as $i => $judge_row){
                  echo'<tr>';
                    echo'<td>';
                      echo$judge_row['judge_name'];
                    echo'</td>';
                  echo '</tr>';
                };
              };
            ?>
          </table>
        </div>
        <!-- Participant Info -->
        <div class="col-9 pr-0">
          <h3 class="float-start">
            <b>
              <?php
                if($type=="solo")
                {
                  echo("Participants' Results & Rankings");
                }
                else
                {
                  echo("Teams Results & Rankings");
                }
              ?>
            </b>
          </h3>
          <h5 class="float-end opacity-50">Total:
            <?php
              if($type=="solo")
              {
                echo($num_participant);
              }
              else
              {
                echo($num_team);
              }
            ?>
          </h5>
          <table class="table participant-table overflow-y-auto text-center align-middle">
            <tr>
              <th class="border-0" scope="col" id="name" width="10%">Rankings</th>
              <th class="border-0" scope="col" id="code" width="60%">Name</th>
              <th class="border-0" scope="col" id="code" width="15%">Total Score</th>
              <th class="border-0" scope="col" id="actions" width="15%">Actions</th>
            </tr>
            <?php
              // if event is solo type show all participant names
              if($type=="solo"){
                if(mysqli_num_rows($participant_result) > 0 ){
                  foreach($participant_result as $i => $participant_row){
                    echo '<tr>';
                      echo"<td>";
                        echo ($i+1);
                      echo'</td>';
                      echo "<td>";
                        echo $participant_row['name'];
                      echo"</td>";
                      echo"<td>";
                        echo $participant_row['total_score'];
                      echo"</td>";
                      echo('
                      <td class="text-center dropdown">
                        <a href="#" data-toggle="dropdown">
                          <i class="fa-solid fa-ellipsis"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="">No Action available</a></li>
                        </ul>
                      </td>
                    </tr>');
                  };
                };
              }
              // if event is team show all team names
              else{
                if(mysqli_num_rows($team_result) > 0 ){
                  foreach($team_result as $i => $team_row){
                    // get all team members in array form
                    $team_member = explode(",", $team_row['team_members']);
                    // count number of team members in the team
                    $count_team_member = count($team_member);
                    // modal to display team members
                    echo"<tr>";
                      echo"<td>";
                        echo ($i+1);
                      echo'</td>';
                      echo"<td>";
                        echo $team_row['team_name'];
                      echo"</td>";
                      echo"<td>";
                        echo$team_row['total_score'];
                      echo"</td>";

                      echo'<td class="text-center dropdown">';
                        echo '<a href="#" data-toggle="dropdown">';
                          echo '<i class="fa-solid fa-ellipsis"></i>';
                        echo '</a>';
                        echo '<ul class="dropdown-menu">';
                          echo '<li>';
                            echo '<button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-default_'.$i.'">';
                            echo 'View Team Members';
                              echo '</button>';
                          echo '</li>';
                        echo '</ul>';
                      echo '</td>';
                    echo '</tr>';

                    // modal to display team members
                    echo '<!-- Modal Content -->';
                    echo '<div class="modal fade" id="modal-default_'.$i.'" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">';
                      echo('<div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h2 class="h6 modal-title mb-0" id="modal-title-default">Team members</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">??</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>All team members have the same unique code to join the team or view event results.</p>
                            <br/>
                            <p class="text-center">Team members are listed below????</p>
                      ');
                      // loop through all team members and display them
                      for ($x = 0; $x <= $count_team_member-1 ; $x++) {
                        echo "<p class='text-center'> ??? ".$team_member[$x]."</p>";
                      };
                      echo('
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End of Modal Content -->
                    ');
                  };
                };
              };
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>