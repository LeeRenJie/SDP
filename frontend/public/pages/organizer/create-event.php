<?php
  // start the session
  if(!isset($_SESSION)) {
    session_start();
  };

  // Restrict customer to access this page
  if ($_SESSION['privilege'] != "organizer") {
    echo("<script>alert('You do not have access to this page')</script>");
    header("Location: ../shared/view-event.php");
  };

  if(isset($POST["createBtn"])){
    // get the data from the form

    // get event picture name
    $eventPic = $_FILES['eventPic']['tmp_name'];
    if ($_FILES['eventPic']['size'] > 0){
        //get image type
        $imageFileType = strtolower(pathinfo($eventPic,PATHINFO_EXTENSION)); //(Newbedev, 2021)
        //encode image into base64
        $base64_Img = base64_encode(file_get_contents($eventPic));
        //set image content with type and base64
        $image = 'data:image/'.$imageFileType.';base64,'.$base64_Img;
    } else {
        // event pic is null if no image is uploaded
        $eventPic = NULL;
    }

    // get event name
    $eventName = $_POST["event-name"];
    // get event description
    $eventDescription = $_POST["event-description"];
    // get event date
    $eventDate = $_POST["event-date"];
    // validation if event date is after today's date
    $today = date("d/m/y");
    if ($eventDate < $today) {
      echo("<script>alert('Event date must be after today's date')</script>");
      header("Location: ../shared/create-event.php");
    };
    // get event start time
    $eventStartTime = $_POST["event-start-time"];
    // get event end time
    $eventEndTime = $_POST["event-end-time"];
    // get event max participant/team
    $maxPeople = $_POST["max-people"];
    // get event participant type
    $participantType = $_POST['participant-type'];
    $participantType == "solo" ? $participantType="solo" : $participantType="team";
    // if solo max member per team is one, if team get max member per team
    if ($participantType == "solo"){
      $maxMembers = 1;
    } else {
      $maxMembers = $_POST["max-members"];
    }
    // loop through event rules array to input same name into database
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/create-event.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>Create Event</title>
</head>
<body>
  <?php include '../shared/navbar.php';?>
  <div class="flex flex-row h-screen">
    <?php include '../shared/sidebar.php';?>
    <div class="basis-10/12 bg-shadow overflow-auto" style="border-radius:30px;">
      <div class="flex flex-row">
        <span onclick="history.back()" class="pl-5 pt-4 pr-3">
          <i class="fa-solid fa-circle-arrow-left fa-2xl"></i>
        </span>
        <h1 class="py-2 inline-block"><b>Tell Us About Your Event</b></h1>
      </div>
      <div class="text-center img-container ml-5">
        <label for=imageUpload>
          <img src="../../images/default.jpg" class="cursor-pointer mx-auto d-block img-size shadow-inset"
          data-toggle="tooltip" data-placement="bottom" title="Recommended image size is 1100 x 480" id="img" name="image" alt="Event Image">
        </label>
      </div>
      <div class="h-0 overflow-hidden">
        <input id="imageUpload" type="file" name="eventPic" onchange="preimg(img)" capture/>
      </div>
      <label class="grey-button ml-5 mt-3 mb-4 cursor-pointer" for="imageUpload">Choose An Image</label>
      <form class="row pl-5 mt-3 form-container">
        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event">Event Name</label>
            <input type="text" class="form-control" id="event" name="event-name"  placeholder="Enter your event name...">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event-date">Event Date</label>
            <input type="date" class="form-control" id="event-date" name="event-date" placeholder="dd/mm/yy" required="required">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event-time">Event Start Time</label>
            <input type="time" class="form-control" id="event-start-time" name="event-start-time" placeholder="hh:mm" required="required">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event-time">Event End Time</label>
            <input type="time" class="form-control" id="event-end-time" name="event-end-time" placeholder="hh:mm" required="required">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="max-people">Max Teams / Participants</label>
            <input type="text" class="form-control" id="max-people" name="max-people" placeholder="Maximum number of participants or teams..." required="required">
          </div>
        </div>

        <div class="col-6" id="participant-type">
          <div class="form-group mb-4">
            <label for="participant-type">Participant Type</label>
            <select class="custom-select" id="particpant-type" placeholder="Choose...">
                <option value="solo">Solo</option>
                <option value="team">Team</option>
            </select>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" >
            <label for="description">Max members</label>
            <input type="text" class="form-control input-disabled" id="max-member" name="max-member" placeholder="Maximum number of members per team..." required="required" disabled>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4">
            <label for="description">Event Description</label>
            <textarea class="form-control" id="description" rows="6" placeholder="Enter event description..."></textarea>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" id="dynamic_rule">
            <label for="rule">Event Rules</label>
            <div class="input-group mb-2">
              <input type="text" class="form-control" id="rule" name="rule[]" placeholder="Enter rules of the event..." aria-label="Input group" required="required">
              <div class="input-group-append cursor-pointer" id="add_rule" >
                <span class="input-group-text">
                  <button class="fa-solid fa-plus" name="add_rule" type="button"></button>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4">
            <label for="prizes">Event Prizes</label>
            <div class="input-group mb-1">
              <span class="input-group-text">RM</span>
              <input type="text" class="form-control mb-1" id="prize[1]" name="prize[1]" placeholder="1st Prize" required="required">
            </div>
            <div class="input-group mb-1">
              <span class="input-group-text">RM</span>
              <input type="text" class="form-control mb-1" id="prize[2]" name="prize[2]" placeholder="2nd Prize" required="required">
            </div>
            <div class="input-group mb-1">
              <span class="input-group-text">RM</span>
              <input type="text" class="form-control mb-1" id="prize[3]" name="prize[3]" placeholder="3rd Prize" required="required">
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" id="dynamic_judge">
            <label for="judge">Judges Name</label>
            <div class="input-group mb-2">
              <input type="text" class="form-control" id="judge" name="judge[]" placeholder="Enter the judge's name..." aria-label="Input group" required="required">
              <div class="input-group-append cursor-pointer" id="add_judge">
                <span class="input-group-text">
                  <button class="fa-solid fa-plus" name="add_judge" type="button"></button>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="form-group mb-4" id="dynamic_criteria">
            <label for="criteria">Criteria</label>
            <div class="input-group mb-2">
              <input type="text" class="form-control" id="criteria" name="criteria[]" placeholder="Enter criteria of the event to judge..." aria-label="Input group" required="required">
              <div class="input-group-append cursor-pointer" id="add_criteria">
                <span class="input-group-text">
                <button class="fa-solid fa-plus" name="add_criteria" type="button"></button>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-end mt-2">
          <button class="btn btn-primary animate-up-2 mr-2" type="submit" name="createBtn">Create</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    //this script use to preview image before upload
    // (Nkron, 2014)
    function preimg(img) {
      document.getElementById('img').src="../../images/default.jpg";
      var picture = new FileReader();
      if (picture) {
        picture.onload = function(){
          var imgpreview = document.getElementById('img');
          imgpreview.src = picture.result;
        }
        picture.readAsDataURL(event.target.files[0]);
      }
    }

    $(document).ready(function() {
      var i = 1;
      $('#add_rule').click(function(){
        i++;
        $('#dynamic_rule').append('<div class="input-group mb-2" id="row' + i + '"><input type="text" class="form-control" id="rule" name="rule[]" placeholder="Enter rules of the event..." aria-label="Input group" required="required"><div class="input-group-append cursor-pointer btn_remove" id="' + i + '"><span class="input-group-text"><button class="fa-solid fa-trash-can btn-remove" type="button"></button></span></div></div>')
      });

      $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
      });
    });

    $(document).ready(function() {
      var a = 1;
      $('#add_judge').click(function() {
        a++;
        $('#dynamic_judge').append('<div class="input-group mb-2" id="row' + a + '"><input type="text" class="form-control" id="judge" name="judge[]" placeholder="Enter judge name..." aria-label="Input group" required="required"><div class="input-group-append cursor-pointer btn_remove_judge" id="' + a + '"><span class="input-group-text"><button class="fa-solid fa-trash-can" type="button"></button></span></div></div>')
      });

      $(document).on('click', '.btn_remove_judge', function() {
        var button_id_judge = $(this).attr("id");
        $('#row'+button_id_judge+'').remove();
      });
    });

    $(document).ready(function() {
      var b = 1;
      $('#add_criteria').click(function() {
        b++;
        $('#dynamic_criteria').append('<div class="input-group mb-2" id="row' + b + '"><input type="text" class="form-control" id="criteria" name="criteria[]" placeholder="Enter criteria of the event to judge..." aria-label="Input group" required="required"><div class="input-group-append cursor-pointer btn_remove_criteria" id="' + b + '"><span class="input-group-text"><button class="fa-solid fa-trash-can" type="button"></button></span></div></div>')
      });

      $(document).on('click', '.btn_remove_criteria', function() {
        var button_id_criteria = $(this).attr("id");
        $('#row'+button_id_criteria+'').remove();
      });
    });

    $('select').change(function() {
      if($('select option:selected').text() == "Team") {
        $('.input-disabled').prop("disabled", false);
      }
      else {
        $('.input-disabled').prop("disabled", true);
      };
    });
  </script>
</body>
</html>
