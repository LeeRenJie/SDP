<?php
// Connect with the database named db_name
$con=mysqli_connect("localhost","root","","judgeable");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>