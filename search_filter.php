<?php
//error reporting. comment out once code is working
error_reporting(E_ALL);
ini_set('display_errors', 1);
$user_id = $_SESSION['user_id'];
?>

<?php
	//Query database for items being borrowed by current user		
	// including the database credentials
	include('stored_info.php');
	//connect to database
	$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
	if(!$mysqli || $mysqli->connect_errno) {
		die("Failed to connect to MySQL in search_filter first query: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
	}
	
	//prepare search statement
	if (!($stmt = $mysqli->prepare("SELECT Group.name, Group.id FROM `Group` INNER JOIN User_to_Group ON Group.id = User_to_Group.group_id WHERE User_to_Group.user_id = ?;"))) {
		die("Prepare statement failed in search_filter first query: (" . $mysqli->errno . ") " . $mysqli->error);
	}
	//bind paramater search statement
	if (!($stmt->bind_param("i",$user_id))) {
		die("bind parameter failed in search_filter first query: (" . $mysqli->errno . ") " . $mysqli->error);
	}
	
	//execute statement
	if (!$stmt->execute()) {
		die("Execute failed in search_filter first query: (" . $stmt->errno . ") " . $stmt->error);
	}
	
	//bind results to php variables
	if (!$stmt->bind_result($group_name, $group_id)) {
		die("Bind failed in search_filter first query: (" . $stmt->errno . ") " . $stmt->error);
	}

	//output group name to the dropdown list
	while($stmt->fetch()) {
		echo "<option value=\"".$group_id."\">".$group_name."</option>";
	}
	
	//close statement
	if (!$stmt->close()) {
		die("Close 1 failed in search_filter: (" . $stmt->errno . ") " . $stmt->error);}
 ?>