<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/sidebar.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div class="sidebar basis-2/12">
    <ul class="mr-2" id="sidebar">
      <?php
        // start the session
        if(!isset($_SESSION)) {
          session_start();
        }
        if ($_SESSION['privilege'] == 'admin'){
          ?>
            <li class="cursor-pointer">
              <a href="../admin/home.php" class="sidebar-link">
                <i class="fa fa-book"></i>
                Dashboard
              </a>
            </li>
            <li class="cursor-pointer">
              <a href="../admin/users.php" class="sidebar-link">
                <i class="fa fa-list"></i>
                Users
              </a>
            </li>
            <li class="cursor-pointer">
              <a href="../shared/view-event.php" class="sidebar-link">
                <i class="fa-solid fa-calendar-check"></i>
                Events
              </a>
            </li>
          <?php
        }
        elseif ($_SESSION['privilege'] == 'organizer'){
          ?>
            <li class="cursor-pointer">
              <a href="../organizer/my-event.php" class="sidebar-link">
                <i class="fa fa-book"></i>
                My Events
              </a>
            </li>
            <li class="cursor-pointer">
              <a href="../shared/view-event.php" class="sidebar-link">
              <i class="fa fa-list"></i>
                All Events
              </a>
            </li>
          <?php
        }
      ?>
    </ul>
    <ul>
      <li class="cursor-pointer">
        <a href="../shared/about-us.php" class="sidebar-link">
          <i class="fa fa-question-circle"></i>
          About Us
        </a>
      </li>
      <li class="cursor-pointer">
        <a href="../shared/t&c.php" class="sidebar-link">
        <i class="fa-solid fa-note-sticky"></i>
          T&C
        </a>
      </li>
      <li class="cursor-pointer">
        <a href="../shared/contact-us.php" class="sidebar-link">
          <i class="fas fa-user-shield"></i>
          Contact Us
        </a>
      </li>
    </ul>
  </div>
  <script src="https://kit.fontawesome.com/d7affc88cb.js" crossorigin="anonymous"></script>
</body>
</html>