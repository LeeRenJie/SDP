<?php
//Connection to Database
  include("../../../../backend/conn.php");
  //include("../../../../backend/session.php");
  // start the session
  if(!isset($_SESSION)) {
    session_start();
  }
  if(isset($_SESSION['user_id']))
  {
    //get user id from url
    $userid = $_SESSION['user_id'];
    //Query to get all data
    $user_query = "SELECT * FROM user
    INNER JOIN privilege ON user.privilege_id = privilege.privilege_id
    WHERE user.user_id = $userid";
    // Execute the query
    $user_query_run = mysqli_query($con, $user_query);
    // Fetch data
    $userdata = mysqli_fetch_assoc($user_query_run);
  }

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
  <link rel="stylesheet" href="../../../src/stylesheets/view-event.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Judgeable</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php
  if(isset($_SESSION['privilege'])){
    include '../shared/sidebar.php';
      ?>
    <div class="basis-10/12 overflow-auto back-shadow" style="border-radius:30px;">
      <br>
      <div class="main-container">
  <?php
  }
  else{
    ?>
    <div class="overflow-y-auto wid-ma" style="border-radius:20px;">
      <br>
      <div>
    <?php
  }
  ?>
        <div class="flex flex-row">
          <span onclick="history.back()" class="pt-3 mr-2 cursor-pointer">
            <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
          </span>
          <form method="post" class="search-box">
            <!-- Search Container -->
            <div class="search-con">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search event.." name="search_text">
                <div class="input-group-append">
                  <button class="input-group-text" name="searchBtn" type="submit"><span class="fas fa-search"></span></button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- Event Details -->
        <!--start showing event-->
        <?php
        //when user click the search button (regardless of checkboxes)
        if (isset($_POST['searchBtn']))
        {
          // get the value of the search key
          $search_key = "";
          $search_key = $_POST['search_text'];
          $search_query = "SELECT * FROM event
                    WHERE event_name LIKE '%$search_key%' 
                    AND active = '1'
                    ORDER BY event_date ASC";
          $run_search_query = mysqli_query($con, $search_query);
          if(mysqli_num_rows($run_search_query) > 0)
          {
            foreach($run_search_query as $search_query) // Run SQL query
            {
              //get number of judge 
              $event_id = intval($search_query['event_id']);
              $judge_query = "SELECT COUNT(judge.judge_id) FROM judge
              INNER JOIN judges_list ON judges_list.judge_id = judge.judge_id
              INNER JOIN event ON event.judges_list_id = judges_list.judges_list_id
              WHERE judges_list.judges_list_id = event.judges_list_id
              AND event.event_id = $event_id";
              $num_judge_query = mysqli_query($con, $judge_query);
              // Fetch data
              $num_judge = mysqli_fetch_assoc($num_judge_query);
              //count participant
              $participant_sql= "SELECT COUNT(participant_id) AS num_participant FROM team_list WHERE event_id = '$event_id'";
              $participant_result = mysqli_query($con, $participant_sql);
              while($participant_row=mysqli_fetch_array($participant_result)){
                $num_participant = $participant_row["num_participant"];
              }
              echo "<div class='event-con'>";
                //check privilege
                if($userdata['user_privilege']=="organizer" || $userdata['user_privilege']=="admin"){
                  echo "<a href='../organizer/event-details.php?$event_id'>";
                }
                elseif($userdata['user_privilege']=="participant"){
                  echo "<a href='../participant/event-details.php?$event_id'>";
                }
                else{
                  echo "<a>";
                  //echo("<script>alert('Please login first')</script>");
                  //echo("<script>window.location = '../shared/login.php'</script>");
                }
                ?>
                  <button class="btn btn-primary animate-up-2" type="button">
                    <div class="event-con">
                      <div class="col-8">
                        <div class="title-con">
                          <h2><?php echo ($search_query['event_name']);?></h2> <!--change event name-->
                          <div class="status-con"> <!--change event status-->
                            <?php
                              $start_time = date("H:i",strtotime($search_query['start_time']));
                              $end_time = date("H:i",strtotime($search_query['end_time']));
                              if($search_query['active']== 1){
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
                            <p>Date: <?php echo ($search_query['event_date'])?> </p>
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
          else {
          ?>
            <div class="title-container">
              <div class="title-img-container">
                <img src="../../images/no_search_event.png" alt="title image" class="title-img">
                <img src="../../images/no_search_icon.png" alt="title people image" class="title-cross bounce">
              </div>
            </div>
          <?php
          }
        }
        else{
          $all_event_query = " SELECT * FROM event 
                    WHERE active = '1'
                    ORDER BY event_date ASC";
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
              //count participant
              $participant_sql= "SELECT COUNT(participant_id) AS num_participant FROM team_list WHERE event_id = '$event_id'";
              $participant_result = mysqli_query($con, $participant_sql);
              while($participant_row=mysqli_fetch_array($participant_result)){
                $num_participant = $participant_row["num_participant"];
              }
              if(isset($_SESSION['privilege'])){
                echo "<div class='event-con'>";
              }
              else{
                echo "<div class='event-con mb-4'>";
              }
                //check privilege
                if(isset($_SESSION['privilege'])){
                  if($userdata['user_privilege']=="organizer" || $userdata['user_privilege']=="admin"){
                    echo "<a href='../organizer/event-details.php?$event_id'>";
                  }
                  elseif($userdata['user_privilege']=="participant"){
                    echo "<a href='../participant/event-details.php?$event_id'>";
                  }
                  else{
                    echo "<a>";
                    //echo("<script>alert('Please login first')</script>");
                    //echo("<script>window.location = '../shared/login.php'</script>");
                  }
                }
                ?>
                  <button class="btn btn-primary animate-up-2" type="button">
                    <div class="event-con">
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
            } //for each
          }
          else {
          ?>
            <div class="title-container">
              <div class="title-img-container">
                <img src="../../images/more-event-soon.png" alt="title image" class="title-img">
                <img src="../../images/waiting.png" alt="title people image" class="title-cross bounce">
              </div>
            </div>
      <?php
          }
        }
      ?>
      </div> <!--main container-->
    </div>
  </div>
</body>
</html>