<?php
  //Connection to Database
  include("../../../../backend/conn.php");
  // start the session
  // if(!isset($_SESSION)) {
  //   session_start();
  // }
  $userid = intval($_GET['id']); //remove
  //get user id from url
  // $userid = $_SESSION['user_id'];

  //Query to get all data
  $user_query = "SELECT * FROM user AS pl
  INNER JOIN participant ON pl.user_id = participant.user_id
  INNER JOIN team_list ON team_list.participant_id = participant.participant_id
  INNER JOIN event ON event.event_id = team_list.event_id
  WHERE pl.user_id = $userid";
  // Execute the query
  $user_query_run = mysqli_query($con, $user_query);
  // Fetch data
  $userdata = mysqli_fetch_assoc($user_query_run);

  // not complete query, this is to get event details based on its own id either href from previous page or what
  $event_query = "SELECT * FROM event AS evt
  WHERE pl.user_id = $userid";



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/participant-register-event.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Register Event</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto back-shadow" style="border-radius:30px;">
    <input type = "hidden" name = "id" value ="<?php echo $userdata['user_id']?>"> <!--remove -->
      <div class="main-container">
        <h2>Registration <?php echo ($userdata['event_name'])?></h2>
        <div class="event-details">
          <div class="left-cont">
            <div class="description">
              <span>
                <i class="fa-solid fa-message"></i>
                Event Description
              </span>
              <div class="details-cont">
                <p><?php echo ($userdata['event_description'])?>
                </p>
              </div>
            </div>
            <div class="rules">
              <span>
                <i class="fa-solid fa-scroll"></i>
                Rules
              </span>
              <div class="details-cont">
                <p>•  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    •  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    •  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    •  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    •  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
              </div>
            </div>
          </div>
          <div class="right-cont">
            <div class="row py-2">
              <label for="username" class="col-sm-6 col-form-label"> <!--showing user default username details-->
                Username
              </label>
              <p class="col-sm-6 col-form-label" id="username" name="username">
              <?php echo ($userdata['username'])?>
              </p>
            </div>
            <div class="row py-2">
              <label for="name" class="col-sm-6 col-form-label"> <!--showing user default name details-->
                Name
              </label>
              <p class="col-sm-6 col-form-label" id="name" name="name">
              <?php echo ($userdata['name'])?>
              </p>
            </div>
            <div class="row py-2">
              <label for="email" class="col-sm-6 col-form-label"> <!--showing user default email details-->
                Email
              </label>
              <p class="col-sm-6 col-form-label" id="email" name="email">
              <?php echo ($userdata['email'])?>
              </p>
            </div>
            <div class="row py-2">
              <label for="telephone" class="col-sm-6 col-form-label"> <!--showing user default details-->
                Telephone
              </label>
              <p class="col-sm-6 col-form-label" id="telephone" name="telephone">
              <?php echo ($userdata['telephone'])?>
              </p>
            </div>
            <?php
            if($userdata['participant_type'] == "solo") {
              echo '<div class="row py-2">';
                echo '<label for="team-role" class="col-sm-6 col-form-label">';
                  echo 'Team Role ';
                echo '</label>';
                echo '<select class="custom-select col-sm-6 btn sel">';
                  echo '<option class="al" disabled selected>Please Select</option>';
                  echo '<option class="al" value="leader">Leader</option>';
                  echo '<option class="al" value="member">Member</option>';
                echo '</select>';
              echo '</div>';
              echo '<div class="row py-2">';
                echo '<label for="unique-code" class="col-sm-6 col-form-label">';
                  echo 'Unique Code';
                echo '</label>';
                echo '<input type="text" class="form-control col-sm-6" id="unique-code" name="unique-code" placeholder="Unique Code" required="required">';
              echo '</div>';
            }
            ?>
          </div> <!--right-cont-->
        </div> <!--event-details-->
        <form method="post" class="btn-con">
          <input class="btn btn_size" id="button" type="submit" value="Register" name="register">
        </form>
      </div> <!--main-cont-->
    </div>
  </div>
</body>
</html>