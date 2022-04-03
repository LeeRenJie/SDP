<?php
if(!isset($_SESSION)) {
  session_start();
}

// check if user is logged in
if (!isset($_SESSION['username']))
{
  echo("<script>alert('Please enter the unique of the event!')</script>");
  echo("<script>window.location = '../judge/enter-event.php'</script>");
}
?>