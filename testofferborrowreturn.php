<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/unittest.css" />
</head>
<body>

<?php  

//log in mrtester
session_start();
$_SESSION['user_id'] = 23;


// including the database credentials
include('stored_info.php');
//connect to database
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
if(!$mysqli || $mysqli->connect_errno) {
  die("Failed to connect to MySQL in item_list first query: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

echo "<h3 class=\"testname\"> TEST: Offer a New Item </h3> 
MrTester is currently logged in
<div class=\"frameheader\"> USER STEPS:
<ul>
<li> Offer a new Item
</u>
 </div>
<iframe class = \"offertestframe\" src = \"offer_item.php\"></iframe>
<div class=\"framefooter\"> 
<span class=\"expectedstate\">Expected State:</span>
<ul>
<li> MrTestr's items displayed
<li> New Item displayed after form submit
</u>
</div>
";


/*echo "<h3 class=\"testname\"> TEST: Offer a New Item </h3> 
<br>
<div class=\"frameheader\"> mrtester's currently offered items, offer a new item to conitue </div>
<br>
<iframe src = \"testofferborrowreturnlinkframe.php?link=offer_item.php&linkname=MrTestrs items after adding new item\"></iframe>
";*/

session_start();
$_SESSION['user_id'] = 24;

$getparams=urlencode("itemname=&grouplist%5B%5D=19");

echo "<h3 class=\"testname\"> TEST: Borrow Item </h3>
MissesTester is now logged in <br>

<iframe class = \"offertestframe\" src = \"user_items.php\"></iframe>
<div class=\"framefooter\"> 
<span class=\"expectedstate\">Expected State:</span>
<ul>
<li> MissesTester has no borrowed items
</u>
</div>

<div class=\"frameheader\"> USER STEPS:
<ul>
<li> Borrow MrTester's New Item
</u>
 </div>
<iframe class = \"offertestframe\" src = \"testofferborrowreturnlinkframe.php?link=search.php&getparams={$getparams}&linkname=search for items in mr testers club group\"></iframe>
<div class=\"framefooter\"> 
<span class=\"expectedstate\">Expected State:</span>
<ul>
<li> MrTestr's new items displayed in search result
<li> after clicking borrow Mrs Tester should be listed as borrower
</u>
</div>

";

$getparams ="";


?>

</body>
</html>