<?php
//Connection to Database
  include("../../../../backend/conn.php");
  // start the session
  if(!isset($_SESSION)) {
    session_start();
  }

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
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto back-shadow" style="border-radius:30px;">
      <br>
      <div class="main-container">
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
                    AND event_date > '$current_date'
                    ORDER BY event_date ASC";
          $run_search_query = mysqli_query($con, $search_query);
          if(mysqli_num_rows($run_search_query) > 0)
          {
            foreach($run_search_query as $search_query) // Run SQL query
            {
              //get number of judge 
              $evt_id = intval($search_query['event_id']);
              $judge_query = "SELECT COUNT(judge.judge_id) FROM judge
              INNER JOIN judges_list ON judges_list.judge_id = judge.judge_id
              INNER JOIN event ON event.judges_list_id = judges_list.judges_list_id
              WHERE judges_list.judges_list_id = event.judges_list_id
              AND event.event_id = $evt_id";
              $num_judge_query = mysqli_query($con, $judge_query);
              // Fetch data
              $num_judge = mysqli_fetch_assoc($num_judge_query);
              echo "<div class='event-con'>";
                //check privilege
                if($userdata['user_privilege']=="organizer"){
                  echo "<a href='../organizer/event-details.php'>";
                }
                elseif($userdata['user_privilege']=="participant"){
                  echo "<a href='../participant/event-details.php'>";
                }
                else{
                  echo "<a>";
                  echo("<script>alert('Please login first')</script>");
                  echo("<script>window.location = '../shared/login.php'</script>");
                }
                ?>
                  <button class="btn btn-primary animate-up-2" type="button">
                    <div class="event-con">
                      <div class="col-8">
                        <div class="title-con">
                          <h2><?php echo ($search_query['event_name']);?></h2> <!--change event name-->
                          <div class="status-con"> <!--change event status-->
                            <?php
                              if($search_query['event_date']>$current_date){
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
                            <p>Time: <?php echo ($search_query['start_time'])?> ~ <?php echo ($search_query['end_time'])?> </p>
                            <p>Participant : <?php echo ($search_query['max_team'])?></p>
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
        }
        else{
          $all_event_query = " SELECT * FROM event 
                    WHERE event_date > '$current_date'
                    ORDER BY event_date ASC";
          $run_all_event_query = mysqli_query($con, $all_event_query);
          if(mysqli_num_rows($run_all_event_query) > 0)
          {
            foreach($run_all_event_query as $event_query) // Run SQL query
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
              echo "<div class='event-con'>";
                //check privilege
                if($userdata['user_privilege']=="organizer"){
                  echo "<a href='../organizer/event-details.php'>";
                }
                elseif($userdata['user_privilege']=="participant"){
                  echo "<a href='../participant/event-details.php'>";
                }
                else{
                  echo "<a>";
                  echo("<script>alert('Please login first')</script>");
                  echo("<script>window.location = '../shared/login.php'</script>");
                }
                ?>
                  <button class="btn btn-primary animate-up-2" type="button">
                    <div class="event-con">
                      <div class="col-8">
                        <div class="title-con">
                          <h2><?php echo ($event_query['event_name']);?></h2> <!--change event name-->
                          <div class="status-con"> <!--change event status-->
                            <?php
                              if($event_query['event_date']>$current_date){
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
                            <p>Time: <?php echo ($event_query['start_time'])?> ~ <?php echo ($event_query['end_time'])?> </p>
                            <p>Participant : <?php echo ($event_query['max_team'])?></p>
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
        }
      ?>
      </div> <!--main container-->
    </div>
  </div>
</body>
</html>