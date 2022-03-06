<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/28d45fc291.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/neumorphism.css">
  <link rel="stylesheet" href="../../../src/stylesheets/admin-user_profile.css">
  <title>User Profile</title>
</head>
<!--RMB copy paste into 3 diff users use ? to choose user-->
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto dark_shadow">
      <!--1st row-->
      <div class="row" style="height:">
        <!--1st row 1st col-->
        <div class="col-2">
          <a href="home.php">
            <i class="fa-solid fa-circle-arrow-left fa-2xl m-5"></i>
          </a>
        </div>
        <!--1st row 2nd col-->
        <div class="col-2 justify-content-center" style="margin-left: -5%;">
          <div class="profile-container">
            <!--echo ($userdata['user_image']) ADD this to the src attribute to fetch img from db-->
            <img class="circle_img" id="img" name="img" src="../../images/testing.jpg" > 
          </div>
        </div>
        <!--1st row 3rd col-->
        <div class="col-2 justify-content-center" style="margin-left: 2%; margin-top: 4%;">
          <div class="row">
            <p class="fs-5 animate-up-2" style="margin-top: 18%; color: black;">Username :</p>
          </div>
          <div class="row">
            <p class="fs-5 animate-up-2" style="margin-top:18%; color: black;">Name :</p>
          </div>
          <div class="row">
            <p class="fs-5 animate-up-2" style="margin-top:18%; color: black;">Privilege :</p>
          </div>
        </div>
        <!--1st row 4th col-->
        <div class="col-2 justify-content-center" style="margin-top: 4%;">
          <div class="row">
            <!--add php to fetch data from db-->
            <p class="fs-5 fw-bold animate-up-2" style="margin-top: 18%; color: black;">Chiang 69</p>
          </div>
          <div class="row">
            <p class="fs-5 fw-bold animate-up-2" style="margin-top: 18%; color: black;">Chiang Juo Han</p>
          </div>
          <div class="row">
            <p class="fs-5 fw-bold animate-up-2" style="margin-top: 18%; color: black;">Participant</p>
          </div>
        </div>
        <div class="col" style="margin-top: 4%; margin-left: -5%;">
          <div class="card bg-primary shadow-soft text-center border-light animate-up-2" style="margin: auto; width: 55%;">
            <div class="card-header" style="">
              <h3 class="h5 card-title"> Events Participated</h3>
            </div>
            <div class="card-body">
              <!--PHP code retrieve no of events then display-->
              <p style="font-size:39px;">23 <i class="fa-solid fa-calendar-days text-decoration-underline"></i></p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
      </div>
      <!--2nd row-->
      <div class="row" style="margin-top: 5%; height: 350px;">
        <div class="col-6">
          <div class="card bg-primary shadow-bg text-center border-light animate-up-2 center-division">
            <div class="row">
              <div class="col">
                <div class="circular">
                  <div class="inner">
                  </div>
                  <div class="number">
                    <p style="font-size: 18px; margin-bottom: -10%;">13</p>
                    <p style="font-size: 12px; margin-top: 0%;">out of 14</p>
                  </div>
                  <div class="circle">
                    <div class="bar left">
                      <div class="progress">
                      </div>
                    </div>
                    <div class="bar right">
                      <div class="progress">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="" style="width: 40px; margin-top: 15%;">
                <div class="self_circle text-end" id="small_circle">
                  
                </div>
                <label for="small_circle" class="label_format">Completed </label>
              </div>
              <div class="col">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>

</script>
</body>
</html>