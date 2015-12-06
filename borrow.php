<?php
//error reporting. comment out once code is working
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('stored_info.php');
//start session to check for valid login. if not, redirect to login page
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php", true);
  die();
}

//PARAMATERS IN POST
//item id
//search string

//connect to database
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
if(!$mysqli || $mysqli->connect_errno) {
  die("Failed to connect to MySQL in delete_to_do: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}


//Setting item borrower_id = user_id
//prepare return item statement
if (!($stmt = $mysqli->prepare("UPDATE Item SET `borrower_id` = ? WHERE `id` = ?;"))) {
  die("Prepare statement failed in borrow_item: (" . $mysqli->errno . ") " . $mysqli->error);
}

//bind param
if (!($stmt->bind_param('ii',$_SESSION['user_id'],$_POST['item_id'])  )){
  die("bind param statement failed in borrow_item: (" . $mysqli->errno . ") " . $mysqli->error);
}

//execute statement
if (!$stmt->execute()) {
  die("Execute failed in borrow_item: (" . $stmt->errno . ") " . $stmt->error);
}

//close statement
if (!$stmt->close()) {
  die("Close failed in borrow_item: (" . $stmt->errno . ") " . $stmt->error);
}

//successfully deleted task from to-do database. now regenerate user borrowed items table
$redirect = "http://" . $_SERVER['HTTP_HOST'] . urldecode($_POST['backto']);
header("Location: $redirect", true);
die();

?>