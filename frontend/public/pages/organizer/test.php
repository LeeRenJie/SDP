<!DOCTYPE html>
<html>
<body>

<h1>Show a Time Input Control</h1>

<p>If the browser supports it, a time picker pops up when entering the input field.</p>

<form method="post">
  <label for="event-start-time">Start time:</label>
  <input type="time"  id="event-start-time" name="event-start-time" placeholder="hh:mm" required="required">
  <label for="event-end-time">End time:</label>
  <input type="time"  id="event-end-time" name="event-end-time" placeholder="hh:mm" required="required">
  <input type="submit">
</form>

<?php
if(isset($_POST['event-start-time']) && isset($_POST['event-end-time'])) {
  $eventStartTime = $_POST["event-start-time"];
      // get event end time
  $eventEndTime = $_POST["event-end-time"];
  echo $eventStartTime;
  echo "<br/>";
  echo $eventEndTime;
  echo "<br/>";
  echo strtotime($eventEndTime);
  echo "<br/>";
  echo strtotime($eventStartTime);
  echo "<br/>";
  if(strtotime($eventStartTime) < strtotime($eventEndTime)) {
    echo "End time is greater than start time";
  }
}
?>
<p><strong>Note:</strong> type="time" is not supported in Internet Explorer 11 or prior Safari 14.1.</p>

</body>
</html>
