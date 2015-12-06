<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/unittest.css" />
</head>
<body>

<?php 

$getparams = urlencode($_GET['getparams']);

echo "<a href= \"testofferborrowreturnlinkframe.php?user_id={$_GET['user_id']}&link={$_GET['link']}&getparams={$getparams}&linkname={$_GET['linkname']}\" \ > Log in user #{$_GET['user_id']} </a>";

 ?>

</body>
</html>