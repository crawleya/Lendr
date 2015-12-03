<?php
//error reporting. comment out once code is working
error_reporting(E_ALL);
ini_set('display_errors', 1);

//start session to check for valid login. if not, redirect to login page
session_start();

//check that a user is signed in. If not redirect to login page. Once logged in come back to this page
if (!isset($_SESSION['user_id'])) {
  $path = explode('/', $_SERVER['PHP_SELF'], -1);
  $path = implode('/',$path);
  $redirect = "http://" . $_SERVER['HTTP_HOST'] . $path;
  $getparams = "backto=" . urlencode($_SERVER['REQUEST_URI']) ;
  header("Location: {$redirect}/login.php?{$getparams}", true);
  exit();
}

if (isset($_POST['group_name'])){

  $continue = true;
  // including the database credentials
  include('stored_info.php');
  //connect to database
  $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
  if(!$mysqli || $mysqli->connect_errno) {
    die("Failed to connect to MySQL in groups: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
  }
  
  //Create a new group
  //prepare group creation statement
  if (!($stmt = $mysqli->prepare("INSERT INTO `Group` (`name`) VALUES (?)")) ) {
    die("Prepare statement failed in groups: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  if (! ($stmt->bind_param("s", $_POST['group_name']) ) ) {
    die("bind paramater failed in groups: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  //execute statement
  if (!$stmt->execute()) {
  	if ($stmt->errno === 1062) { //duplicate group name
		$message = "The group name already exists. Please try again.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$continue = false;
	}
	else { //any other error
		die("Execute failed in groups query: (" . $stmt->errno . ") " . $stmt->error);
	}
  }  
  //close statement
  if (!$stmt->close()) {
    die("Close failed in groups: (" . $stmt->errno . ") " . $stmt->error);
  }
  
  if ($continue == true) {
	  //Query for group_id
	  //prepare search statement
	  if (!($stmt = $mysqli->prepare("SELECT `id` FROM `Group` WHERE `name` = ?")) ) {
		die("Prepare statement failed in groups 2: (" . $mysqli->errno . ") " . $mysqli->error);
	  } 
	  if (! ($stmt->bind_param("s", $_POST['group_name']) ) ) {
		die("bind paramater failed in groups 2: (" . $mysqli->errno . ") " . $mysqli->error);
	  }
	  //execute statement
	  if (!$stmt->execute()) {
		die("Execute failed in groups 2 query: (" . $stmt->errno . ") " . $stmt->error);
	  }
	  //bind results to php variables
	  if (!$stmt->bind_result($group_id)) {
		die("Bind failed in groups 2 query: (" . $stmt->errno . ") " . $stmt->error);
	  }  
	  $stmt->fetch();
	  //close statement
	  if (!$stmt->close()) {
		die("Close failed in groups 2: (" . $stmt->errno . ") " . $stmt->error);
	  }
	  
	  //Add user to the new group
	  //prepare group creation statement
	  if (!($stmt = $mysqli->prepare("INSERT INTO `User_to_Group` (`user_id`, `group_id`) VALUES (?,?)")) ) {
		die("Prepare statement failed in groups 3: (" . $mysqli->errno . ") " . $mysqli->error);
	  }
	  if (! ($stmt->bind_param("ii", $_SESSION['user_id'], $group_id) ) ) {
		die("bind paramater failed in groups 3: (" . $mysqli->errno . ") " . $mysqli->error);
	  }
	  //execute statement
	  if (!$stmt->execute()) {
		die("Execute failed in groups 3 query: (" . $stmt->errno . ") " . $stmt->error);
	  }  
	  //close statement
	  if (!$stmt->close()) {
		die("Close failed in groups 3: (" . $stmt->errno . ") " . $stmt->error);
	  }
    }
}
?>


<html>
<head>
<meta charset="utf-8">
<title>Lendr</title>
<link rel="stylesheet" href="css/final-style.css" />
<script type="text/javascript" src="js/final-jscript.js"></script>
</head>
<body>
	<div class="container">
        <div class="header">
        </div><!-- header -->
        <h1 class="main_title">Welcome to Lendr

        <form action="login.php" method="POST" class="logout_form">
          <button class="logout_button" name="request" value="logout" type="submit">Logout</button>
        </form> 

        </h1>

        <div class="content">
            <br></br>
			<fieldset class="field_container">
                <legend> Create a group </legend>
                <form action="groups.php"  method="POST">
					Group Name:</br>
                    <input type="text" name="group_name" value="" required oninvalid="this.setCustomValidity('You must enter a group name to create a new group')" oninput="setCustomValidity('')"></br></br>
					<button class="frm_button" name="submit" value="Submit" type="submit">Submit</button>
                </form>
            </fieldset>
			<br></br>


      <fieldset class="field_container">
          <legend> Your Groups </legend>
          <div id="group_table">
              <?php 
                  //call group_list.php to create list of groups
                  include('group_list.php'); 
              ?>
          </div><!-- user_table -->
      </fieldset>
	  <br></br>


      <fieldset class="field_container">
          <legend> Other Groups </legend>
          <div id="other_group_table">
              <?php 
                  //call other_group_list.php to create list of groups
                  include('other_group_list.php'); 
              ?>
          </div><!-- user_table -->
      </fieldset>


        </div><!-- content -->    
    </div><!-- container -->




</body>
</html>
	

