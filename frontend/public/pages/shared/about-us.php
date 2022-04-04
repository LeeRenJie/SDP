<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/about-us.css" />
  <title>About Us</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php
      if(!isset($_SESSION)) {
        session_start();
      }
      if (!isset($_SESSION['privilege'])){
        ?>
        <div class="col overflow-y-auto marg" style="border-radius:30px;">
          <div class="overflow-y-auto">
            <div onclick="history.back()" class="pl-5 cursor-pointer pt-4">
              <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
            </div>
            <div class="pos">
              <img class="image" src="../../images/logo.svg" alt="logo" class="logo" >
            </div>
            <div class="d-flex justify-content-center">
              <div class="card bg-primary border-light shadow-soft w-60 card-height pb-4">
                <div class="text-center">
                  <h1 class="display-2 mt-4">About Us</h1>
                </div>
                <div class="p-4">
                  <p>
                    Judgeable is a one-stop web application that allows organisers to organize competitions, participants to join the competitions, and judges to judge the competitions.
                    Organisers can easily create competitions with banners, specific rules, date, time, prizes and more!
                    After creating the competition, it will be listed on our all events page which can be accessed by participants to join.
                    Judges can enter their unique code provided by the organizer to join the event and provide scores for each criteria and comment for each participant or team.
                    <br>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      else{
        include '../shared/sidebar.php';
        ?>
        <div class="basis-10/12 bg-shadow overflow-y-auto back-shadow" style="border-radius:30px;">
          <div class="overflow-y-auto">
            <div onclick="history.back()" class="pl-5 cursor-pointer pt-4">
              <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
            </div>
            <div class="pos">
              <img class="image" src="../../images/logo.svg" alt="logo" class="logo" >
            </div>
            <div class="d-flex justify-content-center">
              <div class="card bg-primary border-light shadow-soft card-height pb-4">
                <div class="text-center">
                  <h1 class="display-2 mt-4">About Us</h1>
                </div>
                <div class="p-4">
                  <p>
                    Judgeable is a one-stop web application that allows organisers to organize competitions, participants to join the competitions, and judges to judge the competitions.
                    Organisers can easily create competitions with banners, specific rules, date, time, prizes and more!
                    After creating the competition, it will be listed on our all events page which can be accessed by participants to join.
                    Judges can enter their unique code provided by the organizer to join the event and provide scores for each criteria and comment for each participant or team.
                    <br>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
    ?>
  </div>
</body>
</html>