<?php
//error reporting. comment out once code is working
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

include('stored_info.php');
//start session to check for valid login. if not, redirect to login page
session_start();
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php", true);
	die();
}

//leave group
$group_id = $_POST['id'];

//connect to database
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
if(!$mysqli || $mysqli->connect_errno) {
	die("Failed to connect to MySQL in join_group: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}
//Find owner_id of item being returned
//prepare statement
if (!($stmt = $mysqli->prepare("INSERT INTO `User_to_Group` (`User_to_Group`.`user_id`, `User_to_Group`.`group_id`) VALUES (?,?);"))) {
	die("Prepare statement 1 failed in join_group query: (" . $mysqli->errno . ") " . $mysqli->error);
}
//bind paramater
if (! ($stmt->bind_param("ii", $_SESSION['user_id'], $group_id) ) ) {
	die("bind paramater failed in join_group: (" . $mysqli->errno . ") " . $mysqli->error);
}	
//execute statement
if (!$stmt->execute()) {
	die("Execute 1 failed in join_group: (" . $stmt->errno . ") " . $stmt->error);
}
//close statement
if (!$stmt->close()) {
	die("Close 1 failed in join_group: (" . $stmt->errno . ") " . $stmt->error);
}

//successfully deleted task from to-do database. now regenerate user groups table
header("Location: groups.php", true);

?>