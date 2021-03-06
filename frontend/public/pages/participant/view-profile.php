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
  
  //Query to get all data
  $user_query = "SELECT * FROM user AS pl
  INNER JOIN privilege ON pl.privilege_id = privilege.privilege_id 
  INNER JOIN participant ON pl.user_id = participant.user_id
  WHERE pl.user_id = $userid";
  // Execute the query
  $user_query_run = mysqli_query($con, $user_query);
  // Fetch data
  $userdata = mysqli_fetch_assoc($user_query_run);

  //Completed event, ongoing event
  $find_event_query = "SELECT tl.event_id FROM team_list AS tl
  INNER JOIN participant ON tl.participant_id = participant.participant_id 
  INNER JOIN user ON user.user_id = participant.user_id
  INNER JOIN event AS evt ON evt.event_id = tl.event_id
  WHERE user.user_id = $userid
  AND evt.active = '0'";
  $complete_event_query = "SELECT tl.event_id, COUNT(evt.event_date) FROM team_list AS tl
  INNER JOIN participant ON tl.participant_id = participant.participant_id 
  INNER JOIN user ON user.user_id = participant.user_id
  INNER JOIN event AS evt ON evt.event_id = tl.event_id
  WHERE user.user_id = $userid
  AND evt.active = '0'";
  $ongoing_event_query = "SELECT tl.event_id, COUNT(evt.event_date) FROM team_list AS tl
  INNER JOIN participant ON tl.participant_id = participant.participant_id 
  INNER JOIN user ON user.user_id = participant.user_id
  INNER JOIN event AS evt ON evt.event_id = tl.event_id
  WHERE user.user_id = $userid
  AND evt.active = '1'";
  // Execute the query
  $user_participate_result = mysqli_query($con, $find_event_query);
  $total_complete_result = mysqli_query($con, $complete_event_query);
  $total_ongoing_result = mysqli_query($con, $ongoing_event_query);
  // Fetch data
  $complete_result = mysqli_fetch_assoc($total_complete_result);
  $ongoing_result = mysqli_fetch_assoc($total_ongoing_result);

  //If no event participate, = 0
  $avg_event = 0;
  //AVG complete event for pie chart
  if(mysqli_num_rows($user_participate_result)>0) {
    $avg_event = ($complete_result['COUNT(evt.event_date)']/($complete_result['COUNT(evt.event_date)'] + $ongoing_result['COUNT(evt.event_date)']))*100;
  }
  //this query is to display total event participate
  $total_event_participate = "SELECT COUNT(event_id) FROM team_list
  INNER JOIN participant ON team_list.participant_id = participant.participant_id
  INNER JOIN user ON user.user_id = participant.user_id
  WHERE user.user_id = $userid";
  // Execute the query
  $total_result = mysqli_query($con, $total_event_participate);
  // Fetch data
  $total_participate = mysqli_fetch_assoc($total_result);

  //get current date
  $current_date = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/participant-view-profile.css">
  <link rel="stylesheet" href="../../../src/stylesheets/view-event.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Profile</title>
