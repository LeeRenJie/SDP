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
                <input type="text" class="form-control" placeholder="Search event..">
                <div class="input-group-append">
                  <button class="input-group-text" name="searchBtn" type="submit"><span class="fas fa-search"></span></button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- Event Details -->
        <div class="event-con">
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

        <div class="event-con">
          <a href="">
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
        <div class="event-con">
          <a href="">
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
        <div class="event-con">
          <a href="">
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


      </div> <!--main container-->
    </div>
  </div>
</body>
</html>