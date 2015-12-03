<?php 
//ini_set('display_errors', 'On');
session_start();
include "stored_info.php"; //contains db_host/db_user/db_pass/db_db

if (isset($_POST['checkout'])){

	

}


if( !isset($_POST['itemname']) || !$_POST['itemname'] ){
    displayform("you must enter a search term");
}

$ourItem = $_POST['itemname'];

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
if ($mysqli->connect_errno || $mysqli->connect_error)
{
   displayform("Server Databse Error"); 
}


$sql = "SELECT name FROM Item WHERE name LIKE '%$ourItem%' ";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "found item: " . $row["name"] . "<br>";
        if (isset($row["borrower_id"])){
        	echo "item is already checked out." . "<br>";
        }
        else{
        	echo "item is available. check out?" . "<br>";
        	?><form action="search.php"  method="POST">
                         
                        <input type="radio" name="checkout" value="yes" checked> yes
						<br>
						<input type="radio" name="checkout" value="no"> no
            </form><?php
        }
    }
} else {
    echo "Item not found";
}



