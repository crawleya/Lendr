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

//return item to original owner
$item_id = $_POST['id'];

//connect to database
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
if(!$mysqli || $mysqli->connect_errno) {
	die("Failed to connect to MySQL in delete_to_do: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

// //Find owner_id of item being returned
//prepare statement
if (!($stmt = $mysqli->prepare("SELECT `owner_id` FROM `Item` WHERE `id` = ?;"))) {
	die("Prepare statement 1 failed in return_item query: (" . $mysqli->errno . ") " . $mysqli->error);
}

//bind paramater
if (! ($stmt->bind_param("i", $item_id) ) ) {
	die("bind paramater failed in return_item: (" . $mysqli->errno . ") " . $mysqli->error);
}
		
//execute statement
if (!$stmt->execute()) {
	die("Execute 1 failed in return_item: (" . $stmt->errno . ") " . $stmt->error);
}

//bind results to php variables
if (!$stmt->bind_result($owner_id)) {
	die("Bind failed in item_list first query: (" . $stmt->errno . ") " . $stmt->error);
}
	
//fetch variable
$stmt->fetch();	
	
//close statement
if (!$stmt->close()) {
	die("Close 1 failed in return_item: (" . $stmt->errno . ") " . $stmt->error);
}

//Setting item borrower_id = owner_id
//prepare return item statement
if (!($stmt = $mysqli->prepare("UPDATE Item SET `borrower_id` = '$owner_id' WHERE `id` = '$item_id';"))) {
	die("Prepare 2 statement failed in return_item: (" . $mysqli->errno . ") " . $mysqli->error);
}

//execute statement
if (!$stmt->execute()) {
	die("Execute 2 failed in return_item: (" . $stmt->errno . ") " . $stmt->error);
}

//close statement
if (!$stmt->close()) {
	die("Close 2 failed in return_item: (" . $stmt->errno . ") " . $stmt->error);
}

//successfully deleted task from to-do database. now regenerate user borrowed items table
include('borrowed_list.php');

?>