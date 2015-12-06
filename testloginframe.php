<?php 

foreach ($_GET as $key => $value) {
    $_POST[$key] = $value;
}

echo "<h3 class=\"testname\"> TEST: {$_GET['testname']} </h3>";
if (isset($_POST['request'])) echo "request:{$_POST['request']} <br> ";
if (isset($_POST['username'])) echo "username:{$_POST['username']} <br> ";
if (isset($_POST['password'])) echo "password:{$_POST['password']} <br> ";
echo "<br>
<h4 class=\"expectedstate\"> Expected State: {$_GET['expectedstate']} </h4>
<br>
";

include 'login.php';



echo "<br><br><h4>user_id expected: {$_GET['expectedid']}   user_id:";
if (!isset($_SESSION['user_id'])){
    echo "not set <br>";
} else {
    echo "{$_SESSION['user_id']} </h4><br>";
}

?>