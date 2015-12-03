<?php

session_start();

if (!isset($_SESSION['user_id'])){

  //this assumes file is in the same directory as login.php
  //just increase the subtraction on the last paramater if you are 2 folders deep it should be
  // explode('/', $_SERVER['PHP_SELF'], -3);
  $path = explode('/', $_SERVER['PHP_SELF'], -1);
  $path = implode('/',$path);

  $redirect = "http://" . $_SERVER['HTTP_HOST'] . $path;
  $getparams = "backto=" . urlencode($_SERVER['REQUEST_URI']) ;
  header("Location: {$redirect}/login.php?{$getparams}", true);
  exit();
}

else {
  
  //your page generation here
  echo $_SESSION['user_id'];

}



?>
