<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/t&c.css" />
  <title>Terms & Conditions</title>
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
            <div class="text-center">
              <h1 class="display-2">Terms and Conditions</h1>
            </div>
          </div>
        </div>
        <?php
      }
      else{
        include '../shared/sidebar.php';
        ?>
        <div class="basis-10/12 bg-shadow overflow-y-auto" style="border-radius:30px;">
          <div class="overflow-y-auto">
            <div onclick="history.back()" class="pl-5 cursor-pointer pt-4">
              <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
            </div>
            <div class="text-center">
              <h1 class="display-2">Terms and Conditions</h1>
            </div>
          </div>
        </div>
        <?php
      }
    ?>
  </div>
</body>
</html>