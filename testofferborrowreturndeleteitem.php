<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// including the database credentials
include('stored_info.php');
//connect to database
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
if(!$mysqli || $mysqli->connect_errno) {
  die("Failed to connect to MySQL in item_list first query: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

if (isset($_POST['delete'])){
  $rslt = $mysqli->query('SELECT id from Item where owner_id = 23');
  if (!$rslt){
    die("MrTester has no more items");
  }
  $id = 0;
  while ( $row = $rslt->fetch_row()) {
    $id=$row[0];
  }
  $rslt->free();
  if ($id != 0){
    $mysqli->query("DELETE FROM Item where owner_id = 23 and id = $id");
  }
}

session_start();
$_SESSION['user_id'] = 23;

include 'offered_list.php';

?>

<br>
<form action="testofferborrowreturndeleteitem.php" method="POST">
<button type="submit" > Refresh MrTesters currently offered items</button>
<button type="submit" name="delete" value="true">Delete MrTetsers most recently added item</button></form>