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
      <div class="row first_row">
        <!--1st row 1st col-->
        <div class="col-2">
          <a href="home.php">
            <i class="fa-solid fa-circle-arrow-left fa-2xl m-5"></i>
          </a>
        </div>
        <!--1st row 2nd col-->
        <div class="col-2 justify-content-center first_row_second_col">
          <div class="profile-container">
            <!--echo ($userdata['user_image']) ADD this to the src attribute to fetch img from db-->
            <img class="circle_img" id="img" name="img" src="../../images/testing.jpg" > 
          </div>
        </div>
        <!--1st row 3rd col-->
        <div class="col-2 justify-content-center first_row_third_col">
          <div class="row">
            <p class="fs-5 animate-up-2 text-format">Username :</p>
          </div>
          <div class="row">
            <p class="fs-5 animate-up-2 text-format">Name :</p>
          </div>
          <div class="row">
            <p class="fs-5 animate-up-2 text-format">Privilege :</p>
          </div>
        </div>
        <!--1st row 4th col-->
        <div class="col-2 justify-content-center" style="margin-top: 4%;">
          <div class="row">
            <!--add php to fetch data from db-->
            <p class="fs-5 fw-bold animate-up-2 text-format">Chiang 69</p>
          </div>
          <div class="row">
            <p class="fs-5 fw-bold animate-up-2 text-format">Chiang Juo Han</p>
          </div>
          <div class="row">
            <p class="fs-5 fw-bold animate-up-2 text-format">Participant</p>
          </div>
        </div>
        <!--1st row 5th col-->
        <div class="col first_row_fifth_col">
          <div class="card bg-primary shadow-soft text-center border-light animate-up-2 card-center">
            <div class="card-header">
              <h3 class="h5 card-title"> Events Participated</h3>
            </div>
            <div class="card-body">
              <!--PHP code retrieve no of events then display-->
              <p style="font-size:39px;">23 <i class="fa-solid fa-calendar-days"></i></p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
      </div>
      <!--2nd row-->
        <div class="row second_row">
          <div class="col">
            <!-- Tab Nav -->
            <div class="nav-wrapper position-relative mb-4">
              <ul class="nav nav-pills nav-fill flex-column flex-md-row cancel-box-shadow" id="tabs-icons-text" role="tablist">
                <li class="nav-item cancel-box-shadow">
                  <a class="nav-link mb-sm-3 mb-md-0 active enlarge-content" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa-solid fa-calendar-days"></i>Ongoing Events</a>
                </li>
                <li class="nav-item cancel-box-shadow">
                  <a class="nav-link mb-sm-3 mb-md-0 enlarge-content" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fa-solid fa-calendar-days"></i>Past Events</a>
                </li>
              </ul>
            </div>
            <!-- End of Tab Nav -->
            <!-- Tab Content -->
            <div class="card shadow-inset bg-primary border-light p-4 rounded">
              <div class="card-body p-0">
                <div class="tab-content" id="tabcontent2">
                  <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus,
                      Marfa eiusmod Pinterest in do umami readymade swag.</p>
                    <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity.</p>
                  </div>
                  <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <p>Photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod
                      Pinterest in do umami readymade swag.</p>
                    <p>Day handsome addition horrible sensible goodness two contempt. Evening for married his account removal. Estimable me disposing of be moonlight cordially curiosity.</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of Tab Content -->
          </div>
        </div>
      
      <!--OLD CODE
      <div class="row second_row">
        <div class="col-6">
          <div class="card bg-primary shadow-bg text-center border-light animate-up-2 center-division">
            <div class="card-header">
                <h3 class="h3 card-title fw-bold"> Events</h3>
              </div>
              <div class="card-body body_footer_size">
                <div class="nav-wrapper position-relative mb-4">
                  <ul class="nav nav-pills flex-column flex-sm-row" id="tabs-text" role="tablist">
                    <li class="nav-item mr-sm-3 mr-md-0">
                      <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true">Completed</a>
                    </li>
                    <li class="nav-item mr-sm-3 mr-md-0">
                      <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false">Ongoing</a>
                    </li>
                  </ul>
                </div>
                
                <p class="fw-normal" style="float: left;">Completed</p>
                <p style="float: right;">Ongoing</p>
              
              </div>
              <div class="card-footer">
                PHP code retrieve no of events then display-
                <p style="font-size:39px;">23 <i class="fa-solid fa-calendar-days"></i></p>
              </div>
            </div>
        </div>
      </div>
      -->
    </div>
  </div>
<script>

</script>
</body>
</html>