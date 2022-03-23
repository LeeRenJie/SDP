<?php
  //Connection to Database
  include("../../../../backend/conn.php");
  // start the session
  //if(!isset($_SESSION)) {
  //  session_start();
  //}

  //get user id from url
  //$userid = $_SESSION['user_id'];

  //run query and get sql result
  //$user_query = "SELECT * FROM user INNER JOIN privilege ON user.privilege_id = privilege.privilege_id WHERE user_id = $userid";
  //$user_query_run = mysqli_query($con, $user_query);
  
  //$userdata = mysqli_fetch_assoc($user_query_run);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/28d45fc291.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/neumorphism.css">
  <link rel="stylesheet" href="../../../src/stylesheets/view-event.css">
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
        <div onclick="history.back()" class="col-2">
          <i class="fa-solid fa-circle-arrow-left fa-2xl m-5"></i>
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
            <p class="fs-5 fw-bold animate-up-2 text-format">
              
            </p>
          </div>
          <div class="row">
            <p class="fs-5 fw-bold animate-up-2 text-format">

            </p>
          </div>
          <div class="row">
            <p class="fs-5 fw-bold animate-up-2 text-format">
              
            </p>
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
                  <a class="nav-link mb-sm-3 mb-md-0 active enlarge-content" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa-solid fa-calendar-days"></i>Number of Events</a>
                </li>
                <li class="nav-item cancel-box-shadow">
                  <a class="nav-link mb-sm-3 mb-md-0 enlarge-content" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fa-solid fa-calendar-days"></i>Past Events</a>
                </li>
              </ul>
            </div>
            <!-- End of Tab Nav -->
            <!-- Tab Content -->
            <div class="card shadow-inset bg-primary border-light p-4 rounded ">
              <div class="card-body p-0">
                <div class="tab-content" id="tabcontent2">
                  <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <div class="b-skills">
                      <div class="container">
                        <div class="row">
                          <div class="col-2">
                            <p class="d-none">Empty</p>
                          </div>
                          <div class="col-md-3">
                            <div class="skill-item center-block">
                              <div class="chart-container">
                                <div class="chart" data-percent="80%" data-bar-color="#52565f">
                                  <span class="percent" data-after="%"> 90</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col col-margin">
                            <div class="row">
                              <p class="fs-5 animate-up-2 title">Ongoing Events</p>
                            </div>
                            <div class="row">
                              <p class="fs-5 animate-up-2 title">Completed Events</p>
                            </div>
                          </div>
                          <div class="col col-margin">
                            <div class="row">
                              <p class="fs-5 fw-bold animate-up-2 title">
                                14 
                                <i class="fa-solid fa-calendar-days"></i>
                              </p>
                            </div>
                            <div class="row">
                              <p class="fs-5 fw-bold animate-up-2 title">
                                10 
                                <i class="fa-solid fa-calendar-days"></i>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <div class="content-cont">
                      <div class="event-con col-12">
                        <a href=""> <!--href to event-->
                          <button class="btn btn-primary animate-up-2" type="button">
                            <div class="event-con">
                              <div class="col-8">
                                <div class="title-con">
                                  <h2>Event Name</h2> <!--change event name-->
                                  <div class="status-con">
                                    <small class="status-on">Active</small> <!--change event status-->
                                  </div>
                                </div>
                                <div class="details-con"> <!--event info-->
                                  <div class="info-con">
                                    <p>Date: xx/xx/xxxx </p>
                                    <p>Judges : 4</p>
                                  </div>
                                  <div class="info-con">
                                    <p>Time: 18:00 - 22:00 </p>
                                    <p>Participant : 70</p>
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
                      <div class="event-con col-12">
                        <a href=""> <!--href to event-->
                          <button class="btn btn-primary animate-up-2" type="button">
                            <div class="event-con">
                              <div class="col-8">
                                <div class="title-con">
                                  <h2>Event Name</h2> <!--change event name-->
                                  <div class="status-con">
                                    <small class="status-on">Active</small> <!--change event status-->
                                  </div>
                                </div>
                                <div class="details-con"> <!--event info-->
                                  <div class="info-con">
                                    <p>Date: xx/xx/xxxx </p>
                                    <p>Judges : 4</p>
                                  </div>
                                  <div class="info-con">
                                    <p>Time: 18:00 - 22:00 </p>
                                    <p>Participant : 70</p>
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
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of Tab Content -->
          </div>
        </div>
    </div>
  </div>
  <script src="jquery-2.2.4.min.js"></script>
  <script src="profile.min.js"></script>
  <script>
      var $window = $(window);

      function run() {
        var fName = arguments[0],
          aArgs = Array.prototype.slice.call(arguments, 1);
        try {
          fName.apply(window, aArgs);
        } catch (err) {}
      }

      /* chart
================================================== */
      function _chart() {
        $(".b-skills").appear(function () {
          setTimeout(function () {
            $(".chart").easyPieChart({
              easing: "easeOutElastic",
              delay: 3000,
              barColor: "#369670",
              trackColor: "#fff",
              scaleColor: false,
              lineWidth: 21,
              trackWidth: 21,
              size: 250,
              lineCap: "round",
              onStep: function (from, to, percent) {
                this.el.children[0].innerHTML = Math.round(percent);
              },
            });
          }, 150);
        });
      }

      $(document).ready(function () {
        run(_chart);
      });
  </script>
</body>
</html>