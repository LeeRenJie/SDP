<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/participant-event-details.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Event Details</title>
</head>
<body>
  <div id="navbar">
    <?php include '../shared/navbar.php';?>
  </div>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto shadow" style="border-radius:30px;">
      <div class="main-container">
        <!-- Event name and status -->
        <h1>Event Name</h1>
        <!-- Image of event -->
        <div class="img-container">
          <img src="../../images/default.jpg" class="mx-auto d-block img-size shadow-inset" alt="Event Image">
        </div>
        <!-- Details of event -->
        <div class="row detail-container">
          <div class="col-4"> <!--left details-->
            <div class="row py-2">  <!--row for date and time-->
              <div class="col-6 text-center">
                <div class="inline-block details pt-3">
                  <span class="h5">
                    <i class="fa-solid fa-calendar-day"></i>
                    Date
                  </span>
                  <p class="pt-3">17/10/2022</p>
                </div>
              </div>
              <div class="col-6 text-center">
                <div class="inline-block details pt-3">
                  <span class="h5">
                    <i class="fa-solid fa-clock"></i>
                    Time
                    </span>
                  <p class="pt-3">8:00 a.m.</p>
                </div>
              </div>
            </div> <!--row for date and time-->
            <div class="row"> <!--row for max person and type-->
              <div class="col-6 text-center">
                <div class="inline-block details pt-3">
                  <span class="h5">
                    <i class="fa-solid fa-person"></i>
                    Max
                  </span>
                  <p class="pt-3 card-text">30 Person</p>
                </div>
              </div>
              <div class="col-6 text-center">
                <div class="inline-block details pt-3">
                  <span class="h5">
                    <i class="fa-solid fa-question"></i>
                    Type
                  </span>
                  <p class="pt-3">Solo</p>
                </div>
              </div>
            </div> <!--row for max person and type-->
          </div> <!--left details-->
          <div class="col-8 text-center pt-2"> <!--right details description-->
            <div class="description pt-3">
              <span class="h5">
                <i class="fa-solid fa-message"></i>
                Description
              </span>
              <p class="px-5 pt-3 text-justify">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              </p>
            </div>
          </div> <!--right details description-->
          <div class="row py-3">
            <div class="col-4 text-center"> <!--Prizes-->
              <div class="prizes pt-3 ml-3">
                <span class="h5">
                  <i class="fa-solid fa-trophy"></i>
                  Prizes
                </span>
                <div  style="text-align: center;">
                  <div class="pt-3">
                    <p>1st prize: RM5000</p>
                    <p>2nd prize: RM3000</p>
                    <p>3rd prize: RM1000</p>
                  </div>
                </div>
              </div>
            </div> <!--Prizes-->
            <div class="col-8 text-center"> <!--Rules-->
              <div class="rules pt-3">
                <span class="h5">
                  <i class="fa-solid fa-scroll"></i>
                  Rules
                </span>
                <?php
                  for ($x = 0; $x <= 5; $x++) {
                    echo (
                      "<p class='px-5 pt-3 text-justify'>
                        •  Lorem Ipsum is simply dummy text of the printing and typesetting industry.  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                      </p>"
                    );
                  }
                ?>
              </div>
            </div> <!--Rules-->
          </div>
          <div class="row py-3 ml-1">
            <div class="contact text-center">
              <span class="h5">
                <i class="fa-solid fa-address-book"></i>
                Contact Information
              </span>
              <div class="row py-3 ml-1">
                <span class="col-4">
                  <i class="fa-solid fa-user"></i> Organizer: Lee Yee Hau
                </span>
                <span class="col-4">
                  <i class="fa-solid fa-envelope"></i> Email: XXXXX@sample.com
                </span>
                <span class="col-4">
                  <i class="fa-solid fa-phone"></i> Phone: 011-11112222
                </span>
              </div>
            </div>
          </div>
        </div> <!-- Details of event -->
        <form class="btn-con">
          <input class="btn btn_size" id="button" type="submit" value="Participate" name="participate">
        </form>
      </div> <!--Main Container-->
    </div>
  </div>
</body>
</html>