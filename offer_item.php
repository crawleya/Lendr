<?php
//error reporting. comment out once code is working
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//start session to check for valid login. if not, redirect to login page
session_start();

//$_SESSION['user_id'] = 5; //For testing only prior to login page creation
if (!isset($_SESSION['user_id'])) {
  $path = explode('/', $_SERVER['PHP_SELF'], -1);
  $path = implode('/',$path);
  $redirect = "http://" . $_SERVER['HTTP_HOST'] . $path;
  $getparams = "backto=" . urlencode($_SERVER['REQUEST_URI']) ;
  header("Location: {$redirect}/login.php?{$getparams}", true);
  exit();
}

if (isset($_POST['itemname'])){

  // including the database credentials
  include('stored_info.php');
  //connect to database
  $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
  if(!$mysqli || $mysqli->connect_errno) {
    die("Failed to connect to MySQL in offer_item: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
  }
  
  //prepare search statement
  if (!($stmt = $mysqli->prepare("INSERT INTO Item (name, owner_id, borrower_id) VALUES (?,?,?)")) ) {
    die("Prepare statement failed in offer_item: (" . $mysqli->errno . ") " . $mysqli->error);
  }
  
  if (! ($stmt->bind_param("sii", $_POST['itemname'], $_SESSION['user_id'], $_SESSION['user_id']) ) ) {
    die("bind paramater failed in offer_item: (" . $mysqli->errno . ") " . $mysqli->error);
  }

  //execute statement
  if (!$stmt->execute()) {
    die("Execute failed in offer_item first query: (" . $stmt->errno . ") " . $stmt->error);
  }
  
  //close statement
  if (!$stmt->close()) {
    die("Close failed in offer_item: (" . $stmt->errno . ") " . $stmt->error);
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
          <ul>
            <li><a href="search.php">Search</a></li>
            <li><a href="groups.php">Groups</a></li>
            <li><a href="offer_item.php">Offer item</a></li>
            <li><a href="user_items.php">User items</a></li>
            <ul>
              <li style="background:#3333ff;"><a href="login.php?request=logout">Logout</a></li>
            </ul>

          </ul>
        </h1>

        <div class="content">
            <br></br>
			<fieldset class="field_container">
                <legend> Offer an item </legend>
                <form action="offer_item.php"  method="POST">
					Item Name:</br>
                    <input type="text" name="itemname" value=""></br></br>
					<button class="frm_button" name="submit" value="Submit" type="submit">Submit</button>
                </form>
            </fieldset>
			<br></br>


      <fieldset class="field_container">
          <legend> Your Offered Items </legend>
          <div id="item_table">
              <?php 
                  //call borrowed_list.php to create list of recipes
                  include('offered_list.php'); 
              ?>
          </div><!-- user_table -->
      </fieldset>


        </div><!-- content -->    
    </div><!-- container -->




</body>
</html>
	

