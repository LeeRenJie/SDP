<?php
  //Connection to Database
  include("../../../../backend/conn.php");

  if (isset($_POST['create_btn'])) {
    //Get all user data from database
    $validation_query = "SELECT * FROM user INNER JOIN privilege ON user.privilege_id = privilege.privilege_id ";
    $validation_query_run = mysqli_query($con, $validation_query);

    //get all user data from the form to validate
    $check_username = strtolower($_POST['username']);
    $check_password = $_POST['password'];
    //convert to length of password
    $num_length = strlen($check_password);

    if(mysqli_num_rows($validation_query_run) > 0)
    {
      //validation section
      $register = TRUE;
      foreach($validation_query_run as $row)
      {
        if($row['username'] == $check_username)
        {
          echo("<script>alert('Username already exists!')</script>");
          $register = FALSE;
          break;
        }
        // form validation for input length
        else if($num_length <5){
          echo("<script>alert('Password must not be less than 5 digits!')</script>");
          $register = FALSE;
          break;
        }
      }
      //end of validation section
      if($register == TRUE){
        // if user passed all validation, then register user
        $username = strtolower($_POST['username']);
        $name = $_POST['name'];
        $password = $_POST['password'];
        $sql = "INSERT INTO user (privilege_id, username, name, password) VALUES ('1', '$username', '$name', '$password')";
        $result = mysqli_query($con, $sql);
        //If the sql run successful, notify the user
        if($result){
          echo("<script>alert('You have registered successfully!')</script>");
          //echo("<script>window.location = ''</script>");
        }
        //If the sql fail, notify user
        else{
          echo("<script>alert('Error! pls try again')</script>");
        }
      }
    }
  }
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
  <link rel="stylesheet" href="../../../src/stylesheets/admin-new_admin.css">
  <title>Document</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto dark_shadow">
      <form action="new_admin.php" method="post" enctype="multipart/form-data">
        <div style="height:100% ; width: 100%;">
          <div class="row" style="height: 100%; margin-top:3%">
            <div class="col">
              <!--Grey Container position at the middle for content-->
              <div class="row general_container mx-auto" style="width:500px;">
                <!-- Entry fields below-->
                <div class="form-group form_margin_1">
                  <label for="validationServer01">Username</label>
                  <!--Take note, is-valid class is the class that ticks or cross the input box, use js script to hide and show-->
                  <input type="text" name="username" class="form-control" id="id_username" style="width: 390px;" required>
                  <!--Need to add js script later to hide the feedback by default and show when username is valid and not repeated in database-->
                  <div class="valid-feedback">
                    <p id="p_username_good" class="d-none">Looks good!</p>
                    <p id="p_username_bad" class="d-none">Please fill in the blank!</p>
                  </div>
                </div>
                <div class="form-group mb-4 form_margin_2">
                  <label for="validationServerUsername">Name</label>
                  <input type="text" name="name" class="form-control" id="id_name" style="width: 390px;" required>
                  <!--Need to add js script later to hide the classes invalid-feedback and is-invalid by default and show when invalid-->
                  <div class="invalid-feedback">
                    <p id="p_name" class="d-none">Please enter your name</p>
                  </div>
                </div>
                <!--Disabled Input for Privilege-->
                <div class="form-group mb-4 privilege_div">
                  <label for="validationServerUsername">Privilege</label>
                  <input type="text" name="privilege" class="form-control is-valid" id="id_privilege" style="width: 390px;" value="Admin" disabled>
                </div>
                <!--Password Input (password length validation)-->
                <div class="form-group pass_div">
                  <label for="validationServerUsername">Password</label>
                  <input type="text" name="password" class="form-control" id="id_password" style="width: 390px;" required>
                  <!--Need to add js script later to hide the feedback by default and show when invalid-->
                  <div class="invalid-feedback">
                    <p id="p_password" class="d-none"> Please use a password that has at least 5 characters.</p>
                  </div>
                </div>
                <div class="row" style="margin-bottom: 6%;">
                  <div class="col">
                    <button name="create_btn" class="btn btn-primary btn-pill text-success animate-up-2 create_button" type="button">Create</button>
                  </div>
                  <div class="col">
                    <button class="btn btn-primary btn-pill text-danger animate-up-2 cancel_button" type="button">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script>
    function username_is_valid() {
      var element = document.getElementById("id_username");
      element.classList.add("is-valid");
      var p_element = document.getElementById("p_username_good");
      p_element.classList.remove("d-none");
    }
    function username_is_invalid() {
      var element = document.getElementById("id_username");
      element.classList.add("is-invalid");
      var p_element = document.getElementById("p_username_bad");
      p_element.classList.remove("d-none");
    }
    function name_is_valid() {
      var element = document.getElementById("id_name");
      element.classList.add("is-valid");
      var p_element = document.getElementById("p_name");
      p_element.classList.remove("d-none");
    }
    function name_is_invalid() {
      var element = document.getElementById("id_name");
      element.classList.add("is-invalid");
      var p_element = document.getElementById("p_name");
      p_element.classList.remove("d-none");
    }
    function password_is_valid() {
      var element = document.getElementById("id_password");
      element.classList.add("is-valid");
      var p_element = document.getElementById("p_password");
      p_element.classList.remove("d-none");
    }
    function password_is_invalid() {
      var element = document.getElementById("id_password");
      element.classList.add("is-invalid");
      var p_element = document.getElementById("p_password");
      p_element.classList.remove("d-none");
    }
  </script>
  <?php
    //get all user data from the form to validate
    $check_username = strtolower($_POST['username']);
    $check_password = $_POST['password'];
    //convert to length of password
    $num_length = strlen($check_password);
  
    if ($check_username == ''){
      echo "<script> username_is_invalid(); </script>";
    }
  ?>
</body>
</html>