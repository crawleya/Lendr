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


$search = "";
$onlyborrowable = "";
if(isset($_REQUEST['itemname'])) $search = $_REQUEST['itemname'];
if(isset($_REQUEST['onlyborrowable'])) $onlyborrowable = "checked";
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
                <legend> Search for items </legend>
                <div id="search_for">
                  <form action="search.php"  method="GET">
      							<table>
      							<tr><td>
      							Item Name:
      							</td></tr>
      							<tr><td>
      							<input type="text" name="itemname" <?php echo "value=\"$search\""; ?> >
                    <button class="frm_button" type="search">Search</button>
                    </td></tr>
                    <tr><td>
      							<br><input type="checkbox" name="onlyborrowable" value="True"  <?php echo $onlyborrowable; ?> > Only Show Borrowable Items
      							</td></tr>
      							<tr><td>
                    <br>Only show items from the chosen groups
                    <?php include('search_filter.php') ?>
      							
      							</table>
                  </form>
                </div><!-- user_table -->
            </fieldset>

            <?php 
                //call borrowed_list.php to create list of recipes
                if (isset($_REQUEST['itemname'])) include('search_list.php'); 
            ?>

			<br></br>
        </div><!-- content -->    
    </div><!-- container -->
</body>
</html>