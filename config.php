<?php
// Create connection
$conn = mysqli_connect("localhost", "root", "", "trialseditordb");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>