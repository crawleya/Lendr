<?php
//error reporting. comment out once code is working
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$user_id = $_SESSION['user_id'];
?>

<table class="item_list" cellspacing="2" cellpadding="0">
    <tr class="bg_h">
        <th class="tbl_entry">Item Name</th>
        <th class="tbl_entry">Item Owner</th>
		<th class="tbl_entry">Return Item</th>
    </tr>
    <?php
		//Query database for items being borrowed by current user		
		// including the database credentials
        include('stored_info.php');

		//connect to database
		$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
		if(!$mysqli || $mysqli->connect_errno) {
			die("Failed to connect to MySQL in item_list first query: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
		}
		
		//prepare search statement
		if (!($stmt = $mysqli->prepare("SELECT Item.id, Item.name, User.username FROM Item INNER JOIN User ON Item.owner_id = User.id WHERE borrower_id = ? AND owner_id != ?;"))) {
			die("Prepare statement failed in item_list first query: (" . $mysqli->errno . ") " . $mysqli->error);
		}

		//bind paramater search statement
		if (!($stmt->bind_param("ii",$user_id,$user_id))) {
			die("bind parameter failed in item_list first query: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		
		//execute statement
		if (!$stmt->execute()) {
			die("Execute failed in item_list first query: (" . $stmt->errno . ") " . $stmt->error);
		}
        
		//bind results to php variables
		if (!$stmt->bind_result($item_id, $item_name, $item_owner)) {
			die("Bind failed in item_list first query: (" . $stmt->errno . ") " . $stmt->error);
		}
		
		//loop through results and create table entries for each
        $bg = 'bg_1'; //this determines row background (bg) color
		while ($stmt->fetch()) {
			?>
			<tr class="<?php echo $bg; ?>">
				<td class="tbl_entry"><?php echo $item_name; ?></td>
				<td class="tbl_entry"><?php echo $item_owner; ?></td>
				<td class="tbl_entry"><button onclick="return_item(<?php echo $item_id; ?>)"><a href="#" class="return_m"> Return </a></button></td>				
			</tr>
			<?php
			if ($bg == 'bg_1') {
				$bg = 'bg_2';
			} else {
				$bg = 'bg_1';
            }
        }
		//close statement
		if (!$stmt->close()) {
			die("Close 1 failed in item_list: (" . $stmt->errno . ") " . $stmt->error);}
	?>
</table>