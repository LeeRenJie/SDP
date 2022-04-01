<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="../../../src/stylesheets/admin-users.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/28d45fc291.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/neumorphism.css">
  <link rel="stylesheet" href="../../../src/stylesheets/admin-home.css">
  <title>Document</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <!--Connection to Database-->
  <?php include("../../../../backend/conn.php")?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto dark_shadow">
      <!--Content Starts here-->
      <!--1st row-->
      <div>
        <!--1st row 1st col-->
        <div class="row">
          <div class="col">
            <p class="d-none">Empty</p>
          </div>
          <div class="col">
            <!--Animate-up-2 is a class to implement up animation when hovered-->
            <button type="button" class="normal_button animate-up-2 backup-db-button" style="margin-top: 5%;" onclick="Redirect_backup()">
              <i class="fa-solid fa-download">
              </i> Backup Database
            </button>
            <button type="button" class="normal_button animate-up-2 restore-db-button" onclick="Redirect_restore()">
              <i class="fa-solid fa-upload"></i>  Restore Database
            </button>
          </div>
        </div>
        </div>
        <!--2nd row-->
        <div class="row" style="margin-top: 1.5%;">
          <!--Content Starts here-->
          <!--2nd row 1st col-->
          <div class="col row-2-col-1">
            <!--<div class="card bg-primary shadow-inset border-light p-3 mx-auto card_style_1">-->
              <div class="card-body shadow-soft border border-light rounded inner_card_1">
                <h3 class="h5 card-title">
                  User Type 
                  <i class="fa-solid fa-user-group"></i>
                </h3>
                <!--retrieve each user type's count data from db-->
                <?php
                  $admin_query = "SELECT COUNT(user_id) FROM user WHERE privilege_id ='1' ";
                  $admin_query_run = mysqli_query($con, $admin_query);

                  $organizer_query = "SELECT COUNT(user_id) FROM user WHERE privilege_id ='2' ";
                  $organizer_query_run = mysqli_query($con, $organizer_query);

                  $participant_query = "SELECT COUNT(user_id) FROM user WHERE privilege_id ='3' ";
                  $participant_query_run = mysqli_query($con, $participant_query); 

                  $judge_query = "SELECT COUNT(judge_id) FROM judge";
                  $judge_query_run = mysqli_query($con, $judge_query); 

                  $event_prize_pool = "SELECT event_id, event_name, SUM(prize) FROM event INNER JOIN prizes_list ON event.prizes_list_id = prizes_list.prizes_list_id INNER JOIN prize ON prizes_list.prize_id = prize.prize_id GROUP BY event_name ORDER BY SUM(prize) DESC LIMIT 4";
                  $event_prize_pool_run = mysqli_query($con, $event_prize_pool); 

                  //create arrays to store each event name and prize pool
                  $event_name = array();
                  $prize_pool = array();
                  //Run query to store each individual event into array
                  WHILE($prize_pool_row = mysqli_fetch_array($event_prize_pool_run))
                  {
                    array_push($event_name, $prize_pool_row[1]);
                    array_push($prize_pool, $prize_pool_row[2]);
                  }

                  $total_user_query = "SELECT COUNT(user_id) FROM user";
                  $total_user_query_run = mysqli_query($con, $total_user_query);

                  $judge_count_query = "SELECT COUNT(judge_id) FROM judge";
                  $judge_count_query_run = mysqli_query($con, $judge_count_query); 

                  $total_event_query = "SELECT COUNT(event_id) FROM event;";
                  $total_event_query_run = mysqli_query($con, $total_event_query);

                  $total_prize_query = "SELECT SUM(prize) FROM prize;";
                  $total_prize_query_run = mysqli_query($con, $total_prize_query);

                  //retrieve time to calculate active events
                  $time_query = "SELECT event_id, event_date, start_time, end_time FROM event";
                  $time_query_run = mysqli_query($con, $time_query); 

                  //create arrays to store start date,end date
                  $event_date = array();
                  $start_time = array();
                  $end_time = array();
                  $start_date = array();
                  $end_date = array();

                  //set timezone to find current time in kuala lumpur
                  $timezone ="Asia/Kuala_Lumpur";
                  date_default_timezone_set($timezone);
                  $DateAndTime = date('Y-m-d H:i:s ', time());  

                  //use while loop to loop every row
                  WHILE($time_row = mysqli_fetch_array($time_query_run))
                  {
                    array_push($event_date, $time_row[1]);   
                    array_push($start_time, $time_row[2]);
                    array_push($end_time, $time_row[3]);  
                  }
                  //convert int format time from phpmyadmin db into date format and store in start_date array
                  for ($i=0; $i < count($event_date) ; $i++) { 
                    $a = strval($event_date[$i]);
                    $b = strval($start_time[$i]);
                    $concatenation = $a . $b;
                    $date = date_create($concatenation);
                    $datee =  date_format($date, 'Y-m-d H:i:s');
                    array_push($start_date, $datee);
                  }
                  //convert int format time from phpmyadmin db into date format and store in end_date array
                  for ($i=0; $i < count($event_date) ; $i++) { 
                    $a = strval($event_date[$i]);
                    $b = strval($end_time[$i]);
                    $concatenation = $a . $b;
                    $date = date_create($concatenation);
                    $datee =  date_format($date, 'Y-m-d H:i:s');
                    array_push($end_date, $datee);
                  }
                  //loop 4 times to compare our real time with the event time to check if its active right now
                  $active_count = 0;
                  for ($j=0; $j < count($start_date) ; $j++) { 
                    if ($DateAndTime>$start_date[$j] and $DateAndTime < $end_date[$j]) {
                      $active_count = $active_count + 1 ;
                    }
                  }
                ?>
                <ul class="list-group text-gray">
                  <!--Use PHP to get Number of admins, participants, judges and organizers from the DB-->
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content">
                    Admins
                    <span class="badge badge-gray badge-pill">
                      <?php
                        //var_dump dumps everything and print it out (for debug)
                        //var_dump($admin_row);
                        //echo implode(" ",$admin_row);
                        WHILE($admin_row = mysqli_fetch_array($admin_query_run))
                        {
                          echo $admin_row[0];
                        }
                      ?>
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content margin-list">
                    Organizers
                    <span class="badge badge-gray badge-pill">
                      <?php
                        //var_dump dumps everything and print it out (for debug)
                        //var_dump($admin_row);
                        //echo implode(" ",$admin_row);
                        WHILE($organizer_row = mysqli_fetch_array($organizer_query_run))
                        {
                          echo $organizer_row[0];
                        }
                      ?>
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content margin-list">
                    Participants
                    <span class="badge badge-gray badge-pill">
                      <?php
                        //var_dump dumps everything and print it out (for debug)
                        //var_dump($admin_row);
                        //echo implode(" ",$admin_row);
                        WHILE($participant_row = mysqli_fetch_array($participant_query_run))
                        {
                          echo $participant_row[0];
                        }
                      ?>
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content margin-list">
                    Judges
                    <span class="badge badge-gray badge-pill">
                      <?php
                        //var_dump dumps everything and print it out (for debug)
                        //var_dump($admin_row);
                        //echo implode(" ",$admin_row);
                        WHILE($judge_row = mysqli_fetch_array($judge_query_run))
                        {
                          echo $judge_row[0];
                        }
                      ?>
                    </span>
                  </li>
                </ul>
              </div>
            <!--</div>-->
          </div>
          <!--2nd row 2nd col-->
          <div class="col row-2-col-2">
            <!--<div class="card bg-primary shadow-inset border-light p-3 mx-auto card_style_2">-->
              <div class="card-body shadow-soft border border-light rounded inner_card_2">
                <h3 class="h5 card-title">
                  Events Prize Pool 
                  <i class="fa-solid fa-money-bill-wave"></i>
                </h3>
                <ul class="list-group text-gray">
                  <!--Use PHP to get Top 4 highest prize pool from the DB-->
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content">
                      <?php
                        if (mysqli_num_rows($event_prize_pool_run) > 0)
                        {
                          echo $event_name[0];
                      ?>
                    <span class="badge badge-gray badge-pill">
                      <?php
                          echo $prize_pool[0];
                        }
                      ?>
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content margin-list">
                      <?php
                        if (mysqli_num_rows($event_prize_pool_run) > 1)
                        {
                          echo $event_name[1];
                      ?>
                    <span class="badge badge-gray badge-pill">
                      <?php
                          echo $prize_pool[1];
                        }
                      ?>
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content margin-list">
                      <?php
                        if (mysqli_num_rows($event_prize_pool_run) > 2)
                        {
                          echo $event_name[2];
                      ?>
                    <span class="badge badge-gray badge-pill">
                      <?php
                          echo $prize_pool[2];
                        }
                      ?>
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content margin-list">
                      <?php
                        if (mysqli_num_rows($event_prize_pool_run) > 3)
                        {
                          echo $event_name[3];
                      ?>
                    <span class="badge badge-gray badge-pill">
                      <?php
                          echo $prize_pool[3];
                        }
                      ?>
                    </span>
                  </li>
                </ul>
              </div>
            <!--</div>-->
          </div>
        </div>
        <!--3rd row-->
        <div class="row" style="margin-top: 4%;">
          <!--3rd row 1st col-->
          <div class="row-3-col-1 bot_padd">
            <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
              <div class="card-header">
                <h3 class="h5 card-title">Total User Count</h3>
              </div>
              <div class="card-body">
                <p>
                  <?php
                    WHILE($total_user_row = mysqli_fetch_array($total_user_query_run))
                    {
                      $A = $total_user_row[0];
                      WHILE($total_judge_row = mysqli_fetch_array($judge_count_query_run))
                      {
                        $B = $total_judge_row[0];
                        $total = $A + $B;
                        echo $total;
                      }
                    }
                  ?>   
                  <i class="fa-solid fa-users"></i>
                </p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>
          <div class="row-3-col-2">
            <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
              <div class="card-header">
                <h3 class="h5 card-title"> Total Event Count</h3>
              </div>
              <div class="card-body">
                <!--PHP code retrieve no of events then display-->
                <p>
                  <?php
                    WHILE($total_event_row = mysqli_fetch_array($total_event_query_run))
                    {
                      echo $total_event_row[0];
                    }
                  ?> 
                  <i class="fa-solid fa-calendar-days"></i>
                </p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>
          <div class="row-3-col-3">
            <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
              <div class="card-header" style="height:87px">
                <h4 class="h5 card-title">Active Event Count</h4>
              </div>
              <div class="card-body">
                <!--PHP code retrieve no of active events(events that had not pass the start date) then display-->
                <p>
                  <?=$active_count?> 
                  <i class="fa-solid fa-calendar-check"></i>
                </p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>
          <div class="row-3-col-4">
            <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
              <div class="card-header">
                <h3 class="h5 card-title">Total Cash Prize</h3>
              </div>
              <div class="card-body">
                <!--PHP code retrieve total prize won then display-->
                <p>
                  <?php
                    WHILE($total_prize_row = mysqli_fetch_array($total_prize_query_run))
                    {
                      echo "RM";
                      if (isset($total_prize_row[0]))
                      {
                        echo $total_prize_row[0];
                      }
                      else
                      {
                        echo "0";
                      }
                    }
                  ?> 
                </p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type = "text/javascript">
    function Redirect_backup()
    {
      location.href = "http://localhost:8080/phpmyadmin/index.php?route=/server/export";
      alert("Please log into phpMyAdmin by clicking the 'Go' button, then select 'Export' from the navigation bar.");
    }
    function Redirect_restore()
    {
      window.location = "http://localhost:8080/phpmyadmin/index.php?route=/server/import";
      alert("Please log into phpMyAdmin by clicking the 'Go' button, then select 'Import' from the navigation bar.");
    }
  </script>
</body>
</html>