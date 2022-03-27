<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/28d45fc291.js" crossorigin="anonymous"></script>
	<link href="../../../src/stylesheets/admin-users.css" rel="stylesheet">
	<link rel="stylesheet" href="../../../src/stylesheets/neumorphism.css">
	<title>Home-users Page</title>
</head>
<body>
  <!--Include navbar and sidebar-->
	<?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 overflow-auto dark_shadow ">
      <!--Start of form-->
      <!--redirect to main user page after form is submitted-->
      <form action="users.php" method="post">
	    <div class="large-con">
	    	<div class="row" style="height: 100%;">
	    		<!--Content Starts here-->
	    		<div class="col" style="height:100%;">
	    			<div class="row first_row">
              <!--Return Page icon-->
              <div onclick="history.back()" class="col-2">
                <i class="fa-solid fa-circle-arrow-left fa-2xl m-5"></i>
              </div>
              <!--Spacing-->
              <div class="col-4">
                <button type="button" class="green_button addadmin_button" onclick = "Redirect();">Add Admin</button>
              </div>
              <!--Buttons from cssbuttons.io-->
              <div class="col-6">
                <button type="button" class="button normal_button animate-up-2 backup_button" onclick="Redirect_backup()">
                  <i class="fa-solid fa-download"></i> Backup Database
                </button>
                <button type="button" class="button normal_button animate-up-2 restore_button" onclick="Redirect_restore()">
                  <i class="fa-solid fa-upload" ></i>  Restore Database
                </button>
              </div>
	    			</div>
            <!--start of testing-->

            <!--end of testing-->
	    			<div class="row pad">
              <div class="col">
                <div class="row general_container mx-auto">
                  <!--header content-->
                  <div class="row">
                  <!--Buttons from cssbuttons.io-->
                    <div class="col">
                      <button class="normal_button animate-up-2 filter_button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Filter</button>
                    </div>
                  </div>
                  <!--Start of Offcanvas structure-->
                  <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                      <div class= "container">
                        <i class="fas fa-search"></i>
                        <!--RMB change attributes later when interact with DB-->
                        <input type="text" placeholder="Search User" name="search_key" class="input_box">
                        <button type="submit" name="searchBtn" class="normal_button search_button"><p class="search_button_label">Search</p></button>
                      </div>
                      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                      <div class="col">
                        <!--form-check is used to apply css to the checkboxes-->
                        <div class="row shadow p-3 mb-5 bg-body rounded form-check">
                          <ul style="list-style: none;">
                            <li class="cancel-hover">
                              <h4>Privilege</h4>
                            </li>
                            <li>
                              <input class="form-check-input" type="checkbox" id="d1" name="privilege_value[]" value="1">
                              <label class='enlarge-content form-check-label' for='d1' style='font-size:16px;'>
                                Admin
                              </label>
                            </li>
                            <li>
                              <input class="form-check-input" type="checkbox" id="d2" name="privilege_value[]" value="2">
                              <label class='enlarge-content form-check-label' for='d2' style='font-size:16px;'>
                                Organizer
                              </label>
                            </li>
                            <li>
                              <input class="form-check-input" type="checkbox" id="d3" name="privilege_value[]" value="3">
                              <label class='enlarge-content form-check-label' for='d3' style='font-size:16px;'>
                                Participant
                              </label>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--End of Offcanvas structure-->
                  <!--Table attributes-->
                  <div class="row table_row">
                    <table class="table table-hover shadow-inset rounded">
                      <tr>
                        <th class="border-0" scope="col" id="class3" style="width: 20%;">Username</th>
                        <th class="border-0" scope="col" id="teacher3" style="width: 25%;">Name</th>
                        <th class="border-0" scope="col" id="males3" style="width: 20%;">Privilege</th>
                        <th class="border-0" scope="col" id="females3">Email</th>
                        <th class="border-0 border_extra" scope="col" id="females3" style="width: 10%;">Action</th>
                      </tr>
                      <!--RMB Change to PHP to loop for each row-->
                      <?php
                        // use query string to fetch data from previous page --> "home.php" 
                        $privilege_check = '' ;
                        $privilege_check = $_SERVER['QUERY_STRING'];

                        $static_query = "SELECT * FROM user INNER JOIN privilege ON user.privilege_id = privilege.privilege_id WHERE privilege.privilege_id IN ($privilege_check)";
                        $static_query_run = mysqli_query($con, $static_query);
                        if (is_array($static_query_run) || is_object($static_query_run))
                        {
                          foreach($static_query_run as $static_data)
                          {
                            ?>
                            <tr>
                              <!--Insert user id into the end of the (?) href link-->
                              <th scope="row" id="firstyear3"><a href="User_profile.html?"> <p class="enlarge-content bold-font"><?=$static_data['username']?></p> </a></th>
                              <th scope="row" id="Bolter3" headers="firstyear3 teacher3"><a href="User_profile.html?"><p class="enlarge-content"><?=$static_data['name']?></p></a></th>
                              <td headers="firstyear3 Bolter3 males3"><p class="enlarge-content"><?=$static_data['user_privilege']?></p></td>
                              <td headers="firstyear3 Bolter3 females3"><p class="enlarge-content"><?=$static_data['email']?></p></td>
                              <th class="border-0" scope="row" id="firstyear3">
                                <div class="btn-group mb-2 mr-2 ml-2">
                                  <button type="button" class="btn btn-tertiary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-angle-down dropdown-arrow"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="user_profile.php?<?=$static_data['user_id']?>">View Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="delete-user.php?<?=$static_data['user_id']?>">Delete</a>
                                  </div>
                                </div>
                              </th>
                            </tr>
                            <?php
                          }
                        }
                      ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
	    		</div>
	    	</div>
	    </div>
      </form>
    </div>
  </div>
  <script type = "text/javascript">
    function Redirect() 
    {
      window.location = "http://localhost:8080/SDP/frontend/public/pages/admin/new_admin.php";
    }
    function Redirect_backup()
    {
      location.href = "http://localhost:8080/phpmyadmin/index.php?route=/server/export";
      alert("Please log into phpMyAdmin by clicking the 'Go' button, then select 'Export' from the navigation bar.");
    }
    function Redirect_restore()
    {
      window.location = "http://localhost:8080/phpmyadmin/index.php?route=/server/import";
      alert("Please log into phpMyAdmin by clicking the 'Go' button, then select 'Import' from the navigation bar.");
    }
  </script>
</body>
</html>