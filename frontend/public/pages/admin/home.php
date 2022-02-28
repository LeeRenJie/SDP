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
  <title>Document</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto dark_shadow">
      <!--Content Starts here-->
      <div style="">
        <!--1st row 1st col-->
        <div class="row">
          <div class="col">
            <p class="d-none">Empty</p>
          </div>
          <div class="col">
            <!--Animate-up-2 is a class to implement up animation when hovered-->
            <button class="normal_button animate-up-2" style="margin-top: 5%;"><i class="fa-solid fa-download"></i> Backup Database</button>
            <button class="normal_button animate-up-2" style="margin-top: 5%; margin-left: 10%;"><i class="fa-solid fa-upload"></i>  Restore Database</button>
          </div>
        </div>
        </div>
        <!--1st row-->
        <div class="row" style="margin-top: 1.5%;">
          <!--Content Starts here-->
          <!--2nd row 1st col-->
          <div class="col" style="margin-top: 2%; margin-right:-5%;">
            <div class="card bg-primary shadow-inset border-light p-3 mx-auto" style="height:232.6px; width: 450px;">
              <div class="card-body shadow-soft border border-light rounded p-3">
                <h3 class="h5 card-title">User Type <i class="fa-solid fa-user-group"></i></h3>
                <ul class="list-group text-gray">
                  <!--Use PHP to get Number of admins, participants, judges and organizers from the DB-->
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small">
                    <a href="#">Admins</a>
                    <span class="badge badge-gray badge-pill">5</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small">
                    <a href="#">Judges</a>
                    <span class="badge badge-gray badge-pill">15</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small">
                    <a href="#">Organizers</a>
                    <span class="badge badge-gray badge-pill">8</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small">
                    <a href="#">Participants</a>
                    <span class="badge badge-gray badge-pill">95</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!--2nd row 2nd col-->
          <div class="col" style="margin-top: 2%; margin-left:-5%;">
            <div class="card bg-primary shadow-inset border-light p-3 mx-auto" style="height:232.6px; width: 450px;">
              <div class="card-body shadow-soft border border-light rounded p-3">
                <h3 class="h5 card-title">Events Prize Pool <i class="fa-solid fa-money-bill-wave"></i></h3>
                <ul class="list-group text-gray">
                  <!--Use PHP to get Top 4 highest prize pool from the DB-->
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small">
                    <a href="#">Dancing Fiesta</a>
                    <span class="badge badge-gray badge-pill">RM2000</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small">
                    <a href="#">Traditional Costume Event</a>
                    <span class="badge badge-gray badge-pill">RM1382</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small">
                    <a href="#">Singing Event</a>
                    <span class="badge badge-gray badge-pill">RM1000</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-1 px-0 font-small">
                    <a href="#">Anime Costume Event</a>
                    <span class="badge badge-gray badge-pill">RM830</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!--3rd row-->
        <div class="row" style="margin-top: 4%;">
          <!--3rd row 1st col-->
          <div class="" style="width: 275px; margin-left:4%;">
            <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
              <div class="card-header">
                <h3 class="h5 card-title">Total User Count</h3>
              </div>
              <div class="card-body">
                <!--Use PHP to get value from the other 4 and sum them up to display-->
                <p style="font-size:39px;">123 <i class="fa-solid fa-users"></i></p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>
          <div class="" style="width: 275px; margin-left:2.5%;">
            <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
              <div class="card-header" style="">
                <h3 class="h5 card-title"> Total Event Count</h3>
              </div>
              <div class="card-body">
                <!--PHP code retrieve no of events then display-->
                <p style="font-size:39px;">65 <i class="fa-solid fa-calendar-days"></i></p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>
          <div class="" style="width: 275px; margin-left:2.5%;">
            <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
              <div class="card-header" style="height:87px">
                <h4 class="h5 card-title">Active Event Count</h4>
              </div>
              <div class="card-body" style="">
                <!--PHP code retrieve no of active events(events that had not pass the start date) then display-->
                <p style="font-size:39px;">10 <i class="fa-solid fa-calendar-check"></i></p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>
          <div class="" style="width: 275px; margin-left:2.5%;">
            <div class="card bg-primary shadow-soft text-center border-light animate-up-2">
              <div class="card-header">
                <h3 class="h5 card-title">Prize Money Won</h3>
              </div>
              <div class="card-body">
                <!--PHP code retrieve total prize won then display-->
                <p style="font-size:39px;">
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
</body>
</html>