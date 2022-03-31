<?php
  // include the database connection
  include("../../../../backend/conn.php");
  // start the session
  if(!isset($_SESSION)) {
    session_start();
  }
  //get user id from url
  $userid = $_SESSION['user_id'];
  $privilege = $_SESSION['privilege'];
  // get the user details
  if ($privilege == 'participant'){
    $result = mysqli_query($con, "SELECT * FROM user INNER JOIN participant ON participant.user_id = user.user_id INNER JOIN privilege ON privilege.privilege_id = user.privilege_id WHERE participant.user_id = $userid");
  }
  elseif ($privilege == 'organizer'){
    $result = mysqli_query($con, "SELECT * FROM user INNER JOIN organizer ON organizer.user_id = user.user_id  INNER JOIN privilege ON privilege.privilege_id = user.privilege_id WHERE organizer.user_id = $userid");
  }
  // fetch the result in array format
  $userdata = mysqli_fetch_assoc($result);


  if (isset($_POST['saveInfoBtn'])) {
    //get file
    $userProPic = $_FILES['profilePic']['tmp_name'];
    //check either got image or not
    if ($_FILES['profilePic']['size'] > 0){
      //get image type
      $imageFileType = strtolower(pathinfo($userProPic,PATHINFO_EXTENSION)); //(Newbedev, 2021)
      //encode image into base64
      $base64_Img = base64_encode(file_get_contents($userProPic));
      //set image content with type and base64
      $image = 'data:image/'.$imageFileType.';base64,'.$base64_Img;
      $sql = "UPDATE user SET
      username = '$_POST[username]',
      name = '$_POST[name]',
      email = '$_POST[email]',
      dob = '$_POST[dob]',
      telephone = '$_POST[telephone]'
      WHERE user_id=$userid;";
      //user_image = '$image', gender
      $sql2 = "UPDATE participant SET gender = '$_POST[gender]', participant_image = '$image' WHERE user_id = $userid ";
    }
    elseif ($privilege == 'organizer'){
      $sql = "UPDATE user SET
      username = '$_POST[username]',
      name = '$_POST[name]',
      email = '$_POST[email]',
      dob = '$_POST[dob]',
      telephone = '$_POST[telephone]'
      WHERE user_id=$userid;";
      $sql2 = "UPDATE organizer SET organizer_website = '$_POST[website]' WHERE user_id = $userid ";
    }
    else {
    $sql = "UPDATE user SET
    username = '$_POST[username]',
    name = '$_POST[name]',
    email = '$_POST[email]',
    dob = '$_POST[dob]',
    telephone = '$_POST[telephone]'
    WHERE user_id=$userid;";
    $sql2 = "UPDATE participant SET gender = '$_POST[gender]' WHERE user_id = $userid ";
    }
    // Execute query to update user details
    if (mysqli_query($con,$sql)) {
      mysqli_query($con, $sql2);
      mysqli_close($con);
      // Notify user details had updated
      echo'<script>alert("Your Details Have Been Updated Successfully!");</script>';
      echo("<script>window.location = 'home.php'</script>");
    }
    else {
      // Display Error
      die('Error: ' . mysqli_error($con));
    }
    //Close connection for database
    mysqli_close($con);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/edit-profile.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Edit Profile</title>
</head>
<body>
<?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen modify">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto back-shadow" style="border-radius:30px;">
      <form method="post" ENCTYPE="multipart/form-data">
        <div class="main-container">
          <div class ="btn-row">
            <div class="infront">
              <a onclick="history.back()">
                <i class="fa-solid fa-circle-arrow-left fa-2xl m-5"></i>
              </a>
            </div>
          </div>
          <div class = "row">
            <div class = "lft-con">
              <div class= "name-card">
                <h2><?=$userdata['name']?> Name Card</h2>
              </div>
              <br>
              <div class="edit-con">
                <!--Show default username-->
                <div class="input-row">
                  <label for="username" class="col-sm-6 col-form-label">
                    Username
                  </label>
                  <div class="input-col">
                    <input type="text" class="form-control" id="username" name="username" value="<?=$userdata['username']?>" placeholder="Username" required="required">
                  </div>
                </div>
                <!--Name section-->
                <div class="input-row">
                  <label for="name" class="col-sm-6 col-form-label">
                    Name
                  </label>
                  <div class="input-col">
                    <input type="text" class="form-control" id="name" name="name" value="<?=$userdata['name']?>" placeholder="Name" required="required">
                  </div>
                </div>
                <!--Email section-->
                <div class="input-row">
                  <label for="email" class="col-sm-6 col-form-label">
                    Email
                  </label>
                  <div class="input-col">
                    <input type="text" class="form-control" id="email" name="email" value="<?=$userdata['email']?>" placeholder="Email" required="required">
                  </div>
                </div>
                <!--Gender section-->
                <div class="input-row">
                  <label for="gender" class="col-sm-6 col-form-label">
                    Gender
                  </label>
                  <select class="custom-select col-sm-6 btn sel" name="gender">
                    <option class="al" value=""
                    <?php
                    if ($userdata['gender'] == '')
                    {
                      'selected="selected"';
                    }
                    ?>
                    >
                      Prefer not to tell
                    </option>
                    <option class="al" value="male"
                    <?php
                    if ($userdata['gender'] == 'male')
                    {
                      'selected="selected"';
                    }
                    ?>
                    >
                      Male
                    </option>
                    <option class="al" value="female"
                    <?php
                    if ($userdata['gender'] == 'female')
                    {
                      'selected="selected"';
                    }
                    ?>
                    >
                      Female
                    </option>
                  </select>
                </div>
                <!--change telephone-->
                <div class="input-row">
                  <label for="telephone" class="col-sm-6 col-form-label">
                    Telephone
                  </label>
                  <div class="input-col">
                    <input type="tel" class="form-control" id="telephone" name="telephone" value="<?=$userdata['telephone']?>" placeholder="Telephone" required="required">
                  </div>
                </div>
                <!--change dob-->
                <div class="input-row">
                  <label for="dob" class="col-sm-6 col-form-label">
                    Date Of Birth
                  </label>
                  <div class="input-col">
                    <input type="date" class="form-control" id="dob" name="dob" value="<?=$userdata['dob']?>" placeholder="dob" required="required">
                  </div>
                </div>
                <!--change privilege-->
                <div class="input-row">
                  <label for="privilege" class="col-sm-6 col-form-label">
                    Privilege
                  </label>
                  <div class="input-col">
                    <fieldset disabled>
                    <input type="text" class="form-control" id="privilege" name="privilege" value="<?=$userdata['user_privilege']?>" placeholder="Participant" required="required">
                    </fieldset>
                  </div>
                </div>
                <?php
                  if ($privilege == 'organizer'){
                  ?>
                  <div class="input-row">
                    <label for="privilege" class="col-sm-6 col-form-label">
                      Organizer Website
                    </label>
                    <div class="input-col">
                      <fieldset>
                      <input type="text" class="form-control" id="website" name="website" value="<?=$userdata['organizer_website']?>" placeholder="" required="required">
                      </fieldset>
                    </div>
                  </div>
                  <?php
                  }
                ?>
              </div> <!--edit-con-->
            </div><!--lft-con-->
            <div class = "right-con">
              <div class="justify-content-center">
                <div class="profile-container">
                  <label for="imageUpload">
                    <image class="imge" id="img" name="img" src="<?=$userdata['participant_image']?>" alt="Profile Pic" />
                  </label>
                </div>
                <div class="custom-file">
                  <input id="imageUpload" class="imgload custom-file-input" type="file" name="profilePic" onchange="preimg(img)" capture>
                  <label class="custom-file-label" for="imageUpload">Choose file</label>
                </div>
              </div>
              <div class="btn-size">
                <input class="btn discard d-none animate-up-2" id="button" value="Discard" onclick="discard()">
                <input class="btn save d-none animate-up-2" id="button1" type="submit" value="Save" name="saveInfoBtn">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script>
    function discard(){
      window.location.reload();
    }
  //this script use to preview image before upload
  // (Nkron, 2014)
    function preimg(img) {
      document.getElementById('img').src="<?=$userdata['participant_image']?>";
      var picture = new FileReader();
      if (picture) {
        picture.onload = function(){
          var imgpreview = document.getElementById('img');
          imgpreview.src = picture.result;
        }
        picture.readAsDataURL(event.target.files[0]);
      }
    }
    //get the whole container
    var change = document.querySelector(".modify");
    change.addEventListener("change", hideBtn);
    //if make changes then display btn
    function hideBtn() {
      if(document.querySelector(".modify").value === "") {
        document.getElementById('button').classList.add("d-none");
        document.getElementById('button1').classList.add("d-none");
      } else {
        document.getElementById('button').classList.remove("d-none");
        document.getElementById('button1').classList.remove("d-none");
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</body>
</html>