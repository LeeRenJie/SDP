<?php
//Start session
if(!isset($_SESSION)) {
  session_start();
}
//Connection to database
include("../../../../backend/conn.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	// username and password sent from Form
	$username=mysqli_real_escape_string($con,$_POST['username']);
	$password=mysqli_real_escape_string($con,$_POST['password']);

  //Try to find is the user is exist or not
	$sql="SELECT * FROM user WHERE username='$username' and password='$password'";
  //If user exist
	if ($result=mysqli_query($con,$sql))  {
	  // Return the number of rows in result set
    $rownum=mysqli_num_rows($result);
	};


  //Store user data into variable
	while($row=mysqli_fetch_array($result)){
		$id = $row['user_id'];
    $username = $row['username'];
    $name = $row['name'];
    $email = $row['email'];
    $dob = $row['dob'];
    $telephone = $row['telephone'];
    // Get privilege type
    $privilege_id = $row['privilege_id'];
	};

  $privilege_sql="SELECT * FROM privilege WHERE privilege_id='$privilege_id'";
  $privilege_result=mysqli_query($con,$privilege_sql);
  while($privlege_row=mysqli_fetch_array($privilege_result)){
    $user_privilege = $privlege_row['user_privilege'];
  };

  //Store user data into session
	if($rownum==1)  {
		$_SESSION['username']=$username;
		$_SESSION['user_id']=$id;
    $_SESSION['privilege']=$user_privilege;
    $_SESSION['name']=$name;
    $_SESSION['email']=$email;
    $_SESSION['dob']=$dob;
    $_SESSION['telephone']=$telephone;

    switch($user_privilege){
      case 'participant':
        echo("<script>window.location = '../shared/view-event.php'</script>");
        break;
      case 'organizer':
        echo("<script>window.location = '../organizer/my-event.php'</script>");
        break;
      case 'admin':
        echo("<script>window.location = '../admin/home.php'</script>");
        break;
    }
	}
  //If user not exist
	else {
		echo "<script>alert('Your Login Details are invalid. Please try again');</script>";
	};
}
//Close connection of database
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/login.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Log In</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="d-flex justify-content-center mt-5">
    <div class="card bg-primary border-light shadow-soft w-60 card-height px-5">
      <div class="text-center">
        <h1 class="display-2 mt-4">Log In To Judgeable</h1>
      </div>
      <form method="post">
        <div class="form-group mb-3 px-5 pt-4">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Username" required="required">
          <small id="emailHelp" class="form-text text-muted">Username is case sensitive</small>
        </div>
        <div class="form-group px-5 pt-3">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <div class="text-center mt-5">
          <button class="btn btn-primary w-32 mr-4" type="reset">Clear</button>
          <button type="submit" name="loginBtn" class="ml-4 w-32 btn btn-primary login-btn">Log In</button>
          <p class="link mt-3 text-muted">Don't have an account? Sign Up <a href="signup.php">here</a></p>
        </div>
      </form>
    </div>
  </div>
</body>
</html>