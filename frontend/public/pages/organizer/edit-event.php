<?php
	// Connect to database
  include("../../../../backend/conn.php");

  // Get event id from url
  $eventID = intval($_GET['event-id']);

  // Get event details from database
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
        <img src="../../images/default.jpg" class="mx-auto d-block img-size shadow-inset" alt="Event Image">
      </div>
      <div class="h-0 overflow-hidden">
        <input type="file" id="fileInput" name="fileInput" />
      </div>
      <button type="button" class="grey-button ml-5 mt-3 mb-4 cursor-pointer" onclick="chooseFile();">Choose An Image</button>
      <form class="row pl-5 mt-3 form-container">

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event">Event Name</label>
            <input type="text" class="form-control" id="event" placeholder="Enter your event name...">
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
            <input type="time" class="form-control" id="event-time" name="event-time" placeholder="hh:mm" required="required">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="event-time">Event End Time</label>
            <input type="time" class="form-control" id="event-time" name="event-time" placeholder="hh:mm" required="required">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="max-people">Max Teams / Participants</label>
            <input type="text" class="form-control" id="max-people" name="max-people" placeholder="Max number of participants or teams..." required="required">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group mb-4">
            <label for="participant-type">Participant Type</label>
            <select class="custom-select" id="particpant-type" placeholder="Choose...">
                <option value="1">Solo</option>
                <option value="2">Team</option>
            </select>
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
          <button class="btn btn-primary animate-up-2 mr-2" type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    function chooseFile(){
      document.getElementById("fileInput").click();
    }

    $(document).ready(function() {
      var i = 1;
      $('#add_rule').click(function() {
        i++;
        $('#dynamic_rule').append('<div class="input-group mb-2" id="row' + i + '"><input type="text" class="form-control" id="rule" name="rule[]" placeholder="Enter rules of the event..." aria-label="Input group" required="required"><div class="input-group-append cursor-pointer btn_remove" id="' + i + '"><span class="input-group-text"><button class="fa-solid fa-trash-can" type="button"></button></span></div></div>')
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
  </script>
</body>
</html>
