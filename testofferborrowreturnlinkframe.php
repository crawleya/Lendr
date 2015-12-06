<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/unittest.css" />
</head>
<body>



<?php 

session_start();
$_SESSION['user_id'] = $_GET['user_id'];

echo "user {$_SESSION['user_id']} is now logged in <br>";


if (isset($_GET['getparams'])) {
  $getparams = urldecode($_GET['getparams']);
} else {
  $getparams = "";
}

echo " <a href = \"{$_GET['link']}?$getparams\">{$_GET['linkname']}</a> "
?>
</body>
</html>