<?php
//error reporting. comment out once code is working
error_reporting(E_ALL);
ini_set('display_errors', 1);
$user_id = $_SESSION['user_id'];
?>

<table class="item_list" cellspacing="2" cellpadding="0">
    <tr class="bg_h">
        <th class="tbl_entry">Item Name</th>
        <th class="tbl_entry">Owner</th>
        <th class="tbl_entry">Currently Borrowed By</th>
        <th class="tbl_entry">Borrow</th>
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
		if (!($stmt = $mysqli->prepare("SELECT i.id, i.name, o.id as ownerid, o.username as ownername, b.id as borrowid, b.username as borrowname FROM Item i 
			inner join User o on i.owner_id = o.id 
			inner join User b on i.borrower_id = b.id 
			where i.name LIKE ? "))) {
			die("Prepare statement failed in item_list first query: (" . $mysqli->errno . ") " . $mysqli->error);
		}

		//bind paramater search statement
		$search = '%' . $_POST['itemname'] . '%';
		if (!($stmt->bind_param("s",$search))) {
			die("bind parameter failed in item_list first query: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		
		//execute statement
		if (!$stmt->execute()) {
			die("Execute failed in item_list first query: (" . $stmt->errno . ") " . $stmt->error);
		}
        
		//bind results to php variables
		if (!$stmt->bind_result($item_id,$item_name,$ownerid,$ownername,$borrowid,$borrowname)) {
			die("Bind failed in item_list first query: (" . $stmt->errno . ") " . $stmt->error);
		}
		
		//loop through results and create table entries for each
        $bg = 'bg_1'; //this determines row background (bg) color
		while ($stmt->fetch()) {
			?>
			<tr class="<?php echo $bg; ?>">
				<td class="tbl_entry"><?php echo $item_name; ?></td>
				<td class="tbl_entry"><?php echo $ownername; ?></td>
				<td class="tbl_entry"><?php if($ownerid != $borrowid)echo $borrowname; ?></td>
				<td class="tbl_entry"><?php if($ownerid == $borrowid){
					echo "not yet borrowed";
					//borrow code here
				}
				?></td>


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