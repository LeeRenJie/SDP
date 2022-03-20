<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../../src/stylesheets/signup.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Sign Up</title>
</head>
<body>
<?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto back-shadow" style="border-radius:30px;">
      <br>
      <div class="main-container">
        <h2 class="mt-3">Sign Up</h2>
        <form class="mid-con" action="signup.php" method="post" enctype="multipart/form-data">
          <div class="edit-con">
            <!--username-->
            <div class="input-row">
              <label for="username" class="col-sm-6 col-form-label">
                Username
              </label>
              <div class="input-col">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="required" autofocus>
              </div>
            </div>
            <!-- password -->
            <div class="input-row">
              <label for="password" class="col-sm-6 col-form-label">
                Password
              </label>
              <div class="input-col">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
              </div>
            </div>
            <!--Name section-->
            <div class="input-row">
              <label for="name" class="col-sm-6 col-form-label">
                Name
              </label>
              <div class="input-col">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required">
              </div>
            </div>
            <!--Email section-->
            <div class="input-row">
              <label for="email" class="col-sm-6 col-form-label">
                Email
              </label>
              <div class="input-col">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required="required">
              </div>
            </div>
            <!--Gender section-->
            <div class="input-row">
              <label for="gender" class="col-sm-6 col-form-label">
                Gender
              </label>
              <select class="custom-select col-sm-6 btn sel">
                <option class="al" selected disabled>Please Select</option>
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
                <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Telephone" required="required">
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
          </div> <!--edit-con-->
          <br>
          <div class="sub-con">
            <button class="btn dis-btn" id="button" onclick="discard()">Discard</button>
            <button class="btn sign-btn" id="button" type="submit" name="signup-btn">Sign up</button>
            <p class="link mt-2">Already have an account? Log in <a href="login.php">HERE</a></p>
          </div>
        </form>
      </div><!--main-->
    </div>
  </div>
  <script>
    function discard(){
      window.location.reload();
    }
  </script>
</body>
</html>