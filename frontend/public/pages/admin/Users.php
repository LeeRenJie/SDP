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
	<title>Users Page</title>
</head>
<body>
	<?php include '../shared/navbar.php';?>
	<div style="height:100% ; width: 100%;">
		<div class="row" style="height: 100%;">
			<!--1 column space reserved for side bar menu-->
			<div class="" style="width: 250px;">
				<p class="d-none">Side Bar Menu Space</p>
			</div>
			<!--Content Starts here-->
			<div class="col bg_color" style="height:100%;">
				<div class="row">
          <!--Return Page icon-->
          <div class="col-2">
            <a href="Home.html">
              <i class="fa-solid fa-circle-arrow-left fa-2xl m-5"></i>
            </a>
          </div>
          <!--Spacing-->
          <div class="col-4">
            <button type="button" class="green_button" style="margin-top: 8%;">Add Admin</button>
          </div>
          <!--Buttons from cssbuttons.io-->
          <div class="col-6">
            <button class="normal_button" style="margin-top: 5%;"> Backup Database</button>
            <button class="normal_button" style="margin-top: 5%; margin-left: 10%;"> Restore Database</button>
          </div>
				</div>

				<div class="row">
          <div class="col">
            <div class="row general_container mx-auto" style="width: 1050px; margin-top: 3%;">
              <!--header content-->
              <!--Admin need to click on user name or other personal detail to view profile-->
              <div class="row">
              <!--Buttons from cssbuttons.io-->
                <div class="col">
                  <button class="normal_button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" style="width: 20%; margin-left: 8%; height: 65px; margin-top: 4%;">Filter</button>
                </div>
              </div>
              <!--Start of Offcanvas structure-->
              <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                  <div class= "container">
                    <i class="fas fa-search"></i>
                    <!--RMB change attributes later when interact with DB-->
                    <input type="text" placeholder="Search User" name="search_key" style="width:188.8px; height:30px; margin-top:3.5%; margin-left:0%;">
                    <button type="submit" name="searchBtn" class="normal_button" style="width:73.03px; height:38px; padding: 0%;"><p style="font-size: 14px; padding-top:8%;">Search</p></button>
                  </div>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <div class="col">
                    <!--form-check is used to apply css to the checkboxes-->
                    <div class="row shadow p-3 mb-5 bg-body rounded form-check">
                      <ul style="list-style: none;">
                        <li>
                          <h4>Privilege</h4>
                        </li>
                        <li>
                          <input class="form-check-input" type="checkbox" value="" id="cartCheck1">
                          <label class="form-check-label" for="cartCheck1" style="font-size:16px;">
                            Participants
                          </label>
                        </li>
                        <li style="margin-top: 1.5%;">
                          <input class="form-check-input" type="checkbox" value="" id="cartCheck2">
                          <label class="form-check-label" for="cartCheck2" style="font-size:16px;">
                            Admins
                          </label>
                        </li>
                        <li style="margin-top: 1.5%;">
                          <input class="form-check-input" type="checkbox" value="" id="cartCheck3">
                          <label class="form-check-label" for="cartCheck3" style="font-size:16px;">
                            Judges
                          </label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!--End of Offcanvas structure-->
              <!--Table attributes-->
              <div class="row" style="width: 94%; margin-left: 3%; margin-top: 3%; padding-bottom: 3%;">
                <table class="table table-hover shadow-inset rounded">
                  <tr>
                    <th class="border-0" scope="col" id="class3" style="width: 20%;">Username</th>
                    <th class="border-0" scope="col" id="teacher3" style="width: 25%;">Name</th>
                    <th class="border-0" scope="col" id="males3" style="width: 20%;">Privilege</th>
                    <th class="border-0" scope="col" id="females3">Email</th>
                    <th class="border-0" scope="col" id="females3" style="width: 10%;">
                        Action
                        <!-- checkbox (old)
                        <label class="checkbox_container" style="">
                            <input type="checkbox" checked="checked">
                            <div class="checkmark"></div>
                        </label>
                        -->
                    </th>
                  </tr>
                  <!--RMB Change to PHP to loop for each row-->
                  <tr>
                    <!--Insert user id into the end of the (?) href link-->
                    <th scope="row" id="firstyear3" rowspan=""><a href="User_profile.html?"> RJ123 </a></th>
                    <th scope="row" id="Bolter3" headers="firstyear3 teacher3"><a href="User_profile.html?">Ren Jie Lee</a></th>
                    <td headers="firstyear3 Bolter3 males3">Participant</td>
                    <td headers="firstyear3 Bolter3 females3">abc2718@gmail.com</td>
                    <th class="border-0" scope="col" id="females3">
                      <div class="btn-group mb-2 mr-2 ml-2">
                        <button type="button" class="btn btn-tertiary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="fas fa-angle-down dropdown-arrow"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#">View Profile</a>
                          <a class="dropdown-item" href="#">Delete</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <th scope="row" id="firstyear3" rowspan=""><a href="User_profile.html?">JH123</a></th>
                    <th scope="row" id="Bolter3" headers="firstyear3 teacher3"><a href="User_profile.html?">Chiang Juo Han</a></th>
                    <td headers="firstyear3 Bolter3 males3">Admin</td>
                    <td headers="firstyear3 Bolter3 females3">JHC2318@gmail.com</td>
                    <th class="border-0" scope="col" id="females3">
                      <div class="btn-group mb-2 mr-2 ml-2">
                        <button type="button" class="btn btn-tertiary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="fas fa-angle-down dropdown-arrow"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#">View Profile</a>
                          <a class="dropdown-item" href="#">Delete</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                      </div>
                    </th>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
			</div>
		</div>
	</div>
	<!--This script keep all checkboxes unchecked by default-->
	<script>
		var inputs = document.getElementsByTagName('input');
		for (var i=0; i<inputs.length; i++)  {
			if (inputs[i].type == 'checkbox')   {
				inputs[i].checked = false;
			}
		}
	</script>
</body>
</html>