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
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto back-shadow" style="border-radius:30px;">
      <form method="post" ENCTYPE="multipart/form-data">
        <div class="main-container">
          <div class = "lft-con">
            <div class= "name-card">
              <?php echo "<h2>Lee Yee Hau's Name Card</h2>";?>
            </div>
            <br>
            <div class="edit-con">
              <!--Show default username-->
              <div class="input-row">
                <label for="username" class="col-sm-6 col-form-label">
                  Username
                </label>
                <div class="input-col">
                  <input type="text" class="form-control" id="username" name="username" value="LYH" placeholder="Username" required="required">
                </div>
              </div>
              <!--Name section-->
              <div class="input-row">
                <label for="name" class="col-sm-6 col-form-label">
                  Name
                </label>
                <div class="input-col">
                  <input type="text" class="form-control" id="name" name="name" value="LYH" placeholder="Name" required="required">
                </div>
              </div>
              <!--Email section-->
              <div class="input-row">
                <label for="email" class="col-sm-6 col-form-label">
                  Email
                </label>
                <div class="input-col">
                  <input type="text" class="form-control" id="email" name="email" value="LYH@sample.mail.com" placeholder="Email" required="required">
                </div>
              </div>
              <!--Gender section-->
              <div class="input-row">
                <label for="gender" class="col-sm-6 col-form-label">
                  Gender
                </label>
                <select class="custom-select col-sm-6 btn sel">
                  <option class="al" disabled selected>Please Select</option>
                  <option class="al" value="male">Male</option>
                  <option class="al" value="female">Female</option>
                </select>
              </div>
              <!--change telephone-->
              <div class="input-row">
                <label for="telephone" class="col-sm-6 col-form-label">
                  Telephone
                </label>
                <div class="input-col">
                  <input type="tel" class="form-control" id="telephone" name="telephone" value="0112223333" placeholder="Telephone" required="required">
                </div>
              </div>
              <!--change dob-->
              <div class="input-row">
                <label for="dob" class="col-sm-6 col-form-label">
                  Date Of Birth
                </label>
                <div class="input-col">
                  <input type="date" class="form-control" id="dob" name="dob" value="" placeholder="dob" required="required">
                </div>
              </div>
              <!--change privilege-->
              <div class="input-row">
                <label for="privilege" class="col-sm-6 col-form-label">
                  Privilege
                </label>
                <div class="input-col">
                  <fieldset disabled>
                  <input type="text" class="form-control" id="privilege" name="privilege" value="" placeholder="Participant" required="required">
                  </fieldset>
                </div>
              </div>
            </div> <!--edit-con-->
          </div><!--lft-con-->
          <div class = "right-con">
            <div class="justify-content-center">
              <div class="profile-container">
                <label for="imageUpload">
                  <image class="imge" id="img" name="img" src="../../images/default.jpg" alt="Profile Pic" />
                </label>
              </div>
              <div class="custom-file">
                <input id="imageUpload" class="imgload custom-file-input" type="file" name="profilePic" onchange="preimg(img)" capture>
                <label class="custom-file-label" for="imageUpload">Choose file</label>
              </div>
            </div>
            <div class="btn-size">
              <input class="btn discard" id="button" value="Discard" onclick="discard()">
              <input class="btn save" id="button" type="submit" value="Save" name="saveInfoBtn">
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
      document.getElementById('img').src="";
      var picture = new FileReader();
      if (picture) {
        picture.onload = function()
          {
        var imgpreview = document.getElementById('img');
        imgpreview.src = picture.result;
        }
        picture.readAsDataURL(event.target.files[0]);
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</body>
</html>