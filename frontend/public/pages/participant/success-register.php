<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/participant-success-register.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Registered Event</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto back-shadow" style="border-radius:30px;">
      <div class="main-container">
        <div class="details-cont">
          <h2>Your Registration is Completed</h2>
          <div class="col-box">
            <div class="details-box"> <!--display registration details-->
              <div class="row">
                <label for="event-name" class="col-sm-6 col-form-label"> <!--showing event name-->
                  Event Name
                </label>
                <p class="col-sm-6 col-form-label" id="event-name" name="event-name">
                  XXXXXXX
                </p>
              </div>
              <div class="row">
                <label for="event-date" class="col-sm-6 col-form-label"> <!--event date-->
                  Event Date
                </label>
                <p class="col-sm-6 col-form-label" id="event-date" name="event-date">
                  dd/mm/yyyy
                </p>
              </div>
              <div class="row">
                <label for="event-time" class="col-sm-6 col-form-label"> <!--event time-->
                  Event Time
                </label>
                <p class="col-sm-6 col-form-label" id="event-time" name="event-time">
                  00:00
                </p>
              </div>
              <div class="row">
                <label for="orgn-email" class="col-sm-6 col-form-label"> <!--event email, rmb add href-->
                  Organizer Email
                </label>
                <p class="col-sm-6 col-form-label" id="orgn-email" name="orgn-email">
                  LEEYEEHAU@sample.mail
                </p>
              </div>
              <div class="row">
                <label for="orgn-tel" class="col-sm-6 col-form-label"> <!--event tel, add href-->
                  Organizer Telephone
                </label>
                <p class="col-sm-6 col-form-label" id="orgn-tel" name="orgn-tel">
                  011-11112222
                </p>
              </div>
            </div>
            <div class = "unique-cont">
              <div class="row">
                <label for="unq-code" class="col-sm-6 col-form-label"> <!--showing unique code-->
                  Unique Code
                </label>
                <div class="col-6">
                  <p class="col-sm col-form-label" id="unq-code" name="unq-code">
                    ABCDE
                  </p>
                </div>
              </div>
            </div>
            <div class = "hint-cont">
              <p>Hint: Unique Code is to check result and act as a referral code for your team members if it is a team event.</p>
            </div>
          </div> <!--col-box-->
        </div>
      </div> <!--main-container-->
    </div>
  </div>
</body>
</html>