<?php
//Start session
session_start();
//Connection to database
include("../../../../backend/conn.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	// username and password sent from Form
	$username=mysqli_real_escape_string($con,$_POST['username']);
	$password=mysqli_real_escape_string($con,$_POST['password']);

  //Try to find is the user is exist or not
	$sql="SELECT user.* FROM user, privilege.user_privilege
        JOIN privilege on privilege.id = user.privilege_id
        WHERE user.username='$username' and user.password='$password'";
  //If user exist
	if ($result=mysqli_query($con,$sql))  {
	  // Return the number of rows in result set
    $rownum=mysqli_num_rows($result);
	}

  //Store user data into variable
	while($row=mysqli_fetch_array($result)){
		$id = $row['user_id'];
    $privilege = $row['privilege'];
    $name = $row['user_name'];
    $email = $row['user_email'];
    $address = $row['user_address'];
    $phone = $row['user_phone_number'];
	}

  //Store user data into session
	if($rownum==1)  {
		$_SESSION['username']=$username;
		$_SESSION['user_id']=$id;
    // $_SESSION['privilege']=$privilege;
    $_SESSION['name']=$name;
    $_SESSION['email']=$email;
    $_SESSION['dob']=$dob;
    $_SESSION['telephone']=$telephone;
    echo("<script>alert('Welcome Back User $name')</script>");
		echo("<script>window.location = 'view-event.php'</script>");
	}
  //If user not exist
	else  {
		echo "<script>alert('Your Login Details are invalid. Please try again');</script>";
	}
  //Close connection of database
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
  <link rel="stylesheet" href="../../../src/stylesheets/signup.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  <title>Sign Up</title>
</head>
<body>
  <!-- nav side-->
  <div id="navbar">
    <?php include '../shared/navbar.php';?>
    </div>
    <div class="flex flex-row h-screen">
      <?php include '../shared/sidebar.php';?>
      <div class="basis-10/12 overflow-auto shadow" style="border-radius:30px;">
      <div class="main-container">
        <h2>Log In</h2>
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
          </div> <!--edit-con-->
          <br>
          <div class="sub-con">
            <button class="btn dis-btn" id="button" onclick="discard()">Discard</button>
            <button class="btn sign-btn" id="button" type="submit" name="signup-btn">Sign up</button>
            <p class="link">Don't have an account? Sign Up <a href="signup.php">HERE</a></p>
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