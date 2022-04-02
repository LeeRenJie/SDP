<?php
  //Start user session
  if(!isset($_SESSION)) {
    session_start();
  }
  //Connection to database
  include("../../../../backend/conn.php");
  //This is for edit password
  if (isset($_POST['pswBtn'])) {
    //Get user id
    $userid = $_SESSION['user_id'];
    //Get user details
    $result = mysqli_query($con, "SELECT * FROM user WHERE user_id = $userid");
    //Get result row
    $row = mysqli_fetch_assoc($result);
    //Check condition of password
    if($row['password'] == $_POST['currentpsw']) {
      //if first condition match
      if($_POST['newpsw'] == $_POST['confirmpsw']){
        //if second condition also match
        //Update user passowrd
        $sql = "UPDATE user SET password = '$_POST[newpsw]' WHERE user_id = $userid";
        //Notify user sucess
        if (mysqli_query($con,$sql)) {
          echo'<script>alert("Your Password Had Changed Successfully!");</script>';
        }
        //Display error message for database
        else {
          die('Error: ' . mysqli_error($con));
        }
			}
      else {
        //Notify user new password not match condition
        echo'<script>alert("New Password not match with confirm password.");</script>';
      }
    }
    else{
      //Notify user current password not match
      echo'<script>alert("Current password not match.");</script>';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!--BootStrap/css stylesheets-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="../../../src/stylesheets/nav.css" />
		<script src="https://cdn.tailwindcss.com"></script>
		<!-- Pixel CSS -->
		<link type="text/css" href="../../../src/stylesheets/neumorphism.css" rel="stylesheet">
  </head>
  <body>
		<nav id="navbar-main" class="navbar navbar-expand-lg navbar-transparent">
			<div class="container-fluid position-relative">
				<a href="../shared/home.php" class="mr-5">
					<img src="../../images/logo.svg" alt="logo" class="logo" >
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="navbar-collapse collapse" id="navbarSupportedContent">
					<div class="navbar-collapse-header">
						<div class="row">
							<div class="col-6 collapse-brand">
								<a href="">
									<img src="../../images/logo.svg" alt="logo" class="logo">
								</a>
							</div>
							<div class="col-6 collapse-close">
								<a href="#navbarSupportedContent" class="fas fa-times" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" title="close" aria-label="Toggle navigation"></a>
							</div>
						</div>
					</div>
					<ul class="navbar-nav navbar-nav-hover ml-auto">
						<?php if(isset($_SESSION['username'])){
							echo('
								<li class="nav-item dropdown mr-5">
									<a href="#" class="nav-link" data-toggle="dropdown" >
										<span class="nav-link-inner-text">
											<i class="fas fa-user"></i>
											');
											echo $_SESSION['username'];
							echo('
										</span>
										<span class="fas fa-angle-down nav-link-arrow ml-1"></span>
									</a>
									<ul class="dropdown-menu">
									');
									if($_SESSION['privilege'] == 'organizer'){
										echo('<li><a class="dropdown-item" href="../organizer/view-profile.php">Profile</a></li>');
									}
									else if($_SESSION['privilege'] == 'participant'){
										echo('<li><a class="dropdown-item" href="../participant/view-profile.php">Profile</a></li>');
									}
									if(($_SESSION['privilege'] == 'admin') || ($_SESSION['privilege'] == 'participant' || $_SESSION['privilege'] == 'organizer')){
										echo('<li><a class="dropdown-item" data-toggle="modal" data-target="#modal-form">Edit Password</a></li>');
									}
										echo('<li><a class="dropdown-item" href="../../../../backend/logout.php">Log Out</a></li>
									</ul>
								</li>
							');
						} ?>
						<?php
                if(!isset($_SESSION['username'])) {
                  echo(
                  '<li class="nav-item">
                    <a class="btn btn-primary mr-2" href="../shared/signup.php">Sign Up</a>
                  </li>
								  <li class="nav-item">
                    <a class="btn btn-primary mr-2" href="../shared/login.php">Log In</a>
                  </li>
									');
                }
              ?>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Edit Password Modal -->
		<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body p-0">
						<div class="card bg-primary shadow-soft border-light p-4">
							<button type="button" class="close ml-auto cursor-pointer" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
							</button>
							<div class="card-header text-center pb-0">
									<h2 class="h5">Edit Password</h2>
							</div>
							<div class="card-body">
								<form method="post">
									<div class="form-group">
										<!-- Form -->
										<div class="form-group">
												<label for="currentpsw">Current Password</label>
												<div class="input-group">
														<div class="input-group-prepend">
																<span class="input-group-text"><span class="fas fa-unlock-alt"></span></span>
														</div>
														<input class="form-control" id="currentpsw" name="currentpsw" placeholder="Password" type="password" aria-label="current password" required>
												</div>
										</div>
										<!-- End of Form -->
										<!-- Form -->
										<div class="form-group">
												<label for="newpsw">New Password</label>
												<div class="input-group">
														<div class="input-group-prepend">
																<span class="input-group-text"><span class="fas fa-unlock-alt"></span></span>
														</div>
														<input class="form-control" id="newpsw" name="newpsw" placeholder="Confirm password" type="password" aria-label="new password" required>
												</div>
										</div>
										<div class="form-group">
												<label for="confirmpsw">Confirm New Password</label>
												<div class="input-group">
														<div class="input-group-prepend">
																<span class="input-group-text"><span class="fas fa-unlock-alt"></span></span>
														</div>
														<input class="form-control" name="confirmpsw" placeholder="Confirm password" type="password" aria-label="confirm password" required>
												</div>
										</div>
										<!-- End of Form -->
									</div>
									<input type="submit" value="Confirm" class="mt-3 btn btn-block btn-primary" name="pswBtn"></input>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    <!-- Jquery and Bootstrap CDN link for JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </body>
</html>