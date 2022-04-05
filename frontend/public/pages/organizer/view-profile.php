<?php
  //Connection to Database
  include("../../../../backend/conn.php");
  // start the session
  if(!isset($_SESSION)) {
    session_start();
  }

  //get user id from url
  // use query string to fetch data from previous page --> "users.php"
  $userid = $_SERVER['QUERY_STRING'];

  if($userid != $_SESSION['user_id']){
    echo("<script>alert('You do not have access to this page')</script>");
    header("Location: ../shared/view-event.php");
  }

  //get organizer data from database
  $user_query = "SELECT u.* , o.organizer_website, p.user_privilege as privilege
  FROM user AS u
  INNER JOIN privilege AS p
  ON u.privilege_id = p.privilege_id
  JOIN organizer AS o
  ON u.user_id = o.user_id
  WHERE u.user_id = '$userid'";

  //Queries for organizer
  $find_event_query = "SELECT tl.event_id FROM team_list AS tl
  INNER JOIN participant ON tl.participant_id = participant.participant_id
  INNER JOIN user ON user.user_id = participant.user_id
  INNER JOIN event AS evt ON evt.event_id = tl.event_id
  WHERE user.user_id = $userid
  AND evt.event_date < CURRENT_DATE()";
  // Execute the query
  $total_organized = mysqli_query($con, $find_event_query);
  $total_organized_num = mysqli_fetch_assoc($total_organized);

  $organized_event = "SELECT * FROM event
  INNER JOIN organizer ON organizer.organizer_id = event.organizer_id
  INNER JOIN user ON user.user_id = organizer.user_id
  WHERE user.user_id = $userid
  ORDER BY event_date ASC";

  $user_query_run = mysqli_query($con, $user_query);
  $userdata = mysqli_fetch_assoc($user_query_run);

  $organized_event_run = mysqli_query($con, $organized_event);
  $organized_event_num = mysqli_num_rows($organized_event_run);
  $user_participate_result = mysqli_query($con, $find_event_query);

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
  <link rel="stylesheet" href="../../../src/stylesheets/org-view-profile.css">
  <link rel="stylesheet" href="../../../src/stylesheets/view-event.css">
  <link rel="stylesheet" href="../../../src/stylesheets/admin-profile.css">
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
      <div class="row mb-1 mb-5">
        <div class="col-2">
          <div class="w-50" onclick="history.back()">
            <i class="animate-up-2 fa-solid fa-circle-arrow-left fa-2xl m-5"></i>
          </div>
        </div>
        <div class="col-8">
          <h1 class="text-center mt-4">Profile</h1>
        </div>
        <div class="col-2">
          <a href="../shared/edit-profile.php" class="btn btn-primary mt-4 cursor-pointer">Edit Profile</a>
        </div>
      </div>
        <!--label user detail-->
        <div class="row">
          <div class="col-1">
          </div>
          <div class="col-2 justify-content-center ml-5">
            <div class="row">
              <p class="fs-5 animate-up-2 text-format">Username :</p>
            </div>
            <div class="row">
              <p class="fs-5 animate-up-2 text-format">Name :</p>
            </div>
            <div class="row">
              <p class="fs-5 animate-up-2 text-format">Privilege :</p>
            </div>
            <div class="row">
              <p class="fs-5 animate-up-2 text-format">Email :</p>
            </div>
            <div class="row">
              <p class="fs-5 animate-up-2 text-format">Contact :</p>
            </div>
            <div class="row">
              <p class="fs-5 animate-up-2 text-format">Website :</p>
            </div>
          </div>
          <!--display user details-->
          <div class="col-2 justify-content-center">
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
                <?php echo $userdata['privilege']?>
              </p>
            </div>
            <div class="row">
              <p class="fs-5 fw-bold animate-up-2 text-format">
                <?php
                  if (is_null($userdata['email'])) {
                    echo "No email saved";
                  } else {
                    echo $userdata['email'];
                  }
                ?>
              </p>
            </div>
            <div class="row">
              <p class="fs-5 fw-bold animate-up-2 text-format">
                <?php
                  if (is_null($userdata['telephone']))
                  {
                    echo "No contact saved";
                  }
                  else
                  {
                    echo $userdata['telephone'];
                  }
                  ?>
              </p>
            </div>
            <div class="row">
              <p class="fs-5 fw-bold animate-up-2 text-format">
                <?php
                  if (is_null($userdata['organizer_website']))
                  {
                    echo "No website saved";
                  }
                  else
                  {
                    echo $userdata['organizer_website'];
                  }
                  ?>
              </p>
            </div>
          </div>
          <!--event organizer-->
          <div class="evt-dis-cont ml-5 mt-5">
            <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
              <div class="card-header">
                <h3 class="h5 card-title">Events Organized</h3>
              </div>
              <div class="card-body">
                <!--PHP code retrieve no of events then display-->
                <p>
                  <?php
                      echo $organized_event_num;
                  ?>
                  <i class="fa-solid fa-calendar-days"></i>
                </p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row second_row">
        <div class="col">
          <!-- Tab Nav -->
          <div class="nav-wrapper position-relative mb-4">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row cancel-box-shadow" id="tabs-icons-text" role="tablist">
              <li class="nav-item cancel-box-shadow">
                <a class="nav-link mb-sm-3 mb-md-0 active enlarge-content" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa-solid fa-calendar-days"></i>Events Organized</a>
              </li>
            </ul>
          </div>
          <!-- End of Tab Nav -->
          <!-- Tab Content -->
          <div class="card shadow-inset bg-primary border-light p-4 rounded ">
            <div class="card-body p-0">
              <div class="tab-content" id="tabcontent2">
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <div class="content-cont">
                    <!--loop all participated event-->
                    <?php
                    if(mysqli_num_rows($organized_event_run) > 0)
                    {
                      foreach($organized_event_run as $event_query) // Run SQL query
                      {
                      //get number of judge
                      $evt_id = intval($event_query['event_id']);

                      $judge_query = "SELECT COUNT(judge.judge_id) FROM judge
                      INNER JOIN judges_list ON judges_list.judge_id = judge.judge_id
                      INNER JOIN event ON event.judges_list_id = judges_list.judges_list_id
                      WHERE judges_list.judges_list_id = event.judges_list_id
                      AND event.event_id = $evt_id";
                      $num_judge_query = mysqli_query($con, $judge_query);
                      // Fetch data
                      $num_judge = mysqli_fetch_assoc($num_judge_query);
                    ?>
                    <div class="event-cont col-12 pb-3">
                      <?php
                        if($event_query["active"] == "1"){
                          echo '<a href="../organizer/event-details.php?';
                            echo $event_query['event_id'];
                          echo'">';
                        }
                        else{
                          echo '<a href="../organizer/event-summary.php?';
                            echo $event_query['event_id'];
                          echo'">';
                        }
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
                                    $event_date = date("d-m-Y",strtotime($event_query["event_date"]));
                                    $today_date = date("d-m-Y",strtotime($current_date));
                                    $active = $event_query["active"];
                                    $participant_sql= "SELECT COUNT(participant_id) AS num_participant FROM team_list WHERE event_id = '$event_query[event_id]'";
                                    $participant_result = mysqli_query($con, $participant_sql);
                                    while($participant_row=mysqli_fetch_array($participant_result)){
                                      $num_participant = $participant_row["num_participant"];
                                    }
                                    if($active == '1'){
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
                                  <p>Date: <?php echo $event_date ?> </p>
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
                    ?>
                  </div> <!--content-cont-->
                </div>
              </div>
            </div>
          </div>
              <!-- End of Tab Content -->
        </div>
      </div>
    </div>
  </div>
</div>
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
</script>
</body>
</html>
