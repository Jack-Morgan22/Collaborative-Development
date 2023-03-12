<!DOCTYPE html>
<html lang="en">
<?php
// Connect to server/database
$mysqli = mysqli_connect("localhost", "2112834", "85rj5j", "db2112834");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
} else {
	echo "Connected to the database successfully.";
}


