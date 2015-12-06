<?php 

//ini_set('display_errors', 'On');
session_start();

include "stored_info.php"; //contains db_host/db_user/db_pass/db_db

//$minPassLength = 7;

function displayform($message='')
{
    header('Content-Type: text/html');
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <link rel="stylesheet" href="css/final-style.css" />
    <title>Login for Lender</title>
  </head>
  <body>
    <form action="login.php" method="POST">
    <label class="frm_label">Username: </label> <input class="field_form" type="text" name="username"> <br>
    <label class="frm_label">Password: </label> <input class="field_form" type="password" name="password"> <br>

    <?php 
    if (isset($_REQUEST['backto']) ){
        echo "<input type=\"hidden\" name=\"backto\" value=\"{$_REQUEST['backto']}\"> ";
    }

    ?>

    <button class="frm_button" name="request" value="login" type="submit">Login</button>
    <button class="frm_button" name="request" value="signup" type="submit">SignUp</button>

    <br>

    <?php
    if ($message){
       echo"<br> <div id=\"message\">
       $message
        </div> ";
    }
    ?>

    </form>
  </body>
  </html>

  <?php

  exit();
}

function success($mysqli,$username,$userTable){

    //query database with username get id
    $getid = $mysqli->prepare("SELECT id FROM $userTable WHERE username = ?");
    $getid->bind_param("s",$username);
    $getid->execute();
    $getid->bind_result($id);
    $getid->fetch();
    $getid->close();

    //need to set id instead
    $_SESSION['user_id'] = $id;


    if(isset($_REQUEST['backto'])){
        $redirect = "http://" . $_SERVER['HTTP_HOST'] . urldecode($_REQUEST['backto']);
        header("Location: {$redirect}", true);
        exit();
    }
    else{
        header('Content-Type: text/html');
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Login for Lender</title>
        </head>
        <body>
        You have successfully logged in, please navigate to the Lendr feature you want to use
        </body>
        </html>

        <?php
    }
}


//first navigation to page
if (!isset($_REQUEST['request'])){
    displayform();
}

if ($_REQUEST['request'] == 'logout'){
  session_unset();
  session_destroy();

  displayform("You have been logged out");
}

//check that user and pass provided //if request is set
if( !isset($_POST['username']) || !$_POST['username'] 
        || !isset($_POST['password']) || !$_POST['password'] ){

    displayform("username and password must be provided");
}

if( !($_POST['request'] == 'login'  || $_POST['request'] == 'signup' )){
  displayform("We cannot perform that action right now");
}


//connect to database with created mysqli object
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
if ($mysqli->connect_errno || $mysqli->connect_error)
{
   displayform("Server Databse Error"); 
}

//name of table in databaseZ
$userTable = "User";

//check if username exists
$usrInStmt = $mysqli->prepare("SELECT COUNT(*) FROM $userTable WHERE username = ?");
$usrInStmt->bind_param("s", $_POST['username']);
$usrInStmt->execute();
$usrInStmt->bind_result($userExists);
$usrInStmt->fetch();
$usrInStmt->close();

if($_POST['request'] == 'login'){
    //check that user is in database
    if(!$userExists){
      displayform("We dont have a user with that name. Please create account first.");
    }
    //check that password matches what we have in database
    //retrieve has from database
    $getHash = $mysqli->prepare("SELECT password FROM $userTable WHERE username = ?");
    $getHash->bind_param("s",$_POST['username']);
    $getHash->execute();
    $getHash->bind_result($hash);
    $getHash->fetch();
    $getHash->close();
    //PLEASE NOTE: the database stored string includes algo, random salt, and hash
    if(password_verify($_POST['password'],$hash)){

        success($mysqli,$_POST['username'],$userTable); 

    } else {
        displayform("Incorect Password");
    }

} else if ($_POST['request'] == 'signup'){
    if($userExists) {

        displayform("That user name is already taken");
        
    }

    //do we want min pass length,  if used uncommnet global variable up above
/*    if(strlen($_POST['password']) < $minPassLength) {
        echo "Password must be at least $minPassLength long";
        exit();
    }*/

    //PLEASE NOTE: the returned string includes algo, random salt, and hash
    $hashp = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //add user to database
    $addUser = $mysqli->prepare("INSERT INTO 
        $userTable ( username, password) 
        VALUES (?,?)");
    $addUser->bind_param("ss", $_POST['username'], $hashp);
    if(!$addUser->execute()){
        displayform("We cannot perform that action right now");
    }
    $addUser->close();

    success($mysqli,$_POST['username'],$userTable);
}


?>