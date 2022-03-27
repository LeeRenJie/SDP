<?php
  include("../../../../backend/conn.php");
  $event_prize_pool = "SELECT event_id, event_name, SUM(prize) FROM event INNER JOIN prizes_list ON event.prizes_list_id = prizes_list.prizes_list_id INNER JOIN prize ON prizes_list.prize_id = prize.prize_id GROUP BY event_name LIMIT 4";
  $event_prize_pool_run = mysqli_query($con, $event_prize_pool); 


  $judge_count_query = "SELECT COUNT(judge_id) FROM judge";
  $judge_count_query_run = mysqli_query($con, $judge_count_query); 

  $total_user_query = "SELECT COUNT(user_id) FROM user";
  $total_user_query_run = mysqli_query($con, $total_user_query);

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


  $time_query = "SELECT event_id, event_date, start_time, end_time FROM `event`";
  $time_query_run = mysqli_query($con, $time_query); 

  //create arrays to store each event name and prize pool
  $event_name = array();
  $prize_pool = array();

  $event_date = array();
  $start_time = array();
  $end_time = array();
  $start_date = array();
  $end_date = array();

  $timezone ="Asia/Kuala_Lumpur";
  date_default_timezone_set($timezone);

  $DateAndTime = date('Y-m-d H:i:s ', time());  
  //echo "The current date and time are $DateAndTime        D    ";



  WHILE($prize_pool_row = mysqli_fetch_array($event_prize_pool_run))
  {
    $arr_length = count($prize_pool_row) - 3;
    //var_dump($prize_pool_row); (debug)
    //echo $arr_length; (debug)

    //loop to get event name 
    for ($x = 1; $x < $arr_length; $x+=3) {
      //echo  $prize_pool_row[$x] ; (debug)
      array_push($event_name, $prize_pool_row[$x]);

      //access the top 1 first event per prize pool
      //echo $event_name[0];
    }
    //loop to get total prize pool per event
    for ($x = 2; $x < $arr_length; $x+=3) {
      //echo  $prize_pool_row[$x] ; (debug)
      array_push($prize_pool, $prize_pool_row[$x]);

      //access the top 1 event's total prize pool
      //echo $prize_pool[0];
    }
  }

  //find the number of rows returned by query
  $time_length = mysqli_num_rows($time_query_run);
  WHILE($time_row = mysqli_fetch_array($time_query_run))
  {
    //loop each array from query and store event date into event_date array
    for ($x = 1; $x < $time_length; $x+=4) {
      array_push($event_date, $time_row[$x]);      
    }
    //loop each array from query and store event start time into start_time array
    for ($x = 2; $x < $time_length; $x+=4) {
      array_push($start_time, $time_row[$x]);      
    }
    //loop each array from query and store event end time into end_time array
    for ($x = 3; $x < $time_length; $x+=4) {
      array_push($end_time, $time_row[$x]);      
    }
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
  //echo $end_date[2];

  
  
  //loop 4 times to compare our real time with the event time to check if its active right now
  $active_count = 0;
  for ($j=0; $j < count($start_date) ; $j++) { 
    if ($DateAndTime>$start_date[$j] and $DateAndTime < $end_date[$j]) {
      $active_count = $active_count + 1 ;
    }
  }

  //print number of active events
  echo $active_count;


  //echo $concatenation;


  //echo $start_time[0];
  //echo $start_time[1];
  //echo $start_time[2];
  //echo $start_time[3];
  //echo $end_time[0];
  //echo $end_time[1];
  //echo $end_time[2];
  //echo $end_time[3];
?>