</head>
<body>
<?php include '../shared/navbar.php';?>
<div class="flex flex-row h-screen">
  <?php include '../shared/sidebar.php';?>
  <div class="basis-10/12 overflow-auto back-shadow" style="border-radius:30px;">
    <div class="cont">
      <!--row above-->
      <div class="btn-row">
        <!--container for back btn-->
        <div class="infront">
          <a onclick="history.back()">
            <i class="fa-solid fa-circle-arrow-left fa-2xl m-5"></i>
          </a>
        </div>
        <div class="btn-size">
          <a href="../shared/edit-profile.php" class="btn btn-primary mr-3 animate-up-2">
            <span class="mr-1"><i class="fa-solid fa-pen"></i></span>
            Edit
          </a>
        </div>
      </div>
      <div class="top-row mb-1 mb-5 ">
        <div class="col-2">
          <p class="d-none">hidden</p>
        </div>
        <!--profile container-->
        <div class="col-2 profile-col">
          <div class="profile-container">
            <img class="circle_img" id="img" name="img" src="<?php echo ($userdata['participant_image'])?>"> 
          </div>
        </div>
        <!--label user detail-->
        <div class="col-2 justify-content-center ml-6 mt-4 pt-4">
          <div class="row">
            <p class="fs-5 animate-up-2 text-format">Username :</p>
          </div>
          <div class="row">
            <p class="fs-5 animate-up-2 text-format">Name :</p>
          </div>
          <div class="row">
            <p class="fs-5 animate-up-2 text-format">Privilege :</p>
          </div>
        </div>
        <!--display user details-->
        <div class="col-2 justify-content-center mt-4 pt-4">
          <div class="row">
            <!--add php to fetch data from db-->
            <p class="fs-5 fw-bold animate-up-2 text-format">
              <?php echo $userdata['username']?>
            </p>
          </div>
          <div class="row">
            <p class="fs-5 fw-bold animate-up-2 text-format">
              <?php echo $userdata['name']?>
            </p>
          </div>
          <div class="row">
            <p class="fs-5 fw-bold animate-up-2 text-format">
              <?php echo $userdata['user_privilege']?>
            </p>
          </div>
        </div>
        <!--event participated-->
        <div class="evt-dis-cont">
          <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
            <div class="card-header">
              <h3 class="h5 card-title"> Events Participated</h3>
            </div>
            <div class="card-body">
              <!--PHP code retrieve no of events then display-->
              <p> <?php echo $total_participate['COUNT(event_id)'] ?> <i class="fa-solid fa-calendar-days"></i></p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
      </div>
      <!--row below-->
      <div class="row second_row">
        <div class="col">
          <!-- Tab Nav -->
          <div class="nav-wrapper position-relative mb-4">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row cancel-box-shadow" id="tabs-icons-text" role="tablist">
              <li class="nav-item cancel-box-shadow">
                <a class="nav-link mb-sm-3 mb-md-0 active enlarge-content" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa-solid fa-calendar-days"></i>Number of Events</a>
              </li>
              <li class="nav-item cancel-box-shadow">
                <a class="nav-link mb-sm-3 mb-md-0 enlarge-content" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fa-solid fa-calendar-days"></i>Participated Events</a>
              </li>
            </ul>
          </div>
          <!-- End of Tab Nav -->
          <!-- Tab Content -->
          <div class="card shadow-inset bg-primary border-light p-4 rounded ">
            <div class="card-body p-0">
              <div class="tab-content" id="tabcontent2">
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <div class="b-skills">
                    <div class="container">
                      <div class="row">
                        <div class="col-2">
                          <p class="d-none">Empty</p>
                        </div>
                        <div class="col-md-3">
                          <div class="skill-item center-block">
                            <div class="chart-container">
                              <div class="chart" data-percent= <?php echo $avg_event ?> data-bar-color="#52565f">
                                <span class="percent" data-after="%"> <?php echo $avg_event ?> </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col col-margin">
                          <div class="row">
                            <p class="fs-5 animate-up-2 title">Ongoing Events</p>
                          </div>
                          <div class="row">
                            <p class="fs-5 animate-up-2 title">Completed Events</p>
                          </div>
                        </div>
                        <div class="col col-margin">
                          <div class="row">
                            <p class="fs-5 fw-bold animate-up-2 title">
                              <?php echo $ongoing_result['COUNT(evt.event_date)'] ?>
                              <i class="fa-solid fa-calendar-days"></i>
                            </p>
                          </div>
                          <div class="row">
                            <p class="fs-5 fw-bold animate-up-2 title">
                              <?php echo $complete_result['COUNT(evt.event_date)'] ?>
                              <i class="fa-solid fa-calendar-days"></i>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                  <div class="content-cont">
                    <!--loop all participated event-->
                    <?php
                    $all_event_query = "SELECT * FROM event
                    INNER JOIN team_list ON event.event_id = team_list.event_id
                    INNER JOIN participant ON team_list.participant_id = participant.participant_id
                    INNER JOIN user on user.user_id = participant.user_id
                    WHERE user.user_id = '$userid'
                    GROUP BY event.event_id
                    ORDER BY event_date DESC";
                    $run_all_event_query = mysqli_query($con, $all_event_query);
                    if(mysqli_num_rows($run_all_event_query) > 0)
                    {
                      foreach($run_all_event_query as $event_query) // Run SQL query
                      {
                      //get number of judge 
                      $event_id = intval($event_query['event_id']);
                      $judge_query = "SELECT COUNT(judge.judge_id) FROM judge
                      INNER JOIN judges_list ON judges_list.judge_id = judge.judge_id
                      INNER JOIN event ON event.judges_list_id = judges_list.judges_list_id
                      WHERE judges_list.judges_list_id = event.judges_list_id
                      AND event.event_id = $event_id";
                      $num_judge_query = mysqli_query($con, $judge_query);
                      // Fetch data
                      $num_judge = mysqli_fetch_assoc($num_judge_query);
                      $participant_sql= "SELECT COUNT(participant_id) AS num_participant FROM team_list WHERE event_id = '$event_id'";
                      $participant_result = mysqli_query($con, $participant_sql);
                      while($participant_row=mysqli_fetch_array($participant_result)){
                        $num_participant = $participant_row["num_participant"];
                      }
                    ?>
                    <div class="event-cont col-12 pb-3">
                      <?php
                        echo "<a href='../participant/event-details.php?$event_id'>"
                      ?>
                        <button class="btn btn-primary animate-up-2" type="button">
                          <div class="event-cont">
                            <div class="col-8">
                              <div class="title-con">
                                <h2><?php echo ($event_query['event_name']);?></h2> <!--change event name-->
                                <div class="status-con"> <!--change event status-->
                                  <?php
                                    $start_time = date("H:i",strtotime($event_query['start_time']));
                                    $end_time = date("H:i",strtotime($event_query['end_time']));
                                    if($event_query['active']== 1){
                                      echo "<small class='status-on'>Active</small>";
                                    }
                                    else{
                                      echo "<small class='status-off'>End</small>";
                                    }
                                  ?>
                                </div>
                              </div>
                              <div class="details-con"> <!--event info-->
                                <div class="info-con">
                                  <p>Date: <?php echo ($event_query['event_date'])?> </p>
                                  <p>Judges : <?php echo $num_judge['COUNT(judge.judge_id)']?> </p>
                                </div>
                                <div class="info-con">
                                  <p>Time: <?php echo $start_time?> ~ <?php echo $end_time?> </p>
                                  <p>Participant : <?php echo $num_participant?></p>
                                </div>
                              </div> <!--info-->
                            </div>
                            <div class="col-4">
                              <i class="icon-size fa-solid fa-angle-right"></i>
                            </div>
                          </div>
                        </button>
                      </a>
                    </div><!--event-con-->
                  <?php
                    }
                  }
                  else{
                  ?>
                    <div class="no-event col-12">
                      <h2>You have not completed any events.</h2>
                    </div>
                  <?php
                  }
                  ?>
                  </div> <!--content-cont-->
                </div> <!--end-->
              </div>
            </div>
          </div>
          <!-- End of Tab Content -->
        </div>
      </div>
    </div>
  </div>
</div>
<?php
//close database connection
mysqli_close($con);
?>
<script src="../shared/jquery-2.2.4.min.js"></script>
<script src="../shared/profile.min.js"></script>
<script>
  var $window = $(window);
  function run() {
    var fName = arguments[0],
      aArgs = Array.prototype.slice.call(arguments, 1);
    try {
      fName.apply(window, aArgs);
    } catch (err) {}
  }
  /* ==================== chart ============================== */
  function _chart() {
    $(".b-skills").appear(function () {
      setTimeout(function () {
        $(".chart").easyPieChart({
          easing: "easeOutElastic",
          delay: 3000,
          barColor: "#369670",
          trackColor: "#fff",
          scaleColor: false,
          lineWidth: 21,
          trackWidth: 21,
          size: 250,
          lineCap: "round",
          onStep: function (from, to, percent) {
            this.el.children[0].innerHTML = Math.round(percent);
          },
        });
      }, 150);
    });
  }
  $(document).ready(function () {
    run(_chart);
  });
</script>
</body>
</html>