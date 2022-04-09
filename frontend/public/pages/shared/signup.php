<?php
if (isset($_SESSION['privilege'])) {
  echo("<script>alert('Please logout before creating a new account')</script>");
  if($_SESSION['privilege'] == "admin"){
    header('Location: ../admin/home.php');
  }
  else if($_SESSION['privilege'] == "judge"){
    header('Location: ../judge/event(judge).php');
  }
  else if($_SESSION['privilege'] == "participant"){
    header('Location: ../shared/view-event.php');
  }
  else if ($_SESSION['privilege'] == "organizer"){
    header('Location: ../organizer/my-event.php');
  }
}
//Connection to database
if (isset($_POST['registerBtn'])) {
  // include the database connection
  include("../../../../backend/conn.php");
  $register = TRUE;
  $username = strtolower($_POST['username']);
  $name = $_POST['name'];
  $password = $_POST['password'];
  $privilege = $_POST['privilege'];
  $privilege == "Organizer" ? $privilege=2 : $privilege=3;

  //Get all user data
  $validation_query = "SELECT * FROM user";
  $validation_query_run = mysqli_query($con, $validation_query);
  if (!$validation_query_run){
    die('Error validation query: ' . mysqli_error($con));
  }

  //Set default image
  $defaultPic = "../../images/default.jpg";
  //Read default image file type (as jpg)
  $imageFileType = strtolower(pathinfo($defaultPic,PATHINFO_EXTENSION)); //(Newbedev, 2021)
  //Encode default image into base 64
  $defaultImg = base64_encode(file_get_contents($defaultPic));
  //create a format of blob image (base64)
  $image = 'data:image/'.$imageFileType.';base64,'.$defaultImg;

  // form validation for username to prevent repeating
  if(mysqli_num_rows($validation_query_run) > 0)
  {
    foreach($validation_query_run as $row)
    {
      // ("Form Validation in PHP - javatpoint", 2021);
      if($row['username'] == $username)
      {
        echo("<script>alert('Username already exists!')</script>");
        $register = FALSE;
        break;
      }
    }
  }

  if($register){
    // if user passed all validation, then register user
    $username = strtolower($_POST['username']);
    $name = $_POST['name'];
    $password = $_POST['password'];
    $privilege = $_POST['privilege'];
    $privilege == "Organizer" ? $privilege=2 : $privilege=3;
    $sql = "INSERT INTO user (privilege_id, username, name, password, email, dob, telephone)
            VALUES ('$privilege', '$username', '$name', '$password', NULL, NULL, NULL)";
    $result = mysqli_query($con, $sql);
    // if user registered successfully, add data into specific user table
    if ($result){
      $last_id = mysqli_insert_id($con);

      if ($privilege === 2) {
        $organizer_sql = "INSERT INTO organizer (user_id, organizer_website) VALUES ('$last_id', NULL)";
        $organizer_result = mysqli_query($con, $organizer_sql);
        if ($organizer_result){
          echo("<script>alert('Registered as an organizer')</script>");
        }else{
          echo("Error description: " . mysqli_error($con));
        }
      } elseif ($privilege === 3) {
        $participant_sql = "INSERT INTO participant (user_id, gender, participant_image) VALUES ('$last_id', NULL, '$image')";
        $participant_result = mysqli_query($con, $participant_sql);
        if ($participant_result){
          echo("<script>alert('Registered as an participant');</script>");
        }else{
          echo("Error description: " . mysqli_error($con));
        }
      };
      //If the sql run successful, notify the user and redirect to log in page
      echo("<script>window.location = '../shared/login.php'</script>");
    }
    //If the sql fail, notify user
    else{
      echo("Error description: " . mysqli_error($con));
    }
  }
  // Close the database connection
  mysqli_close($con);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/signup.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Sign Up</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="overflow-auto h-screen">
    <div class="d-flex justify-content-center signup-container pt-3">
      <div class="border-light shadow-soft w-60 px-5">
        <div class="text-center">
          <h1 class="display-2 mt-4">Sign Up</h1>
        </div>
        <form method="post">
          <div class="form-group mb-3 px-5 pt-3">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Enter your username for the system.." required="required" maxlength="50" autofocus>
            <small id="emailHelp" class="form-text text-muted">Username will be converted to lower case</small>
          </div>
          <div class="form-group mb-3 px-5 pt-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your name that will be displayed.." required="required" maxlength="50">
          </div>
          <div class="form-group px-5 pt-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your secured password.." required="required" maxlength="50">
          </div>
          <div class="form-group px-5 pt-3">
            <label for="privilege">Role</label>
            <select class="custom-select my-1 mr-sm-2" id="privilege" name="privilege">
              <option value="">Select a role..</option>
              <option value="Organizer">Organizer</option>
              <option value="Participant">Participant</option>
            </select>
          </div>
          <div class="text-center mt-5">
            <button class="btn btn-primary w-32 mr-4 discard animate-up-2" type="reset">Clear</button>
            <button type="submit" name="registerBtn" class="ml-4 w-32 btn btn-primary login-btn save animate-up-2">Register</button>
            <p class="link mt-3 text-muted">Have an account? Login <a class="highlight" href="../shared/login.php">here</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>