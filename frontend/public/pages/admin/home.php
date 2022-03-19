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
                ?>
                <ul class="list-group text-gray">
                  <!--Use PHP to get Number of admins, participants, judges and organizers from the DB-->
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content">
                    <a href="#">Admins</a>
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
                    <a href="#">Organizers</a>
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
                    <a href="#">Participants</a>
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
                    <a href="#">Judges</a>
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
                    <a href="#">Dancing Fiesta</a>
                    <span class="badge badge-gray badge-pill">RM2000</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content margin-list">
                    <a href="#">Traditional Costume Event</a>
                    <span class="badge badge-gray badge-pill">RM1382</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content margin-list">
                    <a href="#">Singing Event</a>
                    <span class="badge badge-gray badge-pill">RM1000</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small enlarge-content margin-list">
                    <a href="#">Anime Costume Event</a>
                    <span class="badge badge-gray badge-pill">RM830</span>
                  </li>
                </ul>
              </div>
            <!--</div>-->
          </div>
        </div>
        <!--3rd row-->
        <div class="row" style="margin-top: 4%;">
          <!--3rd row 1st col-->
          <div class="row-3-col-1">
            <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
              <div class="card-header">
                <h3 class="h5 card-title">Total User Count</h3>
              </div>
              <div class="card-body">
                <!--Use PHP to get value from the other 4 and sum them up to display-->
                <p>123 <i class="fa-solid fa-users"></i></p>
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
                <p>65 <i class="fa-solid fa-calendar-days"></i></p>
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
                <p>10 <i class="fa-solid fa-calendar-check"></i></p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>
          <div class="row-3-col-4">
            <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
              <div class="card-header">
                <h3 class="h5 card-title">Prize Money Won</h3>
              </div>
              <div class="card-body">
                <!--PHP code retrieve total prize won then display-->
                <p>
                  RM203000
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