<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/unittest.css" />
</head>
<body>

<h2> Lendr Acceptance Tests </h2>
This is a test of the functionality of Lendr User Stories that were prioritized during the two development cycles available

<br><br>
<h3>Instuctions for use</h3>
becuase this demonstrates the interaction of two users it must be controlled which test user is logged in before displaying a page
<br> So please click the link to log in the appropriate user and then click the link to proceed to the Lendr page
<br>
<br> Perform these tests in order and perform the necesary inputs: offer item, borrow item, return item
<br> Observing at each step if the page is in the "Expected State"
<br> Finally delete the newly offered item to keep the test repeatable

<br><br>

<?php  

//log in mrtester
session_start();
$_SESSION['user_id'] = 23;

echo "<h3 class=\"testname\"> TEST: Offer a New Item </h3> 
<div class=\"frameheader\"> USER STEPS:
<ul>
<li> Offer a new Item
</u>
 </div>
<iframe class = \"offertestframe\" src = \"testofferborrowreturnloginframe.php?user_id=23&link=offer_item.php&linkname=See MrTesters offered items\"></iframe>
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


$getparams=urlencode("itemname=&grouplist%5B%5D=19");


echo "<h3 class=\"testname\"> TEST: Borrow Item </h3>

<iframe class = \"offertestframe\" src = \"testofferborrowreturnloginframe.php?user_id=24&link=user_items.php&linkname=See MissesTesters borrowed items\"></iframe>
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
<iframe class = \"offertestframe\" src = \"testofferborrowreturnloginframe.php?user_id=24&link=search.php&getparams={$getparams}&linkname=search for items in mr testers club group\"></iframe>
<div class=\"framefooter\"> 
<span class=\"expectedstate\">Expected State:</span>
<ul>
<li> MrTestr's new items displayed in search result
<li> after clicking borrow Mrs Tester should be listed as borrower
</u>
</div>

";

$getparams ="";

echo "<h3 class=\"testname\"> TEST: Track Borrowed Items </h3>

<iframe class = \"offertestframe\" src = \"testofferborrowreturnloginframe.php?user_id=23&link=offer_item.php&linkname=See MrTesters offered items\"></iframe>
<div class=\"framefooter\"> 
<span class=\"expectedstate\">Expected State:</span>
<ul>
<li> MrTester's Newly offered item is listed as borroed by MissesTester
</u>
</div>

<h3 class=\"testname\"> TEST: Return Items </h3>
<div class=\"frameheader\"> USER STEPS:
<ul>
<li> Return The Item Borrowed from MrTester
</u>
 </div>
<iframe class = \"offertestframe\" src = \"testofferborrowreturnloginframe.php?user_id=24&link=user_items.php&linkname=See MissesTesters borrowed items\"></iframe>
<div class=\"framefooter\"> 
<span class=\"expectedstate\">Expected State:</span>
<ul>
<li> MrTestr's new item displayed in list of MissesTesters borrowed items
<li> after clicking return borrowed items list should be empty
</u>
</div>

<iframe class = \"offertestframe\" src = \"testofferborrowreturnloginframe.php?user_id=23&link=offer_item.php&linkname=See MrTesters offered items\"></iframe>
<div class=\"framefooter\"> 
<span class=\"expectedstate\">Expected State:</span>
<ul>
<li> MrTester's new item should no longer be borrowed by MissesTester
</u>
</div>

";



?>

<br>
<iframe class = "offertestframe" src="testofferborrowreturndeleteitem.php"></iframe>

</body>
</html>