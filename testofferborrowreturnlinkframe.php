<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/unittest.css" />
</head>
<body>



<?php 
if (isset($_GET['getparams'])) {
  $getparams = urldecode($_GET['getparams']);
} else {
  $getparams = "";
}
echo " <a href = \"{$_GET['link']}?$getparams\">{$_GET['linkname']}</a> "
?>
</body>
</html>