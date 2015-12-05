<html>
<head>
<meta charset="utf-8">
<title>Lendr</title>
<link rel="stylesheet" href="css/final-style.css" />
<script type="text/javascript" src="js/final-jscript.js"></script>
</head>

<?php 

/*foreach ($_GET as $key => $value) {
  echo "$key = $value <br>";
}*/

session_start();

if (isset($_GET['user_id'])){
  $_SESSION['user_id'] = $_GET['user_id'];
} else {
  unset($_SESSION['user_id']);
}

echo "<h3 class=\"testname\"> TEST: {$_GET['testname']} </h3>";
if (isset($_GET['user_id'])) echo "user_id:{$_GET['user_id']} <br> ";
if (isset($_GET['itemname'])) echo "itemname:{$_GET['itemname']} <br> ";
if (isset($_GET['onlyborrowable'])) echo "onlyborrowable:true <br> ";
if (isset($_GET['grouplist'])){
  echo "groups selected: ";
  foreach ($_GET['grouplist'] as $value) {
    echo "$value ,";
  }
  echo "<br>";
}


echo "<br>
<h4 class=\"expectedstate\"> Expected State: {$_GET['expectedstate']} </h4>
<br>
";

if (isset($_GET['fullpage'])){
  include 'search.php';
} 
else include 'search_list.php';


?>