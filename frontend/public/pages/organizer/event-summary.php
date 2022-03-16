<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/event-summary.css" />
  <title>Event Summary</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 bg-shadow overflow-auto">
      <div class="row pt-4 pl-5">
        <!-- Event name and status -->
        <div class="col-9">
          <h1 class="inline-block"><b>Event Summary</b></h1>
        </div>
        <!-- Button actions for the event -->
        <div class="col-3">
          <button type="button" class="grey-button ml-5 cursor-pointer">Save As PDF</button>
        </div>
      </div>
      <!-- Image of event -->
      <div class="text-center img-container ml-5">
        <img src="../../images/default.jpg" class="mx-auto d-block img-size shadow-inset" alt="Event Image">
      </div>
      <!-- Details of event -->
      <div class="row pl-5 pt-4">
        <h3 class="block"><b>Details</b></h3>
      </div>
      <div class="row ml-5 pt-2 detail-container">
        <div class="col-4">
          <div class="row py-2">
            <div class="col-6 text-center">
              <div class="inline-block details pt-3">
                <span class="h5">
                  <i class="fa-solid fa-calendar-day"></i>
                  Date
                </span>
                <p class="pt-4">17/10/2022</p>
              </div>
            </div>
            <div class="col-6 text-center">
              <div class="inline-block details pt-3">
                <span class="h5">
                  <i class="fa-solid fa-clock"></i>
                  Time
                  </span>
                <p class="pt-4">8:00 a.m.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6 text-center">
              <div class="inline-block details pt-3">
                <span class="h5">
                  <i class="fa-solid fa-person"></i>
                  Max
                </span>
                <p class="pt-4 card-text">30 Person</p>
              </div>
            </div>
            <div class="col-6 text-center">
              <div class="inline-block details pt-3">
                <span class="h5">
                  <i class="fa-solid fa-question"></i>
                  Type
                </span>
                <p class="pt-4">Solo</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-8 text-center pt-2">
          <div class="inline-block overflow-y-auto description pt-3">
            <span class="h5">
              <i class="fa-solid fa-message"></i>
              Description
            </span>
            <p class="px-5 pt-3 text-justify">
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            </p>
          </div>
        </div>
        <div class="row py-3">
          <div class="col-4 text-center">
            <div class="inline-block prizes overflow-y-auto pt-3 ml-1">
              <span class="h5">
                <i class="fa-solid fa-trophy"></i>
                Prizes
              </span>
              <div  style="text-align: center;">
                <!-- table to display winner and money prizes -->
                <table class="table">
                  <thead>
                    <tr>
                      <th>Winners</th>
                      <th>Prizes</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>John Doe</td>
                      <td>RM 5000</td>
                    </tr>
                    <tr>
                      <td>John Doe</td>
                      <td>RM 3000</td>
                    </tr>
                    <tr>
                      <td>John Doe</td>
                      <td>RM 1500</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-8 text-center">
            <div class="inline-block overflow-y-auto rules pt-3">
              <span class="h5">
                <i class="fa-solid fa-scroll"></i>
                Rules
              </span>
              <?php
                for ($x = 0; $x <= 5; $x++) {
                  echo (
                    "<p class='px-5 pt-3 text-justify'>
                      •  Lorem Ipsum is simply dummy text of the printing and typesetting industry.  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>"
                  );
                }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row ml-5 pt-4 width">
        <!-- Judges Info -->
        <div class="col-6 pl-0">
          <h3 class="float-start"><b>Judges</b></h3>
          <h5 class="float-end opacity-50">Total: 30</h5>
          <table class="table judge-table overflow-y-auto">
            <tr>
              <th class="border-0" scope="col" id="name" width="32.5%">Name</th>
              <th class="border-0" scope="col" id="code" width="52.5%">Code</th>
              <th class="border-0" scope="col" id="actions" width="15%">Actions</th>
            </tr>
            <tr>
              <td>Lee Ren Jie</td>
              <td>ioabscisf121383rb</td>
              <td class="text-center dropdown">
                <a href="#" data-toggle="dropdown">
                  <i class="fa-solid fa-ellipsis"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="">Action</a></li>
                  <li><a class="dropdown-item" href="">Remove Judge</a></li>
                </ul>
              </td>
            </tr>
          </table>
        </div>
        <!-- Participant Info -->
        <div class="col-6 pr-0">
          <h3 class="float-start"><b>Teams/Participants</b></h3>
          <h5 class="float-end opacity-50">Total: 30</h5>
          <table class="table participant-table overflow-y-auto">
            <tr>
              <th class="border-0" scope="col" id="name" width="32.5%">Name</th>
              <th class="border-0" scope="col" id="code" width="52.5%">Code</th>
              <th class="border-0" scope="col" id="actions" width="15%">Actions</th>
            </tr>
            <tr>
              <td>Lee Ren Jie</td>
              <td>ioabscisf121383rb</td>
              <td class="text-center dropdown">
                <a href="#" data-toggle="dropdown">
                  <i class="fa-solid fa-ellipsis"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="">Action</a></li>
                  <li><a class="dropdown-item" href="">Remove Participant</a></li>
                </ul>
              </td>
            </tr>
            <tr>
              <td>Lee Ren Jie</td>
              <td>ioabscisf121383rb</td>
              <td class="text-center dropdown">
                <a href="#" data-toggle="dropdown">
                  <i class="fa-solid fa-ellipsis"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="">Action</a></li>
                  <li><a class="dropdown-item" href="">Remove Participant</a></li>
                </ul>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>