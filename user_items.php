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
                <legend> Your Borrowed Items </legend>
                <div id="item_table">
                    <?php 
                        //call borrowed_list.php to create list of recipes
                        include('borrowed_list.php'); 
                    ?>
                </div><!-- user_table -->
            </fieldset>
			<br></br>
        </div><!-- content -->    
    </div><!-- container -->
</body>
</html>
