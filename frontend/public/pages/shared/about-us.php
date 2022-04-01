<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/about-us.css" />
  <title>About Us</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php 
      if(!isset($_SESSION)) {
        session_start();
      }
      if (!isset($_SESSION['privilege'])){
        ?>
        <div class="col overflow-y-auto marg" style="border-radius:30px;">
          <div class="overflow-y-auto">
            <div onclick="history.back()" class="pl-5 cursor-pointer pt-4">
              <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
            </div>
            <div class="pos">
              <img class="image" src="../../images/logo.svg" alt="logo" class="logo" >
            </div>
            <div class="d-flex justify-content-center">
              <div class="card bg-primary border-light shadow-soft w-60 card-height pb-4">
                <div class="text-center">
                  <h1 class="display-2 mt-4">About Us</h1>
                </div>
                <div class="p-4">
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                    incididunt ut labore et dolore magna aliqua. Enim sit amet venenatis urna cursus eget nunc scelerisque viverra. 
                    At tellus at urna condimentum mattis pellentesque id. Diam in arcu cursus euismod quis viverra nibh. 
                    Etiam erat velit scelerisque in dictum non consectetur. Morbi tristique senectus et netus et malesuada fames. 
                    Iaculis eu non diam phasellus vestibulum lorem. Sodales neque sodales ut etiam sit amet nisl. 
                    Tincidunt praesent semper feugiat nibh sed pulvinar proin. 
                    In dictum non consectetur a erat. Tortor at auctor urna nunc id cursus. Lacus laoreet non curabitur gravida arcu ac tortor.
                    <br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                    incididunt ut labore et dolore magna aliqua. Enim sit amet venenatis urna cursus eget nunc scelerisque viverra. 
                    At tellus at urna condimentum mattis pellentesque id. Diam in arcu cursus euismod quis viverra nibh. 
                    Etiam erat velit scelerisque in dictum non consectetur. Morbi tristique senectus et netus et malesuada fames. 
                    Iaculis eu non diam phasellus vestibulum lorem. Sodales neque sodales ut etiam sit amet nisl. 
                    Tincidunt praesent semper feugiat nibh sed pulvinar proin. 
                    In dictum non consectetur a erat. Tortor at auctor urna nunc id cursus. Lacus laoreet non curabitur gravida arcu ac tortor.
                    <br>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      else{
        include '../shared/sidebar.php';
        ?>
        <div class="basis-10/12 bg-shadow overflow-y-auto back-shadow" style="border-radius:30px;">
          <div class="overflow-y-auto">
            <div onclick="history.back()" class="pl-5 cursor-pointer pt-4">
              <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
            </div>
            <div class="pos">
              <img class="image" src="../../images/logo.svg" alt="logo" class="logo" >
            </div>
            <div class="d-flex justify-content-center">
              <div class="card bg-primary border-light shadow-soft card-height pb-4">
                <div class="text-center">
                  <h1 class="display-2 mt-4">About Us</h1>
                </div>
                <div class="p-4">
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                    incididunt ut labore et dolore magna aliqua. Enim sit amet venenatis urna cursus eget nunc scelerisque viverra. 
                    At tellus at urna condimentum mattis pellentesque id. Diam in arcu cursus euismod quis viverra nibh. 
                    Etiam erat velit scelerisque in dictum non consectetur. Morbi tristique senectus et netus et malesuada fames. 
                    Iaculis eu non diam phasellus vestibulum lorem. Sodales neque sodales ut etiam sit amet nisl. 
                    Tincidunt praesent semper feugiat nibh sed pulvinar proin. 
                    In dictum non consectetur a erat. Tortor at auctor urna nunc id cursus. Lacus laoreet non curabitur gravida arcu ac tortor.
                    <br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                    incididunt ut labore et dolore magna aliqua. Enim sit amet venenatis urna cursus eget nunc scelerisque viverra. 
                    At tellus at urna condimentum mattis pellentesque id. Diam in arcu cursus euismod quis viverra nibh. 
                    Etiam erat velit scelerisque in dictum non consectetur. Morbi tristique senectus et netus et malesuada fames. 
                    Iaculis eu non diam phasellus vestibulum lorem. Sodales neque sodales ut etiam sit amet nisl. 
                    Tincidunt praesent semper feugiat nibh sed pulvinar proin. 
                    In dictum non consectetur a erat. Tortor at auctor urna nunc id cursus. Lacus laoreet non curabitur gravida arcu ac tortor.
                    <br>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
    ?>
  </div>
</body>
</html>