<?php
  // Connect to database
  include("../../../../backend/conn.php");
  if(!isset($_SESSION)){
    session_start();
  };

  if ($_SESSION['privilege'] != "organizer") {
    echo("<script>alert('You do not have access to this page')</script>");
    header("Location: ../shared/view-event.php");
  };

  // Get organizer id
  $organizer_sql = "SELECT * FROM organizer WHERE user_id = '$_SESSION[user_id]'";
  $organizer_result = mysqli_query($con, $organizer_sql);
  if ($organizer_result){
    $organizer_row = mysqli_num_rows($organizer_result);
  }
  while($row = mysqli_fetch_assoc($organizer_result)){
    $organizer_id = $row["organizer_id"];
  }

  $search_key = "";
  if(isset($_POST['searchBtn'])){
    $search_key = $_POST['search_key'];
  }

  // Get event details that has current organizer id
  $event_sql = (
    "SELECT e.event_id,e.event_name, e.active, e.event_date,e.start_time,e.end_time,
    COUNT(j.judge_name) AS num_judges
    FROM event AS e
    JOIN judges_list AS jl ON e.judges_list_id = jl.judges_list_id
    JOIN judge AS j ON jl.judge_id = j.judge_id
    WHERE e.organizer_id = '$organizer_id' and e.event_name LIKE '%$search_key%' and e.active = '0'
    GROUP BY event_id
    ORDER BY event_date DESC
  ");
  $event_result = mysqli_query($con, $event_sql);
  $number_row = mysqli_num_rows($event_result);
  $row=mysqli_fetch_assoc($event_result);

  // Get number of judges

  // Close the connection
  mysqli_close($con);
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
          <form method="post" class="search-box inline-block">
            <!-- Search Container -->
            <div class="search-con">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search event.." name="search_key">
                <div class="input-group-append">
                  <button class="input-group-text" name="searchBtn" type="submit"><span class="fas fa-search"></span></button>
                </div>
              </div>
            </div>
          </form>
          <a href="../organizer/create-event.php" class="float-right btn btn-primary mr-5 cursor-pointer" >Create an event</a>
        </div>
        <?php
        if($number_row == 0 || is_null($row["event_name"])){
        ?>
          <div class="flex flex-col justify-center">
            <h1 class="text-center">No event history found</h1>
          </div>
        <?php
        }
        else
        {
          foreach($event_result as $row){
            $start_time = date("H:i",strtotime($row["start_time"]));
            $end_time = date("H:i",strtotime($row["end_time"]));
            $event_date = date("d-m-Y",strtotime($row["event_date"]));
            $participant_sql= "SELECT COUNT(participant_id) AS num_participant FROM team_list WHERE event_id = '$row[event_id]'";
            $participant_result = mysqli_query($con, $participant_sql);
            while($participant_row=mysqli_fetch_array($participant_result)){
              $num_participant = $participant_row["num_participant"];
            }
        ?>
        <!-- Event Details -->
        <div class="event-con">
          <a href="../organizer/event-summary.php?<?=$row['event_id']?>"> <!--href to event-->
            <button class="btn btn-primary animate-up-2" type="button">
              <div class="event-con">
                <div class="col-8">
                  <div class="title-con">
                    <h2><?php echo $row["event_name"];?></h2>
                    <div class="status-con">
                      <?php
                      if ($row["active"] == 1) {
                        echo '<small class="status-on">active</small>';
                      }else{
                        echo '<small class="status-off">ended</small>';
                      }
                      ?>
                    </div>
                  </div>
                  <div class="details-con">
                    <div class="info-con">
                      <p>Date : <?php echo $event_date;?> </p>
                      <p>Judges : <?php echo $row["num_judges"];?></p>
                    </div>
                    <div class="info-con">
                      <p>Time : <?php echo $start_time?> ~ <?php echo $end_time?></p>
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
      </div> <!--main container-->
    </div>
  </div>
</body>
</html>