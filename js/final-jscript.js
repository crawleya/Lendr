//return_item
function return_item(id) {
	//create AJAX call to return item to owner in database
	try { //For standard non IE browsers
		var returnItem = new XMLHttpRequest();
	} catch(e) {
		try { //For IE 6+
			var returnItem = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e1) { //if IE < 6 or some other unsupported browser
			alert("Your browser is not supported by this webpage. Please try using a newer browser.");
		}
	}

	var method = 'POST';
	var url = 'return_item.php';
	var params = 'id=' + id;
	
	returnItem.open(method, url, true);
	returnItem.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	returnItem.send(params);
	
	returnItem.onreadystatechange = function() {
		if (returnItem.readyState === 4) {
			if (returnItem.status === 200) { //AJAX returned normally
				document.getElementById("item_table").innerHTML = returnItem.responseText; //set borrowed items data equal to server response
			}
		} else { //while waiting. table displays loading image
			document.getElementById("item_table").innerHTML = '<img src="images/loading.gif">';
		}
	}
}

//leave_group
function leave_group(id) {
	//create AJAX call to return item to owner in database
	try { //For standard non IE browsers
		var leaveGroup = new XMLHttpRequest();
	} catch(e) {
		try { //For IE 6+
			var leaveGroup = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e1) { //if IE < 6 or some other unsupported browser
			alert("Your browser is not supported by this webpage. Please try using a newer browser.");
		}
	}

	var method = 'POST';
	var url = 'leave_group.php';
	var params = 'id=' + id;
	
	leaveGroup.open(method, url, true);
	leaveGroup.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	leaveGroup.send(params);
	
	leaveGroup.onreadystatechange = function() {
		if (leaveGroup.readyState === 4) {
			if (leaveGroup.status === 200) { //AJAX returned normally
				document.getElementById("item_table").innerHTML = leaveGroup.responseText; //set borrowed items data equal to server response
			}
		} else { //while waiting. table displays loading image
			document.getElementById("item_table").innerHTML = '<img src="images/loading.gif">';
		}
	}
}

//join_group
function join_group(id) {
	//create AJAX call to return item to owner in database
	try { //For standard non IE browsers
		var joinGroup = new XMLHttpRequest();
	} catch(e) {
		try { //For IE 6+
			var joinGroup = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e1) { //if IE < 6 or some other unsupported browser
			alert("Your browser is not supported by this webpage. Please try using a newer browser.");
		}
	}

	var method = 'POST';
	var url = 'join_group.php';
	var params = 'id=' + id;
	
	joinGroup.open(method, url, true);
	joinGroup.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	joinGroup.send(params);
	
	joinGroup.onreadystatechange = function() {
		if (joinGroup.readyState === 4) {
			if (joinGroup.status === 200) { //AJAX returned normally
				document.getElementById("item_table").innerHTML = joinGroup.responseText; //set borrowed items data equal to server response
			}
		} else { //while waiting. table displays loading image
			document.getElementById("item_table").innerHTML = '<img src="images/loading.gif">';
		}
	}
